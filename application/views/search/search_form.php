<?php 
	switch($this->router->fetch_class()){
		case "good":
			?>
			<div class="search-head">
				REFINE YOUR SEARCH
			</div>
			<div class="search-body clearfix">
				<form id="search-form-sidebar" method="GET" action="<?=base_url();?>good">
					<div class="col-sm-12 col-xs-6">
						<label>
							Keyword
						</label>
						<input id="keyword" name="keyword" type="text" placeholder="keyword" class="form-control input-md" value="<?=@$_GET['keyword']?>">
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Location
						</label>
						<select id="id_location" name="id_location" class="form-control input-md">
							<?php 
								$option = $this->datagood->getListLocation();
								$option[]  = (object)array("id_location" => "", "name_location" => "All Location");
								foreach($option as $key=>$val){
									if(@$_GET['id_location']==$val->id_location){
										echo "<option selected value='$val->id_location'>$val->name_location</option>";
									}else{
										echo "<option value='$val->id_location'>$val->name_location</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Category
						</label>
						<select id="id_category" name="id_category" class="form-control input-md">
							<?php 
								$option = $this->datagood->getListCategories();
								$option[]  = (object)array("id_item" => "", "name_item" => "All Categories");
								foreach($option as $key=>$val){
									if(@$_GET['id_category']==$val->id_item){
										echo "<option selected value='$val->id_item'>$val->name_item</option>";
									}else{
										echo "<option value='$val->id_item'>$val->name_item</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-12">
						<hr>
						<button type="submit" class="btn btn-orange">Search</button>
						<button type="reset" class="btn btn-red">Reset</button>
					</div>
				</form>
			</div>
		<?php 
		break;
		
		case "job":
		?>
			<div class="search-head">
				REFINE YOUR SEARCH
			</div>
			<div class="search-body clearfix">
				<form id="search-form-sidebar" method="GET" action="<?=base_url();?>job">
					<div class="col-sm-12 col-xs-6">
						<label>
							Keyword
						</label>
						<input id="keyword" name="keyword" type="text" placeholder="keyword" class="form-control input-md" value="<?=@$_GET['keyword']?>">
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Location
						</label>
						<select id="id_location" name="id_location" class="form-control input-md">
							<?php 
								$option = $this->datajob->getListLocation();
								$option[]  = (object)array("id_location" => "", "name_location" => "All Location");
								foreach($option as $key=>$val){
									if(@$_GET['id_location']==$val->id_location){
										echo "<option selected value='$val->id_location'>$val->name_location</option>";
									}else{
										echo "<option value='$val->id_location'>$val->name_location</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Job Category
						</label>
						<select id="id_category" name="id_category" class="form-control input-md">
							<?php 
								$option = $this->datajob->getListCategories();
								$option[]  = (object)array("id_job" => "", "name_job" => "All Categories");
								foreach($option as $key=>$val){
									if(@$_GET['id_category']==$val->id_job){
										echo "<option selected value='$val->id_job'>$val->name_job</option>";
									}else{
										echo "<option value='$val->id_job'>$val->name_job</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-12">
						<hr>
						<button type="submit" class="btn btn-orange">Search</button>
						<button type="reset" class="btn btn-red">Reset</button>
					</div>
				</form>
			</div>
		<?php
		break;
		
		case "forum":
		?>
			<div class="search-head">
				REFINE YOUR SEARCH
			</div>
			<div class="search-body clearfix">
				<form id="search-form-sidebar" method="GET" action="<?=base_url();?>forum">
					<div class="col-sm-12 col-xs-6">
						<label>
							Keyword
						</label>
						<input id="keyword" name="keyword" type="text" placeholder="keyword" class="form-control input-md" value="<?=@$_GET['keyword']?>">
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Thread Category
						</label>
						<select id="id_category" name="id_category" class="form-control input-md">
							<?php 
								$option = $this->datathread->getListCategories();
								$option[]  = (object)array("id_thread" => "", "name_thread" => "All Categories");
								foreach($option as $key=>$val){
									if(@$_GET['id_category']==$val->id_thread){
										echo "<option selected value='$val->id_thread'>$val->name_thread</option>";
									}else{
										echo "<option value='$val->id_thread'>$val->name_thread</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-12">
						<hr>
						<button type="submit" class="btn btn-orange">Search</button>
						<button type="reset" class="btn btn-red">Reset</button>
					</div>
				</form>
			</div>
		<?php
		break;

	case "auction":
			?>
			<div class="search-head">
				REFINE YOUR SEARCH
			</div>
			<div class="search-body clearfix">
				<form id="search-form-sidebar" method="GET" action="<?=base_url();?>auction">
					<div class="col-sm-12 col-xs-6">
						<label>
							Keyword
						</label>
						<input id="keyword" name="keyword" type="text" placeholder="keyword" class="form-control input-md" value="<?=@$_GET['keyword']?>">
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Location
						</label>
						<select id="id_location" name="id_location" class="form-control input-md">
							<?php 
								$option = $this->dataauction->getListLocation();
								$option[]  = (object)array("id_location" => "", "name_location" => "All Location");
								foreach($option as $key=>$val){
									if(@$_GET['id_location']==$val->id_location){
										echo "<option selected value='$val->id_location'>$val->name_location</option>";
									}else{
										echo "<option value='$val->id_location'>$val->name_location</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-6">
						<label>
							Category
						</label>
						<select id="id_category" name="id_category" class="form-control input-md">
							<?php 
								$option = $this->dataauction->getListCategories();
								$option[]  = (object)array("id_item" => "", "name_item" => "All Categories");
								foreach($option as $key=>$val){
									if(@$_GET['id_category']==$val->id_item){
										echo "<option selected value='$val->id_item'>$val->name_item</option>";
									}else{
										echo "<option value='$val->id_item'>$val->name_item</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-sm-12 col-xs-12">
						<hr>
						<button type="submit" class="btn btn-orange">Search</button>
						<button type="reset" class="btn btn-red">Reset</button>
					</div>
				</form>
			</div>
		<?php 
		break;
	}
?>