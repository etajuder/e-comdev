<?php 
	$user = $this->session->userdata("user");
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><i class="ion-android-mail"></i> My Messages</h2>
			<hr>
			<div class="row" >
				<?php 
					$notifications = $this->datamessage->getListConversation($user['id_user']);  
					if(is_array($notifications)){
						foreach($notifications as $key=>$val){
							?>
							<div class="col-sm-12">
								<div  style="min-height:50px;padding:5px;border-bottom:1px solid #eee;cursor:pointer;<?//=($val->open==0)?"background:#FF8E56;color:#fff;":"";?>" onclick="javascript:document.location='<?=base_url();?>message/conversation/<?=$val->id_conversation?>'">
									<div class="row">
										<div class="col-sm-1 col-xs-2">
											<?php
												if($user['id_user']==$val->user_st){
													$avatar = $this->datauser->getUserAvatar($val->user_nd);
												}else{
													$avatar = $this->datauser->getUserAvatar($val->user_st);
												}
												if($avatar!=""){
													?><img src="<?=base_url();?><?=$avatar;?>" style="max-height:40px;float:left;margin-right:15px;"><?php
												}else{
													?><img src="<?=base_url();?>assets/img/no-photo.png" style="max-height:40px;float:left;margin-right:15px;"><?php
												}
											?>
										</div>
										<div class="col-sm-8 col-xs-10">
											<?php
												if($user['id_user']==$val->user_st){
													print "<strong>".$this->datauser->getAuthorName($val->user_nd)."</strong> ";
												}else{
													print "<strong>".$this->datauser->getAuthorName($val->user_st)."</strong> ";
												}
												$lastMessage = $this->datamessage->getLastMessage($val->id_conversation);
												if(is_object($lastMessage)){
													print "<small>".date("d M Y, H:i",$lastMessage->time_created)."</small>";
													print " - <strong>".$this->datamessage->countUnreadMsg($val->id_conversation,$user['id_user'])."</strong>";
													print "<br>";
													print $lastMessage->message;
												}else{
													print "<br>";
													print "No message";
												}
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