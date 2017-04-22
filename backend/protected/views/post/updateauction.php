<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title=>array('view','id'=>$model->id_post),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Auction', 'url'=>array('createauction')),
	array('label'=>'View Auction', 'url'=>array('view', 'id'=>$model->id_post)),
	array('label'=>'Manage Auction', 'url'=>array('auctions')),
);
?>

<h1>Update Post <?php echo $model->id_post; ?></h1>
<script type="text/javascript">
    $(document).ready(function(){
        $('.multi-field-wrapper4').each(function() {
    var $wrapper = $('.multi-fields4', this);
    $("#add-foto").click(function(e) {
        var jum2 =  parseInt($('#jum_foto').val(), 10);
        var jum = (jum2 + 1);
        $($wrapper).append('<div id="multi-field4'+jum+'" class="multi-field4">'+
        	'  <label  class="multi-input" >foto#'+jum+'</label>'+
        	' <input type="file"  class="multi-input4" name="foto'+jum+'" required>'+
        	' <label class="multi-input"> Deskripsi </label>'+
          	'<input type="text" name="deskripsi[]" class="multi-input">  </div>');
        
 $('#multi-field4'+jum).append('<button id="remove'+jum+'" onclick="remove_foto('+jum+')"> <i class="icon-remove"></i> </button>');
        
        var del = jum-1;
           $(".multi-field-wrapper4").find("#remove"+del+"").remove();
           $('#jum_foto').val(jum);
    });


})
 
    });
               function remove_foto(data){
    $("#multi-field4"+data+"").remove();
     $('#multi-field4'+(data-1)).append('<button id="remove'+(data-1)+'" onclick="remove_foto('+(data-1)+')"> <i class="icon-remove"></i> </button>');
     $("#jum_foto").val((data-1));
      var count =  $("#jum_foto").val();
    }
</script>



 
<div class="modal fade" id="modalcreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Images Add</h4>
			</div>
			<div class="modal-body">
				<?php echo CHtml::beginForm(Yii::app()->request->baseUrl.'/Post/uploadImage', 'post',array('enctype'=>'multipart/form-data' )) ?>
					<input type="file" name="foto">
					<input type="hidden" value="<?=$model->id_post;?>" name="id_post">
					<input type="text" name="deskripsi" placeholder="description">
					 <div class="modal-footer">
					   <input type="submit" value="simpan">
  					</div>
				 <?php echo CHtml::endForm() ; ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
function editimage(id,deskripsi){
	$('#modalupdate').modal('show');
	$('#id_image').val(id);
	$('#deskripsi').val(deskripsi);	
}
</script>
<div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Images Update</h4>
			</div>
			<div class="modal-body">
				<?php echo CHtml::beginForm(Yii::app()->request->baseUrl.'/Post/updateImage', 'post',array('enctype'=>'multipart/form-data' )) ?>
					<input type="file" name="foto">
					<input type="hidden" value="<?=$model->id_post;?>" name="id_post">
					<input type="hidden" value="" id="id_image" name="id_image">
					<label>Deskripsi</label>
					<input type="text" name="deskripsi" id="deskripsi" placeholder="description">
					 <div class="modal-footer">
					   <input type="submit" value="simpan">
  					</div>
				 <?php echo CHtml::endForm() ; ?>
			</div>
		</div>
	</div>
</div>

<?php $this->renderPartial('_formupdateauction', array('model'=>$model,'foto'=>$foto)); ?>