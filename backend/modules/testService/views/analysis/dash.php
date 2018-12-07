<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

$subjects = $lkSchool->getSubjects();
$exam = $lkSchool->getExamModel();
//$subjectTranslate = CommonFunction::getSubjects();

$this->title = $lkSchool->getSchool().">>".$exam->title.">>"."总体成绩";
$this->params['breadcrumbs'][] = '前10分析（表格显示不全时可以左右拖动）';
?>
<div class="testService-default-index">
<?=$this->render('include/nav_menu.php',['school'=>'市七中','exam'=>$exam])?>
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科成绩</a>       
    </li>
    <li role="presentation">
        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">文科成绩</a>      
    </li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content ">
    
    <div role="tabpanel" class="tab-pane active table-responsive" id="profile">
      <?= GridView::widget([
        'dataProvider' => $lkdataProvider,
        'filterModel' => $lksearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'stu_id',
            'stu_name',
            'stu_class',
            'stu_school',
            'yw',
            'ds',
            'yy',
            'wl',
            'hx',
            'sw',
            'zf',
            'mc',
        ],
    ]); 
    ?>
    <?=$this->render('school/bj_score',['Analysis'=>$lkSchool,'type'=>'lksc'])?>
    </div>
    <div role="tabpanel" class="tab-pane active table-responsive" id="messages">
      <?= GridView::widget([
        'dataProvider' => $wkdataProvider,
        'filterModel' => $wksearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'stu_id',
            'stu_name',
            'stu_class',
            'stu_school',
            'yw',
            'ds',
            'yy',
            'zz',
            'ls',
            'dl',
            'zf',
            'mc',
        ],
      ]); 
      ?>
      <?=$this->render('school/bj_score',['Analysis'=>$wkSchool,'type'=>'wksc'])?>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart1.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$("#messages").removeClass("active");
$('.dataTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
} );

</script>
<!-- <script>

$(document).ready(function() {
    if(location.hash) {
        $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
        //alert();
    });
});
$(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
});
</script> -->