
<?php
use yii\widgets\ActiveForm;
?>
<link rel="stylesheet" href="css/style2.css" type="text/css" />
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script> 
<script type="text/javascript" src="js/cropbox.js"></script>
<div class="row">

<div class="col-sm-3" style="border:1px solid #ccc">
   <hr style="width:100%">
</div>
<div class="col-sm-9">

<div class="container avatar">
  <div class="imageBox">
    <div class="thumbBox"></div>
    <div class="spinner" style="display: none">Loading...</div>
  </div>
  <div class="action"> 
    <!-- <input type="file" id="file" style=" width: 200px">-->
    <div class="new-contentarea tc"> <a href="javascript:void(0)" class="upload-img">
      <label for="upload-file">上传图像</label>
      </a>



<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','id'=>'form1']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput(['id'=>'upload-file']) ?>
    
    <button id="submit">Submit</button>

<?php ActiveForm::end() ?>

    </div>
    <input type="button" id="btnCrop"  class="Btnsty_peyton" value="裁切">
    <input type="button" id="btnZoomIn" class="Btnsty_peyton" value="+"  >
    <input type="button" id="btnZoomOut" class="Btnsty_peyton" value="-" >
  </div>
  <div class="cropped"></div>
</div>
<script type="text/javascript">
$(window).load(function() {
	var options =
	{
		thumbBox: '.thumbBox',
		spinner: '.spinner',
		imgSrc: 'images/avatar.png'
	}
	var cropper = $('.imageBox').cropbox(options);
	$('#upload-file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(e) {
			options.imgSrc = e.target.result;
			cropper = $('.imageBox').cropbox(options);
		}
		reader.readAsDataURL(this.files[0]);
		this.files = [];
	})
	$('#btnCrop').on('click', function(){
		
		var img = cropper.getDataURL();
		$('.cropped').html('');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:64px;margin-top:4px;border-radius:64px;box-shadow:0px 0px 12px #7E7E7E;" ><p>64px*64px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:128px;margin-top:4px;border-radius:128px;box-shadow:0px 0px 12px #7E7E7E;"><p>128px*128px</p>');
		$('.cropped').append('<img src="'+img+'" align="absmiddle" style="width:180px;margin-top:4px;border-radius:180px;box-shadow:0px 0px 12px #7E7E7E;"><p>180px*180px</p>');

	})
	$('#btnZoomIn').on('click', function(){
		cropper.zoomIn();
	})
	$('#btnZoomOut').on('click', function(){
		cropper.zoomOut();
	})

	$('#submit').on('click',function(){
		var formData = new FormData($("#form1")[0]);
		alert(cropper.getCroppedCanvas());  
		$().cropper('getCroppedCanvas').toBlob(function (blob) {
			 // var formData = new FormData();
			  formData.append('imageFile', blob);
			  alert(2);
			});
		alert(1);
	})
});


function submitForm(){  
       // $("#form1").attr("enctype","multipart/form-data");  
          
        var formData = new FormData($("#form1")[0]);  
        formData.append("imgBase64",encodeURIComponent(fileImg));//  
        formData.append("fileFileName","photo.jpg");  
          
          
        $.ajax({    
            url: "",  
            type: 'POST',    
            data: formData,    
            timeout : 10000, //超时时间设置，单位毫秒  
            async: true,    
            cache: false,    
            contentType: false,    
            processData: false,   
            success: function (result) {   
            },    
            error: function (returndata) {  
            }  
        });  
    }  
</script>

</div>
<div style="text-align:center;margin:50px 0; font:normal 14px/24px 'MicroSoft YaHei';">
<p>适用浏览器：IE8、360、FireFox、Chrome、Safari、Opera、傲游、搜狗、世界之窗.</p>
</div>
</div>

