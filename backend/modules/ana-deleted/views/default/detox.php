<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
$this->title = '年级各班分数分布';
$this->params['breadcrumbs'][] = ['label' => 'ana', 'url' => ['score']];
$this->params['breadcrumbs'][] = $this->title;
//$top20 = array_slice($score,0,20);
function arrToString($arr,$is_num=false){
  $str = '[';
        $i=0;
        foreach ($arr as $key => $sbanji) {
          if ($i==0) {
            $i++;
          }else{
            $str.=',';
          }
          if ($is_num) {
          	$str.=$sbanji;
          }else{
          	$str.="'".$sbanji."'";
          }
          
        }
        $str.=']';
    return $str;
}
//$names = arrToString(ArrayHelper::map($top20,'id','name'));
?>
<div class="student-create">
    <?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
</div>

<div class="row">
	<div class='col-md-12'>
    <?php
      $sub_array['like']  = ['yw','ds','yy','wl','hx','sw'];
      $sub_array['wenke'] = ['yw','ds','yy','zz','ls','dl'];
      foreach ($sub_array as $k1 => $like) {
    ?>
    <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo  $k1=='like'?"理科班级成绩分布":"文科班级成绩分布";?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
              <?php
              
              echo "<tr><th>班级</th><th colspan=3 align=center>总分</th>";
              foreach ($like as $key => $subject) {
                echo "<th colspan=5>$subject</th>";
              }
              echo "</tr>";
              echo "<tr><th>班</th><th>班主任</th><th>最高</th><th>平均</th>";
              foreach ($like as $key => $subject) {
                echo "<th>教师</th><th>最高</th><th>平均</th><th>达标</th><th>有效</th>";
              }
              echo "</tr>";
              foreach ($banjis as $key => $banji) {
                if ($banji->type==($k1=='like'?1:2)) {
                $class = $banji->serial;
                echo "<tr><td>$class</td>";
                echo "<td>".$classAvg[$class]['zf']['teacher']."</td>
                      <td>".$classAvg[$class]['zf']['max']."</td>
                      <td>".round($classAvg[$class]['zf']['avg'],2)."</td>";

                foreach ($like as $k2 => $subject) {
                  echo "<td>".$classAvg[$class][$subject]['teacher']."</td>
                        <td>".$classAvg[$class][$subject]['max']."</td>
                        <td>".round($classAvg[$class][$subject]['avg'],2)."</td>
                        <td>".$classAvg[$class][$subject]['online']."</td>
                        <td>".$classAvg[$class][$subject]['safe']."</td>";
                  }

                }

              }      
              ?>  
            </table>
        </div>
    <!-- /.box-body -->
  </div>
  <?php
   }
  ?>
     
	</div>

  <?php

      foreach ($subjectArray as $key => $subject) {
        
        $banjiString[$subject] = '[';
        $avgString[$subject] = '[';
        $i=0;
        foreach ($banjis as $key => $banji) {
          if($banji->type==2){continue;}
          if($i==0)
          {
            $banjiString[$subject] .= "'".$banji->serial."/".$classAvg[$banji->serial][$subject]['teacher']."'";
            $avgString[$subject] .= round($classAvg[$banji->serial][$subject]['avg'],2);
            $i++;
          }else{
            $banjiString[$subject] .= ",'".$banji->serial."/".$classAvg[$banji->serial][$subject]['teacher']."'";
            $avgString[$subject] .= ",".round($classAvg[$banji->serial][$subject]['avg'],2);
          }
        }
        foreach ($banjis as $key => $banji) {
          if($banji->type==1)
          {
            continue;
          }
          if($i==0)
          {
            $banjiString[$subject] .= "'".$banji->serial."/".$classAvg[$banji->serial][$subject]['teacher']."'";
            $avgString[$subject] .= round($classAvg[$banji->serial][$subject]['avg'],2);
            $i++;
          }else{
            $banjiString[$subject] .= ",'".$banji->serial."/".$classAvg[$banji->serial][$subject]['teacher']."'";
            $avgString[$subject] .= ",".round($classAvg[$banji->serial][$subject]['avg'],2);
          }
        }
        $banjiString[$subject] .= "]";
        $avgString[$subject] .="]";
      }
      //echo $banjiString['yw'].$avgString['yw'];
  ?>
	<div class='col-md-12'>
    <?php
      foreach ($subjectArray as $key => $subject) {
    ?>
        <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title"><?=$subject?>平均分柱形图</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="<?=$subject?>" style="height:600px"></canvas>
          </div>
        </div>
    <!-- /.box-body -->
  </div>
  <?php } ?>
