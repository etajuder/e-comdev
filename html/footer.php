<section id="footer">
	<div class="container">
		<div class="col-sm-12">
			<div class="foot-head"></div>
		</div>
		<div class="col-sm-3">
			<h5 class="green-text">Quick Navigations</h5>
			<ul>
				<li><a href="">Find a Job</a></li>
				<li><a href="">Find an Item</a></li>
				<li><a href="">Forum</a></li>
				<li><a href="">Sell an Item</a></li>
				<li><a href="">Promo & Events</a></li>
			</ul>
		</div>
		<div class="col-sm-3">
			<h5 class="green-text">Company Info</h5>
			<ul>
				<li><a href=""><strong>About Us</strong></a></li>
				<li><a href=""><strong>Help Center</strong></a></li>
				<li><a href=""><strong>Contact Us</strong></a></li>
				<li><a href=""><strong>Career with Us</strong></a></li>
				<li><a href=""><strong>Terms of Services</strong></a></li>
				<li><a href=""><strong>Advertise with Us</strong></a></li>
			</ul>
		</div>
		<div class="col-sm-3">
			<h5 class="green-text">Social Media Supports</h5>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-googleplus-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					GOOGLE PLUS
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-facebook-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					FACEBOOK
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-twitter-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					TWITTER
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-youtube-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					YOUTUBE
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-instagram-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					INSTAGRAM
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-xs-2">
					<a href=""><i class="ion-social-pinterest-outline social-media orange"></i></a>
				</div>
				<div class="col-xs-10">
					PINTEREST
				</div>
			</div>
		</div>
		
		<div class="col-sm-3">
			<h5 class="green-text">Office & Map</h5>
			<p>
				2-24-4 Ohashi<br>
				Miyazaki-Shi<br>
				Miyazaki-ken
				880-0022
			</p>
			<div>
				<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
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
</section>
<section class="footer">
	<div class="container">
		<div class="col-sm-12">
			<p class="text-center">
				&copy; 2014 by <a href="" class="site-name">ichibanlist.com</a>
			</p>
		</div>
	</div>
</section>
