<?php

// +----------------------------------------------------------------------
// | liftforgames.com [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Author: tangyin <cicicoco321@163.com> QQ:545764358
// +----------------------------------------------------------------------

namespace app\admin\model;
use think\Model;
use think\Db;


class EmptyController extends Model {

    //整理字段(用于显示字段的html)
    public function arrange_fields($arr_field){
        foreach($arr_field as $k=>$v){
            if($v['type'] == 'title' or $v['type'] == 'textarea' or $v['type'] == 'editor' or $v['type'] == 'image' or $v['type'] == 'images' or $v['type'] == 'file'){
                eval("\$arr = ".$v['setup'].'; ');
                $arr_field[$k]['setup'] = $arr;
            }
            //用来切开 options 字段
            if($v['type'] == 'radio' or $v['type'] == 'checkbox' or $v['type'] == 'select'){
                eval("\$arr = ".$v['setup'].'; ');
                $arr_field[$k]['setup'] = $arr;
                $options_arr = explode(',', $arr_field[$k]['setup']['options']);
                $arr_field[$k]['setup']['options']= $options_arr;

                foreach($arr_field[$k]['setup']['options'] as $k2=>$v2){
                    $optin_arr = explode('|', $v2);
                    $arr_field[$k]['setup']['options'][$k2] = $optin_arr;
                }
            }
            //数字的小数点
            if($v['type'] == 'number'){
                eval("\$arr = ".$v['setup'].'; ');
                $arr_field[$k]['setup'] = $arr;
                if($arr_field[$k]['setup']['decimaldigits'] == 0){
                    $arr_field[$k]['setup']['dian'] = '0';
                }
                if($arr_field[$k]['setup']['decimaldigits'] == 1){
                    $arr_field[$k]['setup']['dian'] = '0.0';
                }
                if($arr_field[$k]['setup']['decimaldigits'] == 2){
                    $arr_field[$k]['setup']['dian'] = '0.00';
                }
                if($arr_field[$k]['setup']['decimaldigits'] == 3){
                    $arr_field[$k]['setup']['dian'] = '0.000';
                }
                if($arr_field[$k]['setup']['decimaldigits'] == 4){
                    $arr_field[$k]['setup']['dian'] = '0.0000';
                }
                if($arr_field[$k]['setup']['decimaldigits'] == 5){
                    $arr_field[$k]['setup']['dian'] = '0.00000';
                }

            }
        }

        return $arr_field;

    }

    //字段处理(添加和修改时)
    public function add_edit_arrange_fields($fields,$data){
        foreach($fields as $v){
            //组图处理
            if($v['type'] == 'images'){
                $picarr = isset($data[$v['field']]) ? $data[$v['field']] :'' ;
                $text = $v['field'].'_name';
                $picarr_txt = isset( $data[$text]) ? $data[$text]: '' ;

                if(is_array($picarr) && is_array($picarr_txt)){
                    $picarrNum = count($picarr);
                    $picarrTmp = '';
                    for($i=0;$i<$picarrNum;$i++)
                    {
                        $picarrTmp[] = $picarr[$i].','.$picarr_txt[$i];
                    }
                    $data[$v['field']] = serialize($picarrTmp);
                    unset($data[$text]);
                }
            }
            //复选框处理
            if($v['type'] == 'checkbox'){
                $checkbox= isset($data[$v['field']]) ? $data[$v['field']] :'' ;
                if(is_array($checkbox)){
                    $data[$v['field']] =implode(",",$data[$v['field']]);
                }
            }
            //联动省市区处理
            if($v['type'] == 'linkage'){
                $prov = $v['field'].'_prov';
                $city = $v['field'].'_city';
                $dist = $v['field'].'_dist';

                $arr = array('prov'=>$data[$prov],'city'=>$data[$city],'dist'=>$data[$dist]);
                $data[$v['field']] = serialize($arr);
                unset($data[$prov]);
                unset($data[$city]);
                unset($data[$dist]);
            }
            //时间处理
            if($v['type'] == 'datetime'){
                $data[$v['field']] =strtotime($data[$v['field']]);
            }

        }
        return $data;
    }

    //数据处理(表单字段的数据显示)
    public function table_data($table_res,$moduleid){
        foreach($table_res as $k=>$v){
            $f_type = DB::name('field')->where('moduleid',$moduleid)->where('field',$k)->find();
            //组图（组图反序列化等处理）
            if($f_type['type'] == 'images'){
                $table_res[$k] = unserialize($v);
                if(is_array($table_res[$k])) {
                    foreach ($table_res[$k] as $k2 => $v2) {
                        $table_res[$k][$k2] = explode(',', $v2);
                    }
                }
            }
            //复选框
            if($f_type['type'] == 'checkbox'){
                $table_res[$k] = explode(',',$v);
            }
            //时间
            if($f_type['type'] == 'datetime'){
                $table_res[$k] = date('Y-m-d H:i:s', $v);
            }
            //下拉多选
            if($f_type['type'] == 'select'){
                eval("\$arr = ".$f_type['setup'].'; ');
                if($arr['multiple'] == 0){
                    $table_res[$k] = explode(',',$v);
                }
            }
            //省市区联动 linkage
            if($f_type['type'] == 'linkage'){
                $table_res[$k] = unserialize($v);
            }
        }
        return $table_res;
    }

}