<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

$subjects = $lkSchool->getSubjects();
$exam = $lkSchool->getExamModel();

$this->title = $school.">>".$exam->title.">>"."平均及率";
$this->params['breadcrumbs'][] = '平均及率（表格显示不全时可以左右拖动）';
echo $this->render('include/nav_menu.php',['school'=>$lkSchool->getSchool(),'exam'=>$exam]);
?>

<div class="testService-default-index">
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科成绩</a></li>
  <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">文科成绩</a></li>
</ul>
<!-- Tab panes -->
<!--startprint-->
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
  <div role="tabpanel" class="tab-pane active" id="messages">
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
<!--endprint-->
</div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart1.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$("#messages").removeClass("active");
$('.dataTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
  //"aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }]  
} );

</script>
<script language=javascript>
function doPrint() {
$('.charts').hide();
$("#messages").addClass("active");
bdhtml=window.document.body.innerHTML;

sprnstr="<!--startprint-->";
eprnstr="<!--endprint-->";
prnhtml=bdhtml.substr(bdhtml.indexOf(sprnstr)+17);
prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));
window.document.body.innerHTML=prnhtml;
window.print();
}
</script>
<a href="javascript:;" onClick="doPrint()">【打印】</a>