<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '考试情况对比';
$this->params['breadcrumbs'][] = ['label' => 'ana', 'url' => ['score']];
$this->params['breadcrumbs'][] = $this->title;

$classes = ArrayHelper::map($banji,'serial','title');
?>
<div class="student-create">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>

    <?=Html::dropDownList('class',$class,$classes,['class'=>'form-control'])?>

     <?= Html::submitButton('确定', ['class'=>'btn btn-success']) ?>
    </div>

        <?php ActiveForm::end(); ?>
  <div class="row">
    <div class="col-md-12">
      <hr>
    <H3>班级成绩统计</H3>
    
  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">班级成绩统计</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">  
            <tr><td>语文平均</td><td><?=round($avg['yw']['avg'],2)?>/<?=round($avg['yw']['grade'],2)?>(grade)</td>
                <td>数学平均</td><td><?=round($avg['ds']['avg'],2)?>/<?=round($avg['ds']['grade'],2)?></td>
                <td>英语平均</td><td><?=round($avg['ds']['avg'],2)?>/<?=round($avg['yy']['grade'],2)?></td></tr>
            <tr><td>物理平均</td><td><?=round($avg['wl']['avg'],2)?>/<?=round($avg['wl']['grade'],2)?></td>
                <td>生物平均</td><td><?=round($avg['sw']['avg'],2)?>/<?=round($avg['hx']['grade'],2)?></td>
                <td>化学平均</td><td><?=round($avg['sw']['avg'],2)?>/<?=round($avg['sw']['grade'],2)?></td></tr>
            <tr><td>政治平均</td><td><?=round($avg['zz']['avg'],2)?>/<?=round($avg['zz']['grade'],2)?></td>
                <td>历史平均</td><td><?=round($avg['ls']['avg'],2)?>/<?=round($avg['dl']['grade'],2)?></td>
                <td>地理平均</td><td><?=round($avg['dl']['avg'],2)?>/<?=round($avg['dl']['grade'],2)?></td></tr>
            <tr><td>总分平均</td><td><?=round($avg['zf']['avg'],2)?></td>
                <td>综合平均</td><td><?=round($avg['zhzf']['avg'],2)?></td></tr>
            </table>
        </div>
    <!-- /.box-body -->
  </div>

  <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">成绩正态分布</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="zfChart" style="height:450px"></canvas>
          </div>
        </div>
    <!-- /.box-body -->
  </div>

</div>
    <div class="col-md-12">
    <table class="table table-striped">
    <tr><th rowspan="2">序号</th><th rowspan="2">学号</th><th rowspan="2">姓名</th>
    	<th colspan="3">语文</th><th colspan="3">数学</th><th colspan="3">英语</th>
    <?php
      $now = current($score);
      $type = $now->wl||$now->hx||$now->sw;
      if($type){
          echo "<th colspan='3'>物理</th><th colspan='3'>化学</th><th colspan='3'>生物</th>";
      }else{
          echo "<th colspan='3'>政治</th><th colspan='3'>历史</th><th colspan='3'>地理</th>";
      }
    ?>  	
    	<th colspan='3'>综合总分</th><th colspan='3'>总分</th>
    </tr>
    <tr>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>
      <td>得分</td><td>名次</td><td>升降</td>

    </tr>
    <?php
    $i=1;
    	foreach ($score as $key => $value) {
    		echo "<tr><td>";
        echo $i++;
        echo "</td><td>";
    		echo $value->stu_id;
    		echo "</td><td>";
    		echo $value->name;
    		echo "</td><td>";
    		echo $value->yw;
    		echo "</td><td>";
        echo $order[$key]['yw']['N'];
        echo "</td><td>";
        echo $order[$key]['yw']['C'];
        echo "</td><td>";
    		echo $value->ds;
    		echo "</td><td>";
        echo $order[$key]['ds']['N'];
        echo "</td><td>";
        echo $order[$key]['ds']['C'];
        echo "</td><td>";
    		echo $value->yy;
        echo "</td><td>";
        echo $order[$key]['yy']['N'];
        echo "</td><td>";
        echo $order[$key]['yy']['C'];
        echo "</td><td>";
        if($type){
        echo $value->wl;
        echo "</td><td>";
        echo $order[$key]['wl']['N'];
        echo "</td><td>";
        echo $order[$key]['wl']['C'];
        echo "</td><td>";
        echo $value->hx;
        echo "</td><td>";
        echo $order[$key]['hx']['N'];
        echo "</td><td>";
        echo $order[$key]['hx']['C'];
        echo "</td><td>";
        echo $value->sw;
        echo "</td><td>";
        echo $order[$key]['sw']['N'];
        echo "</td><td>";
        echo $order[$key]['sw']['C'];
        echo "</td><td>";
        }else{
        echo $value->zz;
        echo "</td><td>";
        echo $order[$key]['zz']['N'];
        echo "</td><td>";
        echo $order[$key]['zz']['C'];
        echo "</td><td>";
        echo $value->ls;
        echo "</td><td>";
        echo $order[$key]['ls']['N'];
        echo "</td><td>";
        echo $order[$key]['ls']['C'];
        echo "</td><td>";
        echo $value->dl;
        echo "</td><td>";
        echo $order[$key]['dl']['N'];
        echo "</td><td>";
        echo $order[$key]['dl']['C'];
        echo "</td><td>";
        }


    		echo $value->getZHZF();
        echo "</td><td>";
        echo "</td><td>";
    		echo "</td><td>";
    		echo $value->getZF();
        echo "</td><td>";
        echo $order[$key]['zf']['N'];
        echo "</td><td>";
        echo $order[$key]['zf']['C'];
    		echo "</td></tr>";
    	}
    ?>

    </table>
</div>

</div>

</div>

<style type="text/css">
  th,td{
    text-align: center;
  }
</style>

<script src="plugins/chart/Chart.js"></script>
<script src="js/jquery.min.js"></script>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    }

     var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

        //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>