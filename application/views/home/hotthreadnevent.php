<section id="block-down">
	<div class="container clearfix">
		<div class="row">
			<div class="col-sm-6">
				<div class="block-grey">
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
			</div>
			<div class="col-sm-6">
				<div class="block-grey">
					<h3>Promo & Events</h3>
					<ul>
						<li><a href="">Tokyo Metropolitan Tourism Chrysanthemum Exhibition</a></li>
						<li><a href="">Japan National Job fair Week</a></li>
						<li><a href="">Fall Evening Illumination at Rikugien Gardens</a></li>
						<li><a href="">Hachioji Ginkgo Festival</a></li>
						<li><a href="">Doburoku Matsuri</a></li>
						<li><a href="">New Year countdown & Japan’s earliest beach opening ceremony</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>