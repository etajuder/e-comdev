<?php 
	$user = $this->session->userdata("user");
	$sesi = $this->datajob->getDetail($_GET['id']);
	$photos = $this->datajob->getListPhotoOfPost($sesi->id_post);
?>

<div class="container">
	<div class="col-sm-12">
		<h2><i class="ion-ios-cart orange"></i> Edit Your Items</h2>
		<hr>
		<form action="<?=base_url()?>job/editProcess" method="POST" enctype="multipart/form-data">
			<div class="row form-group">
				<label class="col-sm-2">
					Title
				</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" name="title" id="password" onkeyup="keuUpURL(this.value);" required="" placeholder="" value="<?=$sesi->title?>">
					<input type="hidden" class="form-control" name="url_post" id="url_post" required="" placeholder="" value="<?=$sesi->url_post?>">
					<input type="hidden" class="form-control" name="id_post" id="url_post" required="" placeholder="" value="<?=$sesi->id_post?>">
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Salary
				</label>
				<div class="col-sm-2">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-yen"></i></span>
						<input type="text" class="form-control" name="amount" id="password" required="" placeholder="" value="<?=$sesi->amount?>">
					</div>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="amount_label" id="location" required="">
						<option <?php if($sesi->amount_label=="per hour"){ echo "selected";} ?> value="per hour">per hour</option>
						<option <?php if($sesi->amount_label=="per month"){ echo "selected";} ?> value="per month">per month</option>
						<option <?php if($sesi->amount_label=="per year"){ echo "selected";} ?> value="per year">per year</option>
					</select>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Job location
				</label>
				<div class="col-sm-3">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="ion-ios-location icon-big"></i></span>
						<select class="form-control" name="id_location" id="location" required="">
							<?php 
								$option = $this->datajob->getListLocation();
								foreach($option as $key=>$val){
									if($sesi->id_location==$val->id_location){
										echo "<option value='$val->id_location' selected>$val->name_location</option>";
									}else{
										echo "<option value='$val->id_location'>$val->name_location</option>";
									}
								}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Job category
				</label>
				<div class="col-sm-3">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="ion-android-list icon-big"></i></span>
						<select class="form-control" name="id_category" id="location" required="">
							<?php 
								$option = $this->datajob->getListCategories();
								foreach($option as $key=>$val){
									if($sesi->id_category==$val->id_job){
										echo "<option value='$val->id_job' selected>$val->name_job</option>";
									}else{
										echo "<option value='$val->id_job'>$val->name_job</option>";
									}
								}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Tags
				</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" name="tags" id="password" required="" placeholder="" value="<?=$sesi->tags?>">
					<p class="help-block">
						separate each tag using comma(,)
					</p>
				</div>
			</div>
			
			<div class="row form-group">
				<label class="col-sm-2">
					Photo(s)
				</label>
				<div class="col-sm-10">
					<div id="photo-area" class="well">
						<?php 
							$photouploaded = 0;
							if(count($photos)>0){
								foreach($photos as $key=>$val){
									$photouploaded = @$photouploaded.";".$val->id_photo;
								}
							}
						?>
						<input type="hidden" name="uploadphoto" id="uploadphotos" value="<?=$photouploaded;?>">
						<input type="hidden" name="deletephoto" id="deletephotos">
						<div class="row">
							<?php 
								
								if(count($photos)>0){
									foreach($photos as $key=>$val){
										?>
										<div class="col-xs-4 col-sm-2 text-center" id="<?=$val->id_photo;?>_photo">
											<img src="<?=base_url()?><?=$val->path;?>" class="preview-thumb"><br><br>
											<button type='button' class='btn btn-danger' onclick="deleteFile('<?=$val->id_photo;?>');" ><i class='ion-trash-a'></i></button>
										</div>
										<?php
									}
								}else{ 
									?>
									<div class="col-xs-4 col-sm-2">
										<img src="<?=base_url()?>assets/img/no-photo.png" class="preview-thumb">
									</div>
									<?php
								}
							?>
						</div>
					</div>
					
					<button type="button" class="btn btn-blue" data-toggle="modal" data-target="#uploadphotomodal"><i class="ion-camera"></i> Add photo</button>
					<p class="help-block">
						You can upload more than 1 photo
					</p>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Video
				</label>
				<div class="col-sm-8">
					<div id="video-area"></div>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-video-camera"></i></span>
						<input type="text" class="form-control" name="id_video" id="id_video" required="" placeholder="" readonly value="<?=$sesi->id_video;?>">
						<input type="hidden" class="form-control" name="video_thumbnail" id="video_thumbnail" required="" placeholder="" value="<?=$sesi->video_thumbnail;?>">
					</div>
					<br>
					<div class="input-group">
						<button type="button" class="btn btn-blue" data-toggle="modal" data-target="#uploadvideomodal"><i class="fa fa-video-camera"></i> Upload/change video</button>
					</div>
					<p class="help-block">If applicable</p>
				</div>
			</div>
			<div class="row form-group">
				<label class="col-sm-2">
					Description
				</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="10" name="content" id="editor"><?=$sesi->content?></textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-orange btn-md">Submit</button>
					<button type="reset" class="btn btn-red btn-md">Reset</button>
					<button type="button" class="btn btn-warning btn-md" onclick="document.location='<?=base_url()?>job/lists/';">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="uploadphotomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload photo</h4>
			</div>
			<div class="modal-body text-center">
				<form method="POST" enctype="multipart/form-data" id="uploadPhotoForm" action="<?php print base_url("job/uploadPhoto");?>">
					<div id="progressloading" style="display:none;">
						<i class="fa fa-spinner fa-pulse big-icon"></i> Uploading..
					</div>
					<div id="errorUpload" style="display:none">
						
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="file" name="filePhoto" class="form-control" id="filePhoto">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<textarea placeholder="Photo description" name="photo_description" rows="5" class="form-control" id="photoDescription"></textarea>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<button type="submit" class="btn btn-blue"><i class="ion-ios-cloud-upload-outline"></i> Upload</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="uploadvideomodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Upload Video to youtube</h4>
			</div>
			<div class="modal-body text-center">
				<form method="POST" enctype="multipart/form-data" id="uploadVideoForm" action="<?php print base_url("job/uploadVideo");?>">
					<div id="progressloadingVideo" style="display:none;">
						<i class="fa fa-spinner fa-pulse big-icon"></i> Uploading..
					</div>
					<div id="errorUploadVideo" style="display:none">
					
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="file" name="fileVideo" class="form-control" id="fileVideo">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<input type="text" class="form-control" name="video_title" id="video_title" required="" placeholder="">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<textarea placeholder="Video description" name="video_description" rows="5" class="form-control" id="videoDescription"></textarea>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-6 col-sm-offset-3">
							<button type="submit" class="btn btn-blue"><i class="ion-ios-cloud-upload-outline"></i> Upload</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade in" id="overLay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="text-center">
					<i class="fa fa-cog fa-spin icon-big"></i> Loading... Please wait
				</h3>
			</div>
		</div>
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
	<?php 
		if(count($photos)>0){
			echo "photo_uploaded = ".count($photos).";";
			foreach($photos as $key=>$val){
				echo "id_photos = id_photos+';".$val->id_photo."';";
			}
		}
	?>
	var delete_photos	= 0;
	
	$("#uploadPhotoForm").submit(function( event ) {
		event.preventDefault();
		$("#progressloading").show();
		$("#errorUpload").hide();
		$.ajax({
			url:"<?=base_url("job/uploadPhoto")?>",
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
				$("#filePhoto").val("");
				$("#photoDescription").val("");
				$("#uploadphotomodal").modal("hide");
				photo_uploaded++;
			}else{
				$("#photo-area div.row").prepend(htmlcontent);
				photo_uploaded++;
			}
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
