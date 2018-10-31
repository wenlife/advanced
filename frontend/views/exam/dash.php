<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
$this->title = $school.">>".$exam->title.">>"."成绩分析";
?>
<div class="testService-default-index">
<div class="btn-group">
<?= Html::a('总体成绩', ['dash','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-primary']) ?>
<?= Html::a('平均及率', ['avg','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
<?= Html::a('班级进步', ['improve','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
<?= Html::a('达标统计', ['beyondline','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
<?= Html::a('小分统计', ['testdetail','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
<?= Html::a('班级成绩', ['bj','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
</div>
<p></p>
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">理科成绩</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">文科成绩</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    
    <div role="tabpanel" class="tab-pane active" id="profile">
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
    <?=$this->render('school/bj_score',['sc'=>$sclk,'subjects'=>$lksubjects,'subjectmax'=>$subjectmaxlk,'type'=>'lksc'])?>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
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
      <?=$this->render('school/bj_score',['sc'=>$scwk,'subjects'=>$wksubjects,'subjectmax'=>$subjectmaxwk,'type'=>'wksc'])?>
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
$('.dataTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
} );
</script>

<script>

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
</script>