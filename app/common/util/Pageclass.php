<?php
namespace app\common\util;
class Pageclass{
	
	private $total;//数据表中的总记录数
		private $listRows;//每页显示行数
		private $limit;
		private $uri;
		public $pageNum;//页数
		private $config=array("header"=>"条记录","prev"=>"上一页","next"=>"下一页","first"=>"首 页","last"=>"尾 页");
		private $listNum=6;//列表12345的数目
		
		public function __construct($total,$listRows){
			$this->total = $total;
			$this->listRows =$listRows;
			$this->uri= $this->getUrl();
			$this->page = !empty($_GET["page"])? $_GET["page"]:1;
			$this->pageNum = ceil($total/$listRows);
			$this->limit = $this->setLimit();
		}
		private function setLimit(){
			$limit ="".($this->page-1)*$this->listRows.", {$this->listRows}";
			return $limit;
			
		}
		private function getUrl(){
			$url=$_SERVER['REQUEST_URI'].(strpos($_SERVER['REQUEST_URI'],'?')?'':'?');
			$parse = parse_url($url);
			if(isset($parse['query'])){
				parse_str($parse['query'],$params);
				unset($params['page']);
				$url=$parse['path'].'?'.http_build_query($params);
			}
			return $url;
		}
		
		function __get($args){
			if($args == "limit"){
				return $this->limit;
			}else{
				return null;
			}
		}
		private function start(){
			if($this->total==0)
					return 0;
			else
					return ($this->page-1)*$this->listRows+1;
			
		}
		private function end(){
			return min($this->page*$this->listRows,$this->total);
		}
		//首页
		private function first(){
			if($this->page==1){
					//$html='<a class="btn btn-mini" id="DataTables_Table_0_first" style="color: #aaaaaa !important;" class="first ui-corner-tl ui-corner-bl fg-button ui-button ui-state-default ui-state-disabled" tabindex="0">'.$this->config['first'].'</a>&nbsp;';
			        $html= "<ul class='paginList'><li class='paginItem'><a style='width:60px;' ><span style='color:#737373;'>首页</span></a></li>";
              
            }else{
					//$html="&nbsp;<a class='btn btn-mini' href='{$this->uri}&page=1'>{$this->config['first']}</a>&nbsp;";
			         $html= "<ul class='paginList'><li class='paginItem'><a style='width:60px;' href='{$this->uri}&page=1'><span >首页</span></a></li>";
            
            } 
			return $html;
		}
		//上一页
		private function prev(){
			if($this->page==1){
					$html= "<li class='paginItem'><a style='width:60px;' ><span style='color:#737373;'>上一页</span></a></li>";
             
            }else{
					$html= "<li class='paginItem'><a style='width:60px;' href='{$this->uri}&page=".($this->page-1)."'><span >上一页</span></a></li>";
            
            } 
			return $html;
			 
		}
		//下一页
		private function next(){
			if($this->page==$this->pageNum){
					$html="<li class='paginItem'><a style='width:60px;' ><span style='color:#737373;'>下一页</span></a></li>";
             
            }else{
					
                    $html="<li class='paginItem'><a style='width:60px;' href='{$this->uri}&page=".($this->page+1)."'><span >下一页</span></a></li>";
            
            } 
			return $html;
		}
		//尾页
		private function last(){
			if($this->page==$this->pageNum){
					//$html='<a class="btn btn-mini" id="DataTables_Table_0_last" style="color: #aaaaaa !important;" class="last ui-corner-tr ui-corner-br fg-button ui-button ui-state-default ui-state-disabled" tabindex="0">'.$this->config['last'].'</a>&nbsp;';
			         $html="<li class='paginItem'><a style='width:60px;' ><span style='color:#737373;'>尾页</span></a></li></ul>";
            }else{
					//$html="&nbsp;<a class='btn btn-mini' href='{$this->uri}&page=".($this->pageNum)."'>{$this->config['last']}</a>&nbsp;";
			         $html="<li class='paginItem'><a style='width:60px;' href='{$this->uri}&page=".($this->pageNum)."'><span >尾页</span></a></li></ul>";
            } 
			return $html;
			
		}
		//列表12345页
		private function pageList(){
			$linkPage="";
			$inum=floor($this->listNum/2);
			
			for($i=$inum;$i>=1;$i--){
				$page=$this->page-$i;
				
				if($page<1)
					continue;
				//$linkPage.='&nbsp;<a class="btn btn-mini" href="'.$this->uri.'&page='.$page.'">'.$page.'</a>&nbsp;';
                $linkPage.='<li class="paginItem"><a href="'.$this->uri.'&page='.$page.'">'.$page.'</a></li>';
                
            }                    
			
			//$linkPage.="&nbsp;<a class='btn btn-mini' style='	background: #41bedd none repeat scroll 0 0 !important;color: #ffffff !important;cursor: default !important;' ><b>{$this->page}</b></a>&nbsp;";
		      $linkPage.='<li class="paginItem current"><a >'.$this->page.'</a></li>';
                
			for($i=1;$i<=$inum;$i++){
				$page=$this->page+$i;
				if($page<=$this->pageNum){
					//$linkPage.='&nbsp;<a class="btn btn-mini" href="'.$this->uri.'&page='.$page.'">'.$page.'</a>&nbsp;';
                    $linkPage.='<li class="paginItem"><a href="'.$this->uri.'&page='.$page.'">'.$page.'</a></li>';
                
				}else{
					break;
				}
			}
			return $linkPage;
		}
		private function goPage(){
			return '&nbsp;<input type="text" style="margin:0;width:25px;margin-right:2px;" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.'|| this.value<=0)?'.$this->pageNum.':this.value;location=\''.$this->uri.'&page=\'+page+\'\'}" value="'.$this->page.'" ><input class="btn btn-mini" type="button" value="GO" onclick="javascript:var page=(this.previousSibling.value>'.$this->pageNum.'|| this.previousSibling.value<=0)?'.$this->pageNum.':this.previousSibling.value;location=\''.$this->uri.'&page=\'+page+\'\'">&nbsp;';
																							
		}
		function fpage($display=array(0,1,2,3,4,5,6,7,8)){
			//0"header",1"startend",2"pageNum",3"first",4"prev",5"pageList",6"next",7"last",8"goPage"
			//@$html[0] = "&nbsp;&nbsp;<span style='font-size:12px'>共有<b style='font-size:14px;'>".$this->total."</b>".$this->config['header']."</span>&nbsp;&nbsp;";
    
            @$html[0] = "<div class='message'>共<i class='blue'>".$this->total."</i>条记录，当前显示第&nbsp;<i class='blue'>".$this->page."</i>页</div>";
    
            @$html[1].="&nbsp;每页显示<b>".($this->end()-$this->start()+1)."</b>条&nbsp;&nbsp;";
			@$html[2].="&nbsp;<span style='font-size:14px'><b>{$this->page}/{$this->pageNum}</b>页</span>&nbsp;";
			@$html[3].=$this->first();
			@$html[4].=$this->prev();
			@$html[5].=$this->pageList();
			@$html[6].=$this->next();
			@$html[7].=$this->last();
			@$html[8].=$this->goPage();
			
			$fpage='';
			foreach($display as $index){
				
				@$fpage.=$html[$index];
			}
			return $fpage; 
		}
}