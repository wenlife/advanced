<!-- 
本页面负责展示理科成绩的图表
需要传入的数据有：
以下内容直接传入PHP数组
'xAx'=> //默认的x轴数据
'subjects'=> //需要展示的各个科目
'xData'=> //展示的数据
'xArray'=> //只剩单列的时候每个科目的X轴
 -->
<?php
if (!isset($title)) {
  $title = 'charts图表';
}
?>

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title"><?=$title?><small>(点击相应科目的颜色块可取消或显示相应科目的柱形图)</small></h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool"  id="max" ><i class="fa fa-window-maximize"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="chart"><div id="chartlk" style="width:100%;height:800px;"></div></div>
  </div>
</div>
<script src="js/echarts.js"></script>
<script type="text/javascript">
  var myChartlk = echarts.init(document.getElementById('chartlk'));
// 指定图表的配置项和数据
  var option = {
    title: {
      //text: '<?=$title?>'
    },
    tooltip: {},
    legend: {},
    xAxis: [{ 
      type:'category',
      position:'botttom',  
      splitLine:{show:true},
      data:<?=trim(json_encode($xAx),'"')?>,
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
      type: 'line',
      data: <?=trim(json_encode($xData[$subject]),'"')?>,
    },
    <?php
     }
    ?>
    ]
  };
// 使用刚指定的配置项和数据显示图表。
myChartlk.setOption(option);

myChartlk.on('legendselectchanged',function(params){

myChartlk.setOption(
    {
      xAxis:{
        type:'category',
        position:'botttom',
        axisLabel:{
          interval: 0,
          rotate:-45,
          },
        data:datax,
      },
    }
  );

});

myChartlk.dispatchAction({
  type:'legendToggleSelect',
  name:'zf',
});
var myBtn=document.getElementById("max");
    myBtn.onclick=function(){
       myChartlk.resize({
        width:'1600',
        height:'800',
       })
    }
</script>