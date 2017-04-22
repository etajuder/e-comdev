<script type='text/javascript' src='assets/js/jquery.min.js'></script>
<script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script> 
<script type='text/javascript' src='assets/js/camera.min.js'></script>
<link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'> 
<script>
	jQuery(function(){
		
		// jQuery('#sliderUtama').camera({
			// thumbnails: true
		// });

		jQuery('#sliderUtama').camera({
			height: '400px',
			loader: 'bar',
			pagination: true,
		});
	});
</script>

<div class="camera_wrap camera_azure_skin clearfix" id="sliderUtama">
	<div data-thumb="assets/img/slides/thumbs/bridge.jpg" data-src="assets/img/slides/jp-promo.png" data-link="http://www.kartuprepaid-docomo.net/2016/06/poket-wifi-docomo-aicom.html" data-link-target="new">
	</div>
	<div data-thumb="assets/img/slides/thumbs/bridge.jpg" data-src="assets/img/slides/slide2.jpg">
		<div class="camera_caption fadeFromBottom">
			<h2>Have some unused items?</h2>
			<p>
				Rare item?<br>
				Good condition?<br>
				or maybe new condition?<br>
				Post your items and price them right now!!<br>
				<span class="big-orange">Its FREE!!</span>
			</p>
		</div>
	</div>
	<div data-thumb="assets/img/slides/thumbs/bridge.jpg" data-src="assets/img/slides/slide3.jpg">
		<div class="camera_caption fadeFromBottom">
				<h2>Are you looking for Jobs?</h2>
			<p>
				Part time?<br>
				Full time?<br>
				According to your skills?<br>
				Search your dream job right away!!<br>
				<span class="big-orange">Its FREE!!</span>
			</p>
		</div>
	</div>
</div>