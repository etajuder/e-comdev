<?php	
	$id_conversation = $this->uri->segment(3);
	$user = $this->session->userdata("user");
	$cek_user = $this->datamessage->cekIsUserAuth($id_conversation,$user['id_user']);
	if(!$cek_user){
		redirect(base_url("message"));
	}else{
	$this->datamessage->readAllMessages($id_conversation,$user['id_user']);
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><i class="fa fa-envelope-o"></i> Messaging Area</h2>
			<hr>
			<div class="row" >
				<div class="col-sm-12">
					<form method="POST" action="<?=base_url();?>message/sendMessage">
						<div class="form-group">
							<input type="hidden" name="id_conversation" value="<?=$id_conversation?>">
							<textarea name="message" class="form-control" required="" rows="5" placeholder="Your message"></textarea>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Send Message</button>
						</div>
					</form>
				</div>
				<?php 
					$notifications = $this->datamessage->getListMessage($id_conversation);  
					if(is_array($notifications)){
						foreach($notifications as $key=>$val){
							?>
							<div class="col-sm-12">
								<div  style="min-height:50px;padding:5px;border-bottom:1px solid #eee;cursor:pointer;<?//=($val->open==0)?"background:#FF8E56;color:#fff;":"";?>" onclick="javascript:document.location='<?=base_url();?>message/conversation/<?=$val->id_conversation?>'">
									<div class="row">
										<div class="col-sm-1 col-xs-2">
											<?php
												$avatar = $this->datauser->getUserAvatar($val->author);
												if($avatar!=""){
													?><img src="<?=base_url();?><?=$avatar;?>" style="max-height:40px;float:left;margin-right:15px;"><?php
												}else{
													?><img src="<?=base_url();?>assets/img/no-photo.png" style="max-height:40px;float:left;margin-right:15px;"><?php
												}
											?>
										</div>
										<div class="col-sm-8 col-xs-10">
											<?php
												print "<strong>".$this->datauser->getAuthorName($val->author)."</strong> ";											
												print "<small>".date("d M Y, H:i:s",$val->time_created)."</small>";
												print "<br>";
												print nl2br($val->message);
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
<?php } ?>