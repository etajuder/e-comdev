<h2 class="post-title" >Hasil Pencarian "<?php print $_POST['keyword'];?>" di <span class="green-text">caratradingonline.com</span></h2>
<?php 
	$limit = 4;
	$page = @$_GET['page'];
	if($page==""){ $page = 1;}
	$str = ($page-1)*$limit;
	$preview = $con->db->sql_query("SELECT foto_url,title,date_time,viewer,tags,tb_article.url,mini_description FROM tb_article,tb_article_category WHERE  tb_article.id_category = tb_article_category.id_category AND body LIKE '%$_POST[keyword]%' ORDER BY date_time DESC");	
	$preview = $con->db->sql_parse_array($preview);
	
	if(count($preview)>0){
           foreach($preview as $key=>$val){
                ?>
                <div class="preview-post clearfix">
					<div class="col-sm-3 img-thumbnail">
					<?php if($val['foto_url']!=""){  ?>
						<img src="http://<?php print $_SERVER['HTTP_HOST']?>/<?php print $val['foto_url']?>">
					<?php }else{ ?>
						<img src="<?php print eval("?>".$setting['logo']);?>" style="max-width:100%;">
					<?php } ?>
					</div>
					<div class="col-sm-9">
						<a href="http://<?php print $_SERVER['HTTP_HOST']?>/artikel/<?php print $val['url'];?>">
							<h3><?php print $val['title'];?></h3>
						</a>
						<div class="time-post">
							<i class="ion-ios7-calendar-outline icon-med"></i> <?php print date("d M Y, H:i:s", $val['date_time'])?> 
							<i class="last-icon ion-ios7-eye-outline icon-med"></i>  <?php print $val['viewer'];?> kali <br>
						</div>
						<div class="tag-post">
							<?php 
								$tags = $val['tags'];
								$tags = explode(",",$tags);
								foreach($tags as $k=>$v){
									?>
										<a href="http://<?php print $_SERVER['HTTP_HOST']?>/tags/<?php print $v;?>" class="btn btn-default btn-xs">
											<?php print $v;?>
										</a>
									<?php
								}
							?>
						</div>
						<?php print $val['mini_description'];?>...<br><br>
						<a href="http://<?php print $_SERVER['HTTP_HOST']?>/artikel/<?php print $val['url'];?>" class="btn btn-default btn-sm">Lihat Selengkapnya</a>
					</div>
				</div>
                <?php
			}
	}
?>