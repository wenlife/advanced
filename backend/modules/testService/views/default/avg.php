<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
$this->title = $school.">>".$exam->title.">>"."成绩分析";
?>
<div class="btn-group">
    <?= Html::a('总体成绩', ['dash','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('平均及率', ['avg','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('班级进步', ['improve','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('达标统计', ['beyondline','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('小分统计', ['testdetail','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('班级成绩', ['bj','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
</div>
<p></p>
<div class="testService-default-index">
<div class="row">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科成绩</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">文科成绩</a></li>
  </ul>
<style type="text/css">
	th,td{
		text-align: center;
		font-size: 12px;
	}
</style>
  <!-- Tab panes -->
  <div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="profile">

        <?=$this->render('school/school_avg',[
            'school'=>$school,
            'exam'=>$exam->id,
            'bjs'=>$bjlk,
           // 'sc'=>$sclk,
            'subjects'=>$lksubjects,
            'resTeacher'=>$resTeacher,
            'avgSchool'=>$avglkSchool,
            'scAna'=>$scAnal,
            'type'=>'lk',
            ]) ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
      <?=$this->render('school/school_avg',[
            'school'=>$school,
            'exam'=>$exam->id,
            'bjs'=>$bjwk,
           // 'scwk'=>$scwk,
            'subjects'=>$wksubjects,
            'avgSchool'=>$avgwkSchool,
            'resTeacher'=>$resTeacher,
            'scAna'=>$scAnaw,
            'type'=>'wk',
            ])?>
    </div>
  </div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart1.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$('.dataTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
  //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }]  
} );

</script>