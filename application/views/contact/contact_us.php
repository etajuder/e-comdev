<div class="container">
	<div class="col-sm-12">
		<h2>Contact <span class="invert-text">ichibanlist.com</span></h2>
		<hr>
		<div class="text-center box-map" id="super-map" style="height:400px;">
			
		</div>
		<h3>FORM CONTACT</h3>
		<div class="row">
			<div class="col-sm-12" id="errorMessage" style="display:none;">
				
			</div>
		</div>
		<form method="POST" action="" id="contact_form">
				<div class="row form-group">
					<div class="col-sm-6">
						<input type="email" class="form-control" name="email_address" required="" placeholder="Email Address" id="v_email">
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="full_name" required="" placeholder="Full Name" id="v_name">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-12">
						<textarea name="message" placeholder="Your Message" rows="8" required="" class="form-control" id="v_pesan"></textarea>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-12">
						<button type="submit" name="submitContact" class="btn btn-blue-lotus" id="submitBtn">Submit</button>
						<button type="reset" name="submitContact" class="btn btn-grey">Reset</button>
					</div>
				</div>
				</form>
		<script>
			$(document).ready(function() {
				
					var secheltLoc = new google.maps.LatLng(-7.557576, 110.8024453);

					var myMapOptions = {
						 zoom: 15
						,center: secheltLoc
						,mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var theMap = new google.maps.Map(document.getElementById("super-map"), myMapOptions);


					var marker = new google.maps.Marker({
						map: theMap,
						draggable: true,
						position: secheltLoc ,
						visible: true
					});

					var boxText = document.createElement("div");
					boxText.style.cssText = "border-radius:5px;border: 1px solid #058D8D; margin-top: 10px; background: #00CACA; padding: 15px;color:#fff; font-family:'Open Sans', sans-serif;font-weight:700;";
					boxText.innerHTML = "<h3>Office & Location</h3> <p style='color:#fff;font-size:15px;line-height:1.5;font-family:'Open Sans', sans-serif;font-weight:600;'>Miyazaki, Japan<br> contact@ichibanlist.com</p>";

					var myOptions = {
						 content: boxText
						,disableAutoPan: false
						,maxWidth: 0
						,pixelOffset: new google.maps.Size(-140, 0)
						,zIndex: null
						,boxStyle: { 
						  background: "url('tipbox.gif') no-repeat"
						  ,opacity: 1.0
						  ,width: "280px"
						 }
						,closeBoxMargin: "10px 2px 2px 2px"
						,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
						,infoBoxClearance: new google.maps.Size(1, 1)
						,isHidden: false
						,pane: "floatPane"
						,enableEventPropagation: false
					};

					google.maps.event.addListener(marker, "click", function (e) {
						ib.open(theMap, this);
					});

					var ib = new InfoBox(myOptions);

					ib.open(theMap, marker);
			});
			
		</script>
		<script>
			$("#contact_form").submit(function(e){
				$("#errorMessage").hide();
				e.preventDefault();
				var v_email = $("#v_email").val();
				var v_name = $("#v_name").val();
				var v_pesan = $("#v_pesan").val();
				$("#submitBtn").attr("disabled","true");
				
				$.ajax({
					url : "<?=base_url()?>contact/send_email",
					data : {email : v_email, nama_lengkap: v_name, pesan: v_pesan},
					type : "POST"
				})
				.done(function(result){	
					$("#errorMessage").html("<p class='alert alert-success'>Pesan berhasil disampaikan</p>");
					$("#errorMessage").show();
					$("#submitBtn").removeAttr("disabled");
				})
				.fail(function(msg){
					$("#errorMessage").html("<p class='alert alert-danger'>Pesan gagal disampaikan!</p>");
					$("#errorMessage").show();
				});
			});
		</script>
	</div>
</div>