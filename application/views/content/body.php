<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta name="alexaVerifyID" content="AS5wujk1_or-GTYl7YoLsjzwtaM"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"></meta>
		<meta charset="utf-8"/>
		<meta name="msvalidate.01" content="DC22E80820D4725F3F0BE6123DBCFD14" />
		<meta name="google-site-verification" content="Lilag1eH90zO6u6v8DsJL1XHKAwiI41-ISXkkI6kQDU" />
		<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/styles.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/ionicons.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<!--<link href="<?php//print base_url()?>assets/css/bootstrap-theme.css" rel="stylesheet">-->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
		<script src="<?=base_url()?>assets/js/jquery.js"></script>
		<script src="http://cdn.rawgit.com/hilios/jQuery.countdown/2.0.4/dist/jquery.countdown.min.js"></script>

<script src="http://www.elevateweb.co.uk/wp-content/themes/radial/jquery.elevatezoom.min.js" type="text/javascript"></script>
<script src="http://www.elevateweb.co.uk/wp-content/themes/radial/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
		<link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/img/favicon.png">
<script type="text/javascript">
						$('#jcountdown').countdown('2017/01/01 00:00:00', function(event) {
						    var $this = $(this).html(event.strftime(''
						      + '<span>%-D</span> days '
						      + '<span>%H</span> hr '
						      + '<span>%M</span> min '
						      + '<span>%S</span> sec'));
						  });
					</script>
	</head>
	<body>
		<?php 
			if($this->session->userdata("language")==""){ $this->session->set_userdata("language","english");}
			$this->lang->load($this->session->userdata("language"), 'english');
			$this->load->view("content/head");
		?>
		<?php 
			$message = $this->session->flashdata("message");
			if(is_array($message)){
				echo "<div class='container'><div class='col-sm-12'><div class='alert alert-".$message[0]."'>$message[1] <button type='button' class='close' data-dismiss='alert'><span aria-hidden=\"true\">&times;</span></button></div></div></div>";
			}
		?>
		<?php $this->load->view($content);?>
		<?php $this->load->view("content/footer");?>
		<script src="<?=base_url()?>assets/js/script.js"></script>
		<script type="text/javascript">

			
			
		</script>
	</body>
</html>