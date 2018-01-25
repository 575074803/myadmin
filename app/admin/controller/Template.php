<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class Template extends AdminController
{
	//模板管理
    public function index()
    {
        $dir = ROOT_PATH .DS.'template/';
        $fname = input('param.fname');
        $this->assign('fname',$fname);
        if($fname){
            $dir = $dir.$fname.'/';
            //搜索一个文件夹，返回这个文件夹下的所有文件
            $files = GetFiles($dir);
        }else{
            //搜索一个文件夹，返回这个文件夹下的所有文件
            $files = GetFiles($dir); 
        }
        $this->assign('dir',$dir);
        $this->assign('files',$files);
		return $this->fetch();
	}
	
    
    //模板编辑
    public function edit()
    {
        if($_POST){
            $data = input('post.');
            $dir = ROOT_PATH .DS.'template/';
            $fname = $data['fname'];
            if($fname){
                $filename = $dir.$fname.'/'.$data['file'];
            }else{
                $filename = $dir.$data['file'];
            }
            //修改css路径
            if($data['css']){
                $data['content'] = str_replace($data['css'],$data['upcss'],$data['content']);
            }
            //修改js路径
            if($data['js']){
                $data['content'] = str_replace($data['js'],$data['upjs'],$data['content']);
            }
            //修改js路径
            if($data['image']){
                $data['content'] = str_replace($data['image'],$data['upimage'],$data['content']);
            }
            $fp= fopen($filename, "w");
            fwrite($fp,$data['content']);
            fclose($fp);
            
            $this->redirect('admin/template/index');
            //$this->success('更新成功');
        }else{
            $dir = ROOT_PATH .DS.'template/';
            $file = input('param.file');
            
            $fname = input('param.fname');
            if($fname){
                $file_path = $dir.$fname.'/'.$file;
            }else{
               $file_path = $dir.$file; 
            }
            
            if(file_exists($file_path)){
                $fp = fopen($file_path,"r");
                if(filesize($file_path) == 0){
                   $str = ''; 
                }else{
                   $str = htmlspecialchars(trim(fread($fp,filesize($file_path))));//指定读取大小，这里把整个文件内容读取出来
                }
            }
            $this->assign('all_file',$str);
            $this->assign('file',$file);
    		return $this->fetch();
        }
	}

	//更改所有模板的css,js,images
    public function edit_all(){
        if($_POST){
            $data = input('post.');
            $dir = ROOT_PATH .'template/';
            $fname = input('param.fname');
            if($fname){
                $dir = $dir.$fname.'/';
                //搜索一个文件夹，返回这个文件夹下的所有文件
                $files = GetFiles($dir);
            }else{
                //搜索一个文件夹，返回这个文件夹下的所有文件
                $files = GetFiles($dir);
            }

            //判断目录下有没有文件
            $types = array();
            foreach($files as $v){
                array_push($types,$v['type']);
            }
            if( !in_array('file',$types)){
                $this->error('此目录下没有文件');
                exit;
            }

            foreach($files as $v){
                $filename = $dir.$v['name'];
                if(file_exists($filename)){
                    $str = file_get_contents($filename);//将整个文件内容读入到一个字符串中
                    //$str = str_replace("\r\n","<br />",$str);
                    //echo $str;

                    if($data['css']){
                        $str = str_replace($data['css'],$data['upcss'],$str);
                    }
                    //修改js路径
                    if($data['js']){
                        $str = str_replace($data['js'],$data['upjs'],$str);
                    }
                    //修改js路径
                    if($data['image']){
                        $str = str_replace($data['image'],$data['upimage'],$str);
                    }
                    $fp= fopen($filename, "w");
                    fwrite($fp,$str);
                    fclose($fp);
                }
            }
            if($fname){
                $this->redirect('template/index',array('fname'=>$fname));
            }else{
                $this->redirect('template/index');
            }
        }else{
            return $this->fetch();
        }
    }

}
