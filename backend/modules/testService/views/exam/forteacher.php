<?php
use yii\helpers\Html;
$this->title = '考试';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                该网站成绩分析结果仅供参考，最终结果以年级发布为准
              </div>
<div class="row">
	<div class="col-xs-12 col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
			  <h3 class="box-title">考试选择</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
		  		<table class="table table-striped table-hover table-bordered">
		  		<thead>
					<tr  class='active'><td>编号</td><td>标题</td><td>年级</td><td>日期</td><td>查看</td></tr>
				</thead>
				<tbody>
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
                     	echo Html::a('<i class="fa fa-play"></i>点击查看',['/testService/analysis/index','id'=>$exam->id],['title'=>'添加','class'=>"btn bg-olive"]);
                     }
				 ?>
				</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			</div>

	</div>
</div>
</div>