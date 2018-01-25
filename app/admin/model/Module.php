<?php

// +----------------------------------------------------------------------
// | liftforgames.com [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Author: tangyin <cicicoco321@163.com> QQ:545764358
// +----------------------------------------------------------------------

namespace app\admin\model;
use think\Model;
use think\Db;


class Module extends Model {
	//查找字段是否存在于数据表
    public function field_exist($data){
        $fieldName=$data['field'];
        $prefix=config('database.prefix');
        
        $name = db('module')->where(array('id'=>$data['moduleid']))->value('name');
        $tablename=$prefix.$name;
        $Fields=Db::getFields($tablename);
        $ishave = 0;    
        foreach ( $Fields as $key =>$r){
            if($key==$fieldName){
                $ishave=1;
            }
        }
        return $ishave;
    }
    
    //在modle类中 处理表添加字段
	public function get_tablesql($info,$do){
		
		//字段类型
        $fieldtype = $info['type'];
        if(!empty($info['setup']['fieldtype'])){
            $fieldtype=$info['setup']['fieldtype'];
        }
        
        $field = $info['field'];//字段名
        
        $name = db('module')->where(array('id'=>$info['moduleid']))->value('name');
        $tablename=config('database.prefix').$name;//表名
        
        $maxlength = intval($info['maxlength'])?intval($info['maxlength']):'';//字符长度
        $default=   !empty($info['setup']['default'])?$info['setup']['default']:'';//默认值
        $numbertype = isset($info['setup']['numbertype'])?$info['setup']['numbertype']:0;//1=不包括负数
        
        
        $oldfield = isset($info['oldfield'])?$info['oldfield']:'';
        
        if($do == 'add'){
            $do = 'ADD';
        }else if($do == 'edit'){
            $do =  " CHANGE `".$oldfield."` ";
        }
        
        
		switch($fieldtype) {
            case 'varchar':
                if(!$maxlength){$maxlength = 255;}
                $maxlength = min($maxlength, 255);
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";
                break;

            case 'title':
                $thumb = $info['setup']['thumb'];
                $style = $info['setup']['style'];
                if(!$maxlength){$maxlength = 255;}
                $maxlength = min($maxlength, 255);
                $sql[] = "ALTER TABLE `$tablename` $do `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";


                if(!$this->_iset_field($name,'thumb')){
                    if($thumb==1) {
                        $sql[] = "ALTER TABLE `$tablename` ADD `thumb` VARCHAR( 100 ) NOT NULL DEFAULT ''";
                    }
                }else{
                    if($thumb==0) {
                        $sql[] = "ALTER TABLE `$tablename` drop column `thumb`";
                    }
                }

                if(!$this->_iset_field($name,'title_style')){
                    if($style==1) {
                        $sql[] = "ALTER TABLE `$tablename` ADD `title_style` VARCHAR( 100 ) NOT NULL DEFAULT ''";
                    }
                }else{
                    if($style==0) {
                        $sql[] = "ALTER TABLE `$tablename` drop column `title_style`";
                    }
                }
                break;
            case 'catid':
                $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            case 'number':
                $decimaldigits = $info['setup']['decimaldigits'];
                $default = $decimaldigits == 0 ? intval($default) : floatval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` ".($decimaldigits == 0 ? 'INT' : 'decimal( 10,'.$decimaldigits.' )')." ".($numbertype ==1 ? 'UNSIGNED' : '')."  NOT NULL DEFAULT '$default'";
                break;

            case 'tinyint':
                if(!$maxlength) $maxlength = 3;
                $maxlength = min($maxlength,3);
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT( $maxlength ) ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;


            case 'smallint':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'int':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'mediumint':
                $default = intval($default);
                $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
                break;

            case 'mediumtext':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;

            case 'text':
                $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
                break;

            case 'posid':
                $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            //case 'typeid':
            //$sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
            //break;

            case 'datetime':
                $sql = "ALTER TABLE `$tablename` $do `$field` INT(11) UNSIGNED NOT NULL DEFAULT '0'";
                break;

            case 'editor':
                $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
                break;

            case 'image':
                if(!$maxlength){ $maxlength = 80;}
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( ".$maxlength." ) NOT NULL DEFAULT ''";
                break;

            case 'images':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;

            case 'file':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;

            case 'files':
                $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
                break;
            case 'template':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;
            case 'linkage':
                $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
                break;
        }
        //return $sql;
        
        DB::name('field')->execute($sql);
        
    }
		
		
		
	
}