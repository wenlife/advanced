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

$top20 = array_slice($score,0,20);
function arrToString($arr,$subject,$is_num=true){
  $str = '[';
        $i=0;
        foreach ($arr as $key => $sbanji) {
          if ($i==0) {
            $i++;
          }else{
            $str.=',';
          }
          if ($is_num) {
            $str.=$sbanji->$subject;
          }else{
            $str.="'".$sbanji->stuinfo->class."/".$sbanji->$subject."'";
          }
          
        }
        $str.=']';
    return $str;
}
$names = arrToString($top20,'name',false);
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
<?=Html::dropDownList('type',$type,$classType,['class'=>'form-control'])?>
<?= Html::submitButton('确定', ['class'=>'btn btn-success']) ?>
<?php ActiveForm::end();?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">平均分柱形图</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="canvas" style="height:800px"></canvas>
              </div>
            </div>
        <!-- /.box-body -->
        </div>
    </div>
	<div class='col-md-12'>



    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">前20名分科曲线图</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
           <table class="table table-bordered">
     	<tr ><th rowspan=2>序号</th><th rowspan=2>姓名</th><th rowspan=2>班级</th>
             <th colspan=3>语文</th><th colspan=3>数学</th><th colspan=3>英语</th>
        
     	<?php
     	   $num1 = current($score);
     	   if($num1->wl!=null&&$num1->hx!=null&&$num1->sw!=null)
     	   {
     	   		echo "<th colspan=3>物理</th><th colspan=3>化学</th><th colspan=3>生物</th>";
     	   }

     	   if($num1->zz!=null&&$num1->ls!=null&&$num1->dl!=null)
     	   {
     	   		echo "<th colspan=3>政治</th><th colspan=3>历史</th><th colspan=3>地理</th>";
     	   }
     	?>

     	<th colspan=3>总分</th></tr>
         <?php
            echo "<tr>";
            for ($i=0; $i <7 ; $i++) { echo "<th>得分</th><th>名次</th><th>升降</th>";}
            echo "</tr>";
     	    $i=1;
     	   foreach ($score as $key => $value) {

               //判断该同学是否适合进行名词升降排序
     	   	 echo "<tr><td>";
     	   	 echo $i++;
     	   	 echo "</td><td>";
     	   	 echo $value->name;
     	   	 echo "</td><td>";
     	   	 echo $value->stuinfo->class;
     	   	 echo "</td><td>";
     	   	 echo $value->yw;
     	   	 echo "</td><td>".$scoreOrder[$key]['yw']['N']."</td><td class='c'>".$scoreOrder[$key]['yw']['C']."</td><td>";
             echo $value->ds;
     	   	 echo "</td><td>".$scoreOrder[$key]['ds']['N']."</td><td class='c'>".$scoreOrder[$key]['ds']['C']."</td><td>";
     	   	 echo $value->yy;
             echo "</td><td>".$scoreOrder[$key]['yy']['N']."</td><td class='c'>".$scoreOrder[$key]['yy']['C']."</td><td>";
     	   	 if($value->wl!=null)
     	   	 {
         	   	 echo $value->wl;
                 echo "</td><td>".$scoreOrder[$key]['wl']['N']."</td><td class='c'>".$scoreOrder[$key]['wl']['C']."</td><td>";
         	   	 echo $value->hx;
                 echo "</td><td>".$scoreOrder[$key]['hx']['N']."</td><td class='c'>".$scoreOrder[$key]['hx']['C']."</td><td>";
         	   	 echo $value->sw;
                 echo "</td><td>".$scoreOrder[$key]['sw']['N']."</td><td class='c'>".$scoreOrder[$key]['sw']['C']."</td><td>";
     	   	}   
     	   	if($value->zz!=null)
     	   	{
         	   	echo $value->zz;
                echo "</td><td>".$scoreOrder[$key]['zz']['N']."</td><td class='c'>".$scoreOrder[$key]['zz']['C']."</td><td>";
         	   	echo $value->ls; 
                echo "</td><td>".$scoreOrder[$key]['ls']['N']."</td><td class='c'>".$scoreOrder[$key]['ls']['C']."</td><td>";
         	   	echo $value->dl;
                echo "</td><td>".$scoreOrder[$key]['dl']['N']."</td><td class='c'>".$scoreOrder[$key]['dl']['C']."</td><td>";
     	   	}
     	   	echo $value->zf;
            //echo "</td><td>".(array_search($value->zf, $compare['zf'])+1)."</td><td></td></tr>";
            echo "</td><td>".$scoreOrder[$key]['zf']['N']."</td><td class='c'>".$scoreOrder[$key]['zf']['C']."</td><td>";
     	   }
     	?>
     </table>
        </div>
    <!-- /.box-body -->
  </div>
     
	</div>

</div>
<style type="text/css">
  td, th{
        line-height: 100%;
        text-align: center;
        vertical-align: center;
    };
  td.c{
    border-right: 2px solid $ccc;
  }
</style>
<script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
<script>
    
        var color = Chart.helpers.color;
        var barChartData = {
            labels: <?=$names?>,
            datasets: [{
                label: 'yw',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=arrToString($top20,'yw');?>
            }, {
                label: 'ds',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: <?=arrToString($top20,'ds');?>
            }, {
                label: 'yy',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: <?=arrToString($top20,'yy');?>
            }

            <?php
              if($type==1){
            ?>
            , {
                label: 'wl',
                backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                borderColor: window.chartColors.purple,
                borderWidth: 1,
                data: <?=arrToString($top20,'wl');?>
            }, {
                label: 'hx',
                backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                borderColor: window.chartColors.orange,
                borderWidth: 1,
                data: <?=arrToString($top20,'hx');?>
            }, {
                label: 'sw',
                backgroundColor: color(window.chartColors.gray).alpha(0.5).rgbString(),
                borderColor: window.chartColors.gray,
                borderWidth: 1,
                data: <?=arrToString($top20,'sw');?>
            }
        <?php }else{ ?>
            , {
                label: 'zz',
                backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                borderColor: window.chartColors.purple,
                borderWidth: 1,
                data: <?=arrToString($top20,'zz');?>
            }, {
                label: 'ls',
                backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                borderColor: window.chartColors.orange,
                borderWidth: 1,
                data: <?=arrToString($top20,'ls');?>
            }, {
                label: 'dl',
                backgroundColor: color(window.chartColors.gray).alpha(0.5).rgbString(),
                borderColor: window.chartColors.gray,
                borderWidth: 1,
                data: <?=arrToString($top20,'dl');?>
            }
        <?php } ?>
            ]
        };
      

        window.onload = function() {
            var ctx= document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: '平均分'
                    }
                }
            });

            $('.c').each(function(i){
                var x = $(this).text();
                if(x>0)
                {
                    $(this).html("<td><span class='glyphicon glyphicon-arrow-up' style='color:green'></span> "+x+"</td>");
                }
                if(x<0){
                    x= Math.abs(x);
                    $(this).html("<td><span class='glyphicon glyphicon-arrow-down' style='color:red'></span> "+x+"</td>");
                }
                if(x==0){
                     $(this).html("<td><span class='glyphicon glyphicon glyphicon-heart' style='color:blue'></span> "+x+"</td>");
                }
            });


        };

</script>


