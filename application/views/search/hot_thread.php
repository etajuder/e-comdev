<div class="hot-thread">
	<h3>Hot Threads</h3>
	<ul>
		<?php 
			$hot = $this->dataforum->getListHotThreads();
			foreach($hot as $key=>$val){
				?><li><a href="<?=base_url()?>forum/post/<?=$val->url_post?>"><?=substr($val->title,0,60);?></a></li><?php
			}
		?>
	</ul>
</div>