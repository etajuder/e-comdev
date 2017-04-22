<?php 
	$user = $this->session->userdata("user");
?>

<div class="container">
	<div class="col-sm-12">
		<h2><i class="ion-ios-cart orange"></i> Payment Confirmation</h2>
		<hr>
		<form action="<?=base_url()?>good/addConfirm" method="POST" enctype="multipart/form-data">
			<div class="row form-group">
				<label class="col-sm-2">
					select item
				</label>
				<div class="col-sm-8">				
					<select class="form-control select2-data" name="id_post"  required="">
						<?php 
							$option = $this->datagood->getListItem();
							foreach($option as $key=>$val){
								echo "<option value='$val->id_post'>$val->title</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					select banks
				</label>
				<div class="col-sm-3">
					<select class="form-control" name="id_bank"  required="">
						<?php 
							$option = $this->datagood->getListBank2();
							foreach($option as $key=>$val){
								echo "<option value='$val->id_bank'>$val->name_bank</option>";
							}
						?>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Amount
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="amount"  required="" placeholder="">
				
				</div>
			</div>

			<div class="row form-group">
				<label class="col-sm-2">
					File
				</label>
				<div class="col-sm-5">
					<input type="file" class="form-control" name="confirm_file"   placeholder="">
				
				</div>
			</div>	
			
			<div class="row form-group">
				<label class="col-sm-2">
					note
				</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="10" name="note" id="editor"></textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-orange btn-md">Submit</button>
					<button type="reset" class="btn btn-red btn-md">Reset</button>
					<button type="button" class="btn btn-warning btn-md" onclick="document.location='<?=base_url()?>good/lists/';">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>



<script type="text/javascript" src="<?=base_url();?>assets/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	$("#overLay").modal({backdrop:"static"});
	$(document).ready(function(){
		setTimeout(function(){ $("#overLay").modal("hide")},2000);
	});
	function keuUpURL(title){
		var url = title.split(" ");
		var new_url = "";
		for(key in url){
			url[key] = url[key].replace(/[^a-zA-Z 0-9]+/g,"");
			if(new_url==""){
				new_url = url[key];
			}else{
				new_url = new_url+"-"+url[key];
			}
		}
		jQuery("#url_post").val(new_url);
	}

	tinymce.init({
		selector: "#editor",
		menubar: "tools table format view insert edit"
	});
	
	var photo_uploaded 	= 0;
	var id_photos		= 0;
	var delete_photos	= 0;
	
	$("#uploadPhotoForm").submit(function( event ) {
		event.preventDefault();
		$("#progressloading").show();
		$("#errorUpload").hide();
		$.ajax({
			url:"<?=base_url("good/uploadPhoto")?>",
			type:"POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
		})
		.done(function(result){
			var data = JSON.parse(result);
			var photoURL 	= data.path;
			var id 			= data.id;
			var htmlcontent = "<div class=\"col-xs-4 col-sm-2 text-center\" id=\""+id+"_photo\"><img src=\"<?=base_url()?>"+photoURL+"\" class=\"preview-thumb\"><br><br><button type='button' class='btn btn-danger' onclick=\"deleteFile('"+id+"');\" ><i class='ion-trash-a'></i></button></div>";
			id_photos 		= id_photos+";"+id;
			$("#uploadphotos").val(id_photos);
			if(photo_uploaded==0){
				$("#photo-area div.row").html(htmlcontent);
				photo_uploaded++;
			}else{
				$("#photo-area div.row").prepend(htmlcontent);
				photo_uploaded++;
			}
			$("#filePhoto").val("");
			$("#photoDescription").val("");
			$("#uploadphotomodal").modal("hide");
			$("#progressloading").hide();
		})
		.fail(function(msg){
			$("#errorUpload").html("<p class='alert alert-danger'>Oops, an error occured. Please try again</p>");
			$("#errorUpload").show();
			$("#progressloading").hide();
		});
	});
	
	$("#uploadVideoForm").submit(function( event ) {
		event.preventDefault();
		$("#progressloadingVideo").show();
		$("#errorUploadVideo").hide();
		$.ajax({
			url:"<?=base_url("youtube/upload.php")?>",
			type:"POST",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData:false,
		})
		.done(function(result){
			var data = JSON.parse(result);
			var photoURL 	= data.path;
			var id 			= data.id;
			$("#id_video").val(id);
			$("#video_thumbnail").val(data.thumbnails.default.url);
			$("#video-area").html("<a href='https://www.youtube.com/watch?v="+data.id+"' target='_blank' class='btn btn-orange'>check video</a> it may need some time to be ready.<br><br>");
			$("#fileVideo").val("");
			$("#videoDescription").val("");
			$("#video_title").val("");
			$("#uploadvideomodal").modal("hide");
				
			$("#progressloadingVideo").hide();
		})
		.fail(function(msg){
			$("#errorUploadVideo").html("<p class='alert alert-danger'>Oops, an error occured. Please try again</p>");
			$("#errorUploadVideo").show();
			$("#progressloadingVideo").hide();
		});
	});
	
	function deleteFile(idFile){
		if(confirm("Are you sure?")){
			$("#"+idFile+"_photo").remove();
			delete_photos 		= delete_photos+";"+idFile;
			$("#deletephotos").val(delete_photos);
		}
	}
</script>