<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">全学科测试</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="canvas" style="height:530px"></canvas>
          </div>
        </div>
    <!-- /.box-body -->
  </div>

	</div>
</div>
<style type="text/css">
    td,th{
        text-align: center;
    }
</style>
<script src="js/jquery.min.js"></script>
<script src="http://www.chartjs.org/dist/2.7.1/Chart.bundle.js"></script>
<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
<script>
        var color = Chart.helpers.color;
        var barChartData = {
            labels: <?=$banjiString['yw']?>,
            datasets: [{
                label: 'yw',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['yw']?>
            }, {
                label: 'ds',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: <?=$avgString['ds']?>
            }]

        };
        var ywData = {
            labels: <?=$banjiString['yw']?>,
            datasets: [{
                label: 'yw',
                backgroundColor: color(window.chartColors.purple).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['yw']?>
            }]

        };
        var dsData = {
            labels: <?=$banjiString['ds']?>,
            datasets: [{
                label: 'ds',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['ds']?>
            }]

        };
        var yyData = {
            labels: <?=$banjiString['yy']?>,
            datasets: [{
                label: 'yy',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['yy']?>
            }]

        };
        var wlData = {
            labels: <?=$banjiString['wl']?>,
            datasets: [{
                label: 'wl',
                backgroundColor: color(window.chartColors.grey).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['wl']?>
            }]

        };
        var hxData = {
            labels: <?=$banjiString['hx']?>,
            datasets: [{
                label: 'hx',
                backgroundColor: color(window.chartColors.orange).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['hx']?>
            }]

        };
        var swData = {
            labels: <?=$banjiString['sw']?>,
            datasets: [{
                label: 'sw',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['sw']?>
            }]

        };
        var zzData = {
            labels: <?=$banjiString['zz']?>,
            datasets: [{
                label: 'zz',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['zz']?>
            }]

        };
        var lsData = {
            labels: <?=$banjiString['ls']?>,
            datasets: [{
                label: 'ls',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['ls']?>
            }]

        };
        var dlData = {
            labels: <?=$banjiString['dl']?>,
            datasets: [{
                label: 'dl',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: <?=$avgString['dl']?>
            }]

        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            var yw = document.getElementById("yw").getContext("2d");
            var yy = document.getElementById("yy").getContext("2d");
            var ds = document.getElementById("ds").getContext("2d");
            var wl = document.getElementById("wl").getContext("2d");
            var hx = document.getElementById("hx").getContext("2d");
            var sw = document.getElementById("sw").getContext("2d");
            var zz = document.getElementById("zz").getContext("2d");
            var ls = document.getElementById("ls").getContext("2d");
            var dl = document.getElementById("dl").getContext("2d");

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
            window.myBar = new Chart(yw, {
                type: 'bar',
                data: ywData,
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
            window.myBar = new Chart(ds, {
                type: 'bar',
                data: dsData,
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
            window.myBar = new Chart(yy, {
                type: 'bar',
                data: yyData,
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
            window.myBar = new Chart(wl, {
                type: 'bar',
                data: wlData,
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
            window.myBar = new Chart(hx, {
                type: 'bar',
                data: hxData,
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
            window.myBar = new Chart(sw, {
                type: 'bar',
                data: swData,
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
            window.myBar = new Chart(zz, {
                type: 'bar',
                data: zzData,
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
            window.myBar = new Chart(ls, {
                type: 'bar',
                data: lsData,
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
            window.myBar = new Chart(dl, {
                type: 'bar',
                data: dlData,
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



        };

</script>

