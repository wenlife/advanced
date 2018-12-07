<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$subjects = $lkSchool->getSubjects();
$exam = $lkSchool->getExamModel();
$line_name = ['line1'=>'重本任务','line2'=>'重本目标','line3'=>'本科任务','line4'=>'本科目标'];
$this->title = $lkSchool->getSchool().">>".$exam->title.">>".$line_name[$linetype];
$this->params['breadcrumbs'][] = '达标率（表格显示不全时可以左右拖动）';
echo $this->render('include/nav_menu.php',['school'=>$lkSchool->getSchool(),'exam'=>$exam]);
?>
<?php $form = ActiveForm::begin(['method'=>'post','options'=>['class'=>'form-inline']]); ?>
  <div class="form-group">
    <div class="input-group">
      <?=Html::DropDownList('linetype',$linetype,['line1'=>'重本指标','line2'=>'重本目标','line3'=>'本科指标','line4'=>'本科目标'],['class'=>'form-control'])?>
    </div>
  </div>
  <button type="submit" class="btn btn-success">查询</button>
<?php ActiveForm::end(); ?>
<p></p>
<div class="testService-default-index">
<div class="row">
  <div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
  <!-- Tab panes -->
  <!--startprint-->
  <div class="tab-content">
    
    <?=$this->render('school/linecount',[
          'Analysis'=>$lkSchool,
          'type'=>'lk',
        ])?>
        <?=$this->render('school/linecount',[
          'Analysis'=>$wkSchool,
          'type'=>'wk',
        ])?>

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
} );

</script>
<script language=javascript>
function doPrint() {
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