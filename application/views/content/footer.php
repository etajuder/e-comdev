<section id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="foot-head"></div>
			</div>
			<div class="col-sm-3">
				<h5 class="green-text">Quick Navigations</h5>
				<ul>
					<li><a href="<?=base_url()?>job/">Find a Job</a></li>
					<li><a href="<?=base_url()?>good/">Find an Item</a></li>
					<li><a href="<?=base_url()?>forum/">Forum</a></li>
					<li><a href="<?=base_url()?>good/add">Sell an Item</a></li>
					<li><a href="<?=base_url()?>event/promo">Promo & Events</a></li>
				</ul>
			</div>
			<div class="col-sm-3">
				<h5 class="green-text">Company Info</h5>
				<ul>
					<li><a href="<?=base_url()?>about/"><strong>About Us</strong></a></li>
					<li><a href="<?=base_url()?>help/"><strong>Help Center</strong></a></li>
					<li><a href="<?=base_url()?>contact/"><strong>Contact Us</strong></a></li>
					<li><a href="<?=base_url()?>about/career"><strong>Career with Us</strong></a></li>
					<li><a href="<?=base_url()?>terms/PrivacyPolicy"><strong>Privacy &amp; Policy</strong></a></li>
					<li><a href="<?=base_url()?>advertise"><strong>Advertise with Us</strong></a></li>
				</ul>
			</div>
			<div class="col-sm-3">
				<h5 class="green-text">Social Media Supports</h5>
				<div class="row clearfix">
					<div class="col-xs-2">
						<a href="https://plus.google.com/ichibanlist2014" target="_blank"><i class="ion-social-googleplus-outline social-media orange"></i></a>
					</div>
					<div class="col-xs-10">
						<a href="https://plus.google.com/ichibanlist2014" target="_blank">
						GOOGLE PLUS
						</a>
					</div>
				</div>
				<hr>
				<div class="row clearfix">
					<div class="col-xs-2">
						<a href="https://www.facebook.com/ichibanlist" target="_blank"><i class="ion-social-facebook-outline social-media orange"></i></a>
					</div>
					<div class="col-xs-10">
						<a href="https://www.facebook.com/ichibanlist" target="_blank">
						FACEBOOK
						</a>
					</div>
				</div>
				<hr>
				<div class="row clearfix">
					<div class="col-xs-2">
						<a href="https://twitter.com/ichiban_list" target="_blank"><i class="ion-social-twitter-outline social-media orange"></i></a>
					</div>
					<div class="col-xs-10">
						<a href="https://twitter.com/ichiban_list" target="_blank">
						TWITTER
						</a>
					</div>
				</div>
				<hr>
				<div class="row clearfix">
					<div class="col-xs-2">
						<a href="https://instagram.com/ichibanlist/" target="_blank"><i class="ion-social-instagram-outline social-media orange"></i></a>
					</div>
					<div class="col-xs-10">
						<a href="https://instagram.com/ichibanlist/" target="_blank">
						INSTAGRAM
						</a>
					</div>
				</div>
			</div>
			
			<div class="col-sm-3">
				<h5 class="green-text">Office & Map</h5>
				<p>
					2-24-4 Ohashi, Miyazaki-Shi<br>
					Miyazaki-Ken 880-0022<br>
				</p>
				<div>
					<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
					<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js" type="text/javascript"></script>
					<div id="map_div" style="height:150px;width:100%;">
						
					</div>
					<script>
						$(document).ready(function() {

							//------- Google Maps ---------//
								  
							// Creating a LatLng object containing the coordinate for the center of the map
							var latlng = new google.maps.LatLng(53.385846,-1.471385);
							  
							// Creating an object literal containing the properties we want to pass to the map  
							var options = {  
								zoom: 15, // This number can be set to define the initial zoom level of the map
								center: latlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP // This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
							};  
							// Calling the constructor, thereby initializing the map  
							var map = new google.maps.Map(document.getElementById('map_div'), options);  
							
							// Define Marker properties
							var image = new google.maps.MarkerImage('assets/img/marker.png',
								// This marker is 129 pixels wide by 42 pixels tall.
								new google.maps.Size(129, 42),
								// The origin for this image is 0,0.
								new google.maps.Point(0,0),
								// The anchor for this image is the base of the flagpole at 18,42.
								new google.maps.Point(18, 42)
							);
							
							// Add Marker
							var marker1 = new google.maps.Marker({
								position: new google.maps.LatLng(53.385846,-1.471385), 
								map: map,		
								icon: image // This path is the custom pin to be shown. Remove this line and the proceeding comma to use default pin
							});	
							
							// Add listener for a click on the pin
							google.maps.event.addListener(marker1, 'click', function() {  
								infowindow1.open(map, marker1);  
							});
								
							// Add information window
							var infowindow1 = new google.maps.InfoWindow({  
								content:  createInfo('Evoluted New Media', 'Ground Floor,<br />35 Lambert Street,<br />Sheffield,<br />South Yorkshire,<br />S3 7BH<br /><a href="http://www.evoluted.net" title="Click to view our website">Our Website</a>')
							}); 
							
							// Create information window
							function createInfo(title, content) {
								return '<div class="infowindow"><strong>'+ title +'</strong><br />'+content+'</div>';
							} 

						});
						
					</script>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<p class="text-center">
					&copy; 2014 by <a href="" class="site-name">ichibanlist.com</a>
				</p>
			</div>
		</div>
	</div>
</section>
