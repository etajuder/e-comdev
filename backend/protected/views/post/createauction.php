<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Auction', 'url'=>array('auctions')),
);
?>

<h1>Create Auction</h1>
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
        
 $('#multi-field4'+jum).append('<button id="remove'+jum+'" onclick="remove_foto('+jum+')"> remove </button>');
        
        var del = jum-1;
           $(".multi-field-wrapper4").find("#remove"+del+"").remove();
           $('#jum_foto').val(jum);
    });


})
 
    });
               function remove_foto(data){
    $("#multi-field4"+data+"").remove();
     $('#multi-field4'+(data-1)).append('<button id="remove'+(data-1)+'" onclick="remove_foto('+(data-1)+')"> remove </button>');
     $("#jum_foto").val((data-1));
      var count =  $("#jum_foto").val();
    }
</script>
<?php $this->renderPartial('_formauction', array('model'=>$model)); ?>