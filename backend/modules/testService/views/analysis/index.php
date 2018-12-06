<?php
use yii\helpers\Url;
use yii\bootstrap\Tabs;
$exam  = $lkExam->getExamModel();
$this->title = $exam->title."--考试成绩分析";
$this->params['breadcrumbs'][] = '总体成绩分析（表格显示不全时可以左右拖动）';
?>
<div class="testService-default-index">
 <?php if (!Yii::$app->user->isGuest) {?>
 <p>
<a href="<?=Url::toRoute(['import','id'=>$exam->id])?>" class="btn btn-primary">导入成绩</a>
<a href="<?=Url::toRoute(['respond','id'=>$exam->id])?>" class="btn btn-primary">班级对应</a>
<a href="<?=Url::toRoute(['clean','id'=>$exam->id])?>" class="btn btn-danger" title="删除" aria-label="删除" data-pjax="0" data-confirm="您确定要删除此项吗？" data-method="post">清空成绩</a>
</p>
<?php }else{echo $this->render('include/nav_menu.php',['school'=>'市七中','exam'=>$exam]);}?>
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">理科统计</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">文科统计</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active table-responsive" id="home">
    
    <?=$this->render('include/exam_display.php',['Analysis'=>$lkExam])?>

    </div>
    <div role="tabpanel" class="tab-pane table-responsive" id="settings">
   <?=$this->render('include/exam_display.php',['Analysis'=>$wkExam])?>
    </div>
</div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$('.myTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
} );
</script>


 	
 