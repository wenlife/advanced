// 总分前10 
<!-- <table class='table table-bordered dataTable'>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>school</th>
        <th>class</th>
        <?php
            foreach ($subjects as $key => $subject) {
                echo "<th>$subject</th>";
            }
        ?>
        <th>MC</th>
    </tr>
 </thead>
 <tbody>
 <?php
foreach ($sc as $key => $data) {
    echo "<tr><td>";
    echo $data->stu_id;
    echo "</td><td>";
    echo $data->stu_name;
    echo "</td><td>";
    echo $data->stu_school;
    echo "</td><td>";
    echo $data->stu_class;
    echo "</td><td>";
    foreach ($subjects as $key => $subject) {
     echo $data->$subject;
     echo "</td><td>";
    }
    echo $data->mc;
    echo "</td></tr>";

}
 ?>
 </tbody>
 </table>
 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script type="text/javascript">

	var ctx2 = document.getElementById("<?=$type?>").getContext('2d');
    var dataTop = {
        labels: <?=$reName?>,//["xx","Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [
        <?php
          foreach ($subjects as $key => $subject) {  
        ?>
        {
            label: '<?=$subject?>',
            data: <?=$reTop[$subject]?>,//[132, 149, 63, 75, 62, 83],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(175, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 82, 255, 0.2)',
                'rgba(23, 102, 255, 0.2)',
                'rgba(153, 102, 222, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
        <?php
          }
        ?>
        ]
    };
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: dataTop,
    options: {
      responsive: true,
       legend: {
                position: 'top',
                },
        title: {
                 display: true,
                 text: '总分前10'
                },
        scales: {
            yAxes: [{
                ticks: {
                   // beginAtZero:false
                }
            }]
        }
    }
});

</script>




2 avg

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  <script type="text/javascript">
    var ctx = document.getElementById("<?=$type?>").getContext('2d');
    var dataAna = {
        labels: <?=trim(json_encode($bjs),'"')?>,
        datasets: [
        <?php
          foreach ($subjects as $key => $subject) {  
        ?>
        {
            label: '<?=$subject?>',
          //  labels:['1','2'],
            data: <?=$reArr[$subject]?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(175, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(153, 82, 255, 0.2)',
                'rgba(23, 102, 255, 0.2)',
                'rgba(153, 102, 222, 0.2)',
                'rgba(255, 169, 64, 0.2)',
                'rgba(205, 159, 164, 0.2)',
                'rgba(215, 59, 114, 0.2)',
                'rgba(235, 119, 64, 0.3)',
                'rgba(245, 159, 64, 0.4)',
                'rgba(64, 169, 64, 0.2)',
                'rgba(88, 179, 164, 0.2)',
                'rgba(99, 189, 64, 0.2)',
                'rgba(11, 199, 164, 0.2)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 1)',
                 'rgba(205, 159, 64, 0.2)',
                'rgba(215, 159, 64, 0.2)',
                'rgba(225, 159, 64, 0.2)',
                'rgba(235, 159, 64, 0.2)',
                'rgba(255, 169, 64, 0.2)',
                'rgba(255, 179, 64, 0.2)',
                'rgba(255, 189, 64, 0.2)',
                'rgba(255, 199, 64, 0.2)',
            ],
            borderWidth: 1
        },
        <?php }?>
        ]
    };
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: dataAna,
    options: {
      responsive: true,
       legend: {
                position: 'top',
                },
        title: {
                display: true,
                text: '平均分'
               },
        scales: {
            yAxes: [{
                ticks: {
                   // beginAtZero:false
                },
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"],
            }]
        }
    }
});
</script>


bj_score echarts



<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">前10名成绩柱形图</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <div id="<?=$type?>" style="width:1400px;height:800px;"></div>      
        </div>
    <!-- /.box-body -->
  </div>


<script type="text/javascript">
  var myChart = echarts.init(document.getElementById('<?=$type?>'),'light');
// 指定图表的配置项和数据
  var option = {
    title: {
        text: '总分前10'
    },
    tooltip: {},
    legend: {},
    xAxis: [{ 
      type:'category',
      position:'botttom',
      axisLabel:{interval: 0},
      data:<?=$reName?>,
    }],
    yAxis: {
      min:function(value){return value.min-5;},
    },
    series: [
    <?php
      foreach ($subjects as $key => $subject) {  
    ?>
    {
      name: '<?=$subject?>',
      type: 'bar',
      data: <?=$reTop[$subject]?>,
    },
    <?php
     }
    ?>
    ]
  };
// 使用刚指定的配置项和数据显示图表。
myChart.setOption(option);

</script>