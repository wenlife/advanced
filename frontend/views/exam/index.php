<?php
use yii\helpers\Html;
$this->title = '考试';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
			  <h3 class="box-title">考试</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
		  		<table class="table table-bordered">
					<tr><td>编号</td><td>标题</td><td>年级</td><td>日期</td><td>查看</td></tr>
				<?php 
                     foreach ($exams as $key => $exam) {
                     	echo "<tr><td>";
                     	echo $exam->id;
                     	echo "</td><td>";
                     	echo $exam->title;
                     	echo "</td><td>";
                     	echo $exam->stu_grade;
                     	echo "</td><td>";
                     	echo $exam->date;
                     	echo "</td><td>";
                     	echo Html::a('查看分析',['/exam/dash','exam'=>$exam->id,'school'=>'市七中'],['title'=>'添加']);
                     }
				 ?>
				</table>
			</div>
			<!-- /.box-body -->
			</div>

	</div>
</div>
</div>
