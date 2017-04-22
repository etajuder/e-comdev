<?php
	switch($this->router->fetch_class()){
		default:
			$model_class = "good";
		break;
		case "good":
			$model_class = "good";
		break;
		
		case "job":
			$model_class = "job";
		break;

                case "auction":
			$model_class = "auction";
		break;
	}
?>
<div class="block-white">
	<h3><i class="ion-ios-location mediumsize"></i>Hot Locations</h3>
	<?php 
		$locations = $this->datalocation->getHotLocation(0,18);
		foreach($locations as $key=>$val){
			?>
			<a href="<?=base_url();?><?=$model_class?>?keyword=&id_location=<?=$val->id_location?>&id_category=" class="city-tag"><?=$val->name_location?></a>
			<?php
		}
	?>
</div>