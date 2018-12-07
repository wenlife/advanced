<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

$subjects = $lkSchool->getSubjects();
$exam = $lkSchool->getExamModel();

$this->title = $lkSchool->getSchool().">>".$exam->title.">>"."进步率统计";
$this->params['breadcrumbs'][] = '进步率（表格显示不全时可以左右拖动）';

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
    <?=$this->render('school/up',[
      'Analysis'=>$lkSchool,
      'type'=>'lk',
    ])?>

    </div>
    <div role="tabpanel" class="tab-pane active" id="messages">
      <?=$this->render('school/up',[
      'Analysis'=>$wkSchool,
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

<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$("#messages").removeClass("active");
$('.dataTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
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