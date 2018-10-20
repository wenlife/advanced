<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

$this->title = '试卷分析';
?>
<div class="row">
<div class="col-md-8">
 <div class="box box-success">
	<div class="box-header with-border">
	  <h3 class="box-title"><?=$test->title?>-练习答案</h3>
	  <div class="box-tools pull-right">
	    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body">
	<?php 
	    $order = 0;
	    foreach ($itemsAllType as $typeKey => $items) {
	        foreach ($items as $itemKey => $item) {
	            if ($item->getViewName()=='mmo') {
	            	$order+=4;
	            }else{
	            	$order++;
	            }
		    echo $this->render('../item/display/'.$item->getViewName(),['order'=>$order,'model'=>$item]);
			}
		}
	?>
	</div>
</div>
</div>
<div class="col-md-4">
 <div class="box box-success">
	<div class="box-header with-border">
	  <h3 class="box-title">
	  	<?php $form = ActiveForm::begin(['method'=>'post','options'=>['class'=>'form-inline']]); ?>
		<?=Html::dropDownList('class',$class,ArrayHelper::map($classes,'id','title'),['prompt' => '请选择班级','class'=>'form-control','style'=>'width:150px'])?>
		<button type="submit" class="btn btn-primary">查询</button>
		 <?php ActiveForm::end(); ?>
	  </h3>

	  <div class="box-tools pull-right">
	    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	  </div>
	</div>
	<div class="box-body no-padding">
	    <table class="table table-bordered" id="myTable">
	    <thead>
	    <tr><td>账号</td><td>姓名</td><td>得分</td></tr>
	    </thead>
	    <tbody>
		<?php
			foreach ($students as $key => $student) {
				echo "<tr><td>";
				echo $student->username;
				echo "</td><td>";
				echo $student->name;
				echo "</td><td>";
				echo $scores[$student->username];
				echo "</td></tr>";
			}
		?>
		</tbody>
		</table>
	</div>
	<!-- /.box-body -->
	</div>
</div>
</div>
<link href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$('#myTable').DataTable({
	'jqueryUI' :true,
  'paging'      : false,
  'lengthChange': false,
  'searching'   : false,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : false,
});
</script>

<style type="text/css">
label{
    font-weight: normal;
    width:100%;
    text-indent: 20px;
    line-height: 25px;
}
label>input{
    margin-right: 20px;
    width:30px;
}
label:hover{
    background-color:white;
}
thead{
	background: rgb(67,142,219);
	color:white;
}
</style>