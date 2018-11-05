<!-- 
本页面负责展示文科成绩的图表
需要传入的数据有：
'xAx'=> //默认的x轴数据
'subjects'=> //需要展示的各个科目
'xData'=> //展示的数据
'xArray'=> //只剩单列的时候每个科目的X轴
以下内容直接传入PHP数组
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <div id="chartwk" style="width:100%;height:800px;"></div>
            
          </div>
        </div>
    <!-- /.box-body -->
  </div>
<script src="js/echarts.js"></script>
<script type="text/javascript">
  var myChartwk = echarts.init(document.getElementById('chartwk'),'light');
// 指定图表的配置项和数据
  var option = {
    title: {
       // text: '<?=$title?>'
    },
    tooltip: {},
    legend: {
       // data:['销量']
    },
    xAxis: [{ 
      type:'category',
      position:'botttom',  
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
      type: 'bar',
      data: <?=trim(json_encode($xData[$subject]),'"')?>,
    },
    <?php
     }
    ?>
    ]
  };
// 使用刚指定的配置项和数据显示图表。
myChartwk.setOption(option);
myChartwk.on('legendselectchanged',function(params){
  yw = params.selected.yw;
  yy = params.selected.yy;
  ds = params.selected.ds;
  zz = params.selected.zz;
  ls = params.selected.ls;
  dl = params.selected.dl;

  if (yw&&!yy&&!ds&&!zz&&!ls&&!dl) {
     datax = <?=trim(json_encode($xArray['yw']),'"')?>
    //datax = ['S','N','c','d','e','f','g','h','i','j'];
    }else if(!yw&&yy&&!ds&&!zz&&!ls&&!dl){
        datax = <?=trim(json_encode($xArray['yy']),'"')?>;
    }else if(!yw&&!yy&&ds&&!zz&&!ls&&!dl){
        datax = <?=trim(json_encode($xArray['ds']),'"')?>;
    }
    else if(!yw&&!yy&&!ds&&zz&&!ls&&!dl){
        datax = <?=trim(json_encode($xArray['zz']),'"')?>;
    }
    else if(!yw&&!yy&&!ds&&!zz&&ls&&!dl){
        datax = <?=trim(json_encode($xArray['ls']),'"')?>;
    }
    else if(!yw&&!yy&&!ds&&!zz&&!ls&&dl){
        datax = <?=trim(json_encode($xArray['dl']),'"')?>;
    }
    else{
        datax = <?=trim(json_encode($xAx),'"')?>;
    }

  //alert(params.selected.yw);

    myChartwk.setOption(
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
myChartwk.dispatchAction({
  type:'legendToggleSelect',
  name:'zf',
});
</script>