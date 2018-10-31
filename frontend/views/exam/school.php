<?php
use yii\helpers\Url;
use yii\bootstrap\Tabs;

function disTeacher($bj,$subject){
    if (isset($resTeacher[$bj][$subject])) {
      return $resTeacher[$bj][$subject];
    }else{
      return null; 
    }
}
$this->title = $exam->title.">>班级成绩分析>>".$school;
?>
<div class="testService-default-index">
<div class="row">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">理科平均及率</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">文科平均及率</a></li>
    <li role="presentation"><a href="#calcu" aria-controls="calcu" role="tab" data-toggle="tab">班级理科进步</a></li>
    <li role="presentation"><a href="#calca" aria-controls="calcu" role="tab" data-toggle="tab">班级达标统计</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科成绩</a></li>
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
    <div role="tabpanel" class="tab-pane active" id="home">
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
    <div role="tabpanel" class="tab-pane" id="settings">
      <?=$this->render('school/school_avg',[
            'school'=>$school,
            'exam'=>$exam->id,
            'bjs'=>$bjwk,
            'scwk'=>$scwk,
            'subjects'=>$wksubjects,
            'avgSchool'=>$avgwkSchool,
            'resTeacher'=>$resTeacher,
            'scAna'=>$scAnaw,
            'type'=>'wk',
            ])?>
    </div>
     <div role="tabpanel" class="tab-pane" id="calcu">
     <?=$this->render('school/up',[
      //'avgFloat'=>$avgFloatl,
      'scAna'=>$scAnal,
      'bjs'=>$bjlk,
      'resTeacher'=>$resTeacher,
      'subjects'=>$lksubjects,
     // 'lkuponline'=>$lkuponline,
      'type'=>'lk',
    ])?>
    </div>
     <div role="tabpanel" class="tab-pane" id="calca">
     <?=$this->render('school/linecount',[
      //'avgFloat'=>$avgFloatl,
      'scAna'=>$scAnal,
      'bjs'=>$bjlk,
      'resTeacher'=>$resTeacher,
      'subjects'=>$lksubjects,
      'lkuponline'=>$lkuponline,
      'type'=>'lk',
    ])?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
    <?=$this->render('school/bj_score',['sc'=>$sclk,'subjects'=>$lksubjects,'type'=>'lksc'])?>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
    <?=$this->render('school/bj_score',['sc'=>$scwk,'subjects'=>$wksubjects,'type'=>'wksc'])?>
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
} );

</script>