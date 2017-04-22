<?php 
	$user = $this->session->userdata("user");
	$type_notif = array(
		0 => "<i class='fa fa-comments-o'></i> ",
		1 => "<i class='fa fa-envelope-o'></i> ",
	);
?> 
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><i class="fa fa-bell"></i> Notifications</h2>
			<hr>
			<div class="row" >
				<?php 
					$notifications = $this->datanotification->getListNotifications($user['id_user']); 
					if(is_array($notifications)){
						foreach($notifications as $key=>$val){
							?>
							<div class="col-sm-12">
								<div id="notif_<?=$val->id_notification;?>" style="min-height:50px;padding:5px;border-bottom:1px solid #eee;cursor:pointer;<?php print($val->open==0)?"background:#66B9FF;color:#fff;":"";?>" onclick="openNotif(<?=$val->id_notification;?>)" >
									<div class="row">
										<div class="col-sm-1 col-xs-2">
											<?php 
												$avatar = $this->datauser->getUserAvatar($val->from);
												if($avatar!=""){
													?><img src="<?=base_url();?><?=$avatar;?>" style="max-height:40px;float:left;margin-right:15px;"><?php
												}else{
													?><img src="<?=base_url();?>assets/img/no-photo.png" style="max-height:40px;float:left;margin-right:15px;"><?php
												}
											?>
										</div>
										<div class="col-sm-8 col-xs-10">
											<?php 
												print $type_notif[$val->type];
												$name = $this->datauser->getAuthorName($val->from);
												$time = date("d M Y, H:i",$val->time_notif);
												$content = str_replace(array("#name#","#time#"),array($name,$time),$val->content);
												print $content;
											?>
										</div>	
									</div>	
								</div>
							</div>
							<?php
						}
					}
				?>
			</div>
		</div>
	</div>
</div>

<script>
	function openNotif(idn){
		$.ajax({
			url:"<?=base_url()?>notification/openNotif",
			type:"POST",
			data:{id_notif:idn}
		})
		.done(function(result){
			var res = JSON.parse(result);
			if(res.code == "success"){
				$("#notif_"+idn).css({"background":"#fff","color":"#575746"});
				document.location = res.url;
			}else{
				$("#notif_"+idn).css({"background":"#fff","color":"#575746"});
				alert("broken link! This notification can't be opened.");
			}
		})
		.fail(function(msg){
			$("#notif_"+idn).css({"background":"#fff","color":"#575746"});
			alert("broken link! This notification can't be opened. Please try again.");
		});
	}
</script>