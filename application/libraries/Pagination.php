<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Pagination{

    public function showPagging($counter,$url,$position="",$current_page=1, $list_per_page = 10, $type = 1){
		$totalperpage	= $list_per_page;
		$page			= 0;
		do{
			$page    = $page + 1;
			$counter = @$counter - $totalperpage;
		}while($counter>0);
		
		switch($position){
			default : 
				$pos_a = "";
				$pos_x = "";
			break;
			case "center" : 
				$pos_a = "<center>";
				$pos_x = "</center>";
			break;
		}
		if($current_page==""){
			$current_page = 1;
		}
		$stringret		= $pos_a.'<ul class="pagination">';
		for($i=1;$i<=$page;$i++){
			if($current_page==$i){
				if($type == 1){
					$stringret	= $stringret."<li class='disabled'><a disabled href='$url?page=$i#'>".$i."</a></li>";
				}else{
					$stringret	= $stringret."<li class='disabled'><a disabled href='$url&page=$i#'>".$i."</a></li>";
				}
			}else{
				if($type == 1){
					$stringret	= $stringret."<li class='active'><a href='$url?page=$i'>".$i."</a></li>";
				}else{
					$stringret	= $stringret."<li class='active'><a href='$url&page=$i'>".$i."</a></li>";
				}
			}
		}
		$stringret	= $stringret."</ul>".$pos_x;
		print $stringret;
    }
}
