<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use backend\libary\CommonFunction;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$subjects = $Analysis->getSubjects();
$exam = $Analysis->getExamModel();
$school = $Analysis->getSchool();
$this->title = $Analysis->getSchool().'-'.$Analysis->getClass().'-'.$exam->title.'-'."班级成绩";
echo $this->render('include/nav_menu.php',['school'=>$school,'exam'=>$exam]);
?>
<div class="testService-default-index">
 <?php $form = ActiveForm::begin(['action'=>['/testService/analysis/bj','exam'=>$exam->id,'school'=>$school],'method'=>'get','options'=>['class'=>'form-inline']]); ?>
  <div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
    <div class="input-group">
    <div class="input-group-addon">选择班级</div>
    <?=Html::dropDownList('bj',$bj,$bjarr,['class'=>'form-control'])?>  
    </div>
  </div>
  <button type="submit" class="btn btn-primary">查询</button>
  <?php ActiveForm::end(); ?>

  <?=Html::a('导出成绩',['bj','school'=>$school,'exam'=>$exam->id,'bj'=>$bj,'export'=>'1'],['class'=>'btn btn-success pull-right'])?>

<style type="text/css">

	th,td{
		text-align: center;
		font-size: 12px;
	}
	th{
		background-color: #ccc;
	}
	.sub{
		background: rgb(230,230,250);
	}
</style>
<div class="row">
<div class="col-md-12 col-xs-12">
<div class="nav-tabs-custom">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
  	<li role="presentation"  class="active"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">班级成绩</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">统计曲线</a></li>
    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">成绩统计</a></li>

  </ul>


  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="home">
        <small><内容待定></small>
    </div>
    <div role="tabpanel" class="tab-pane active" id="settings">
    <?php
    // 本页面负责展示理科成绩的图表
    // 需要传入的数据有：
    // 以下内容直接传入PHP数组
    // 'xAx'=> //默认的x轴数据
    // 'subjects'=> //需要展示的各个科目
    // 'xData'=> //展示的数据
    // 'xArray'=> //只剩单列的时候每个科目的X轴


    // echo $this->render('school/chartDistribution',[
    //      'title'=>'班级成绩分布',
    //     'xAx'=>range(0,150,2),
    //     'subjects'=>$subjects,
    //     'xData'=>$x,
    // ]); 

    ?>

    </div>
<div role="tabpanel" class="tab-pane active" id="messages">
<!--startprint-->
<div class="table-responsive">
<table class='table table-bordered table-hover myTable' style="width:100%">
 	<thead>
 	<tr>
 		<th rowspan="2">编号</th>
 <!-- 		<th rowspan="2">考号</th> -->
 		<th rowspan="2">姓名</th>
 	<!-- 	<th rowspan="2">学校</th> -->
 		<th rowspan="2">班级</th>
 		<?php
            foreach ($subjects as $key => $subject) {
               echo "<th colspan='3'>".CommonFunction::getSubjects()[$subject]."</th>";
            }
 	           echo "</tr><tr>";
 	       foreach ($subjects as $key => $subject) {
 	       	   echo "<th>得分</th><th>排名</th><th>升降</th>";
 	       }
 	    ?>
 	</tr>
 </thead>
 <tbody>
 <?php
 $i=1;
$floatArr = $Analysis->getOrder();
//var_export($floatArr);
//exit();
foreach ($Analysis->getData() as $key => $data) {

	echo "<tr><td>";
	echo $i++;
	echo "</td><td>";
	// echo $data->stu_id;
	// echo "</td><td>";
	echo ArrayHelper::getValue($data,"stu_name");
	echo "</td><td>";
	// echo $data->stu_school;
	// echo "</td><td>";
	echo ArrayHelper::getValue($data,"stu_class");
  $username = ArrayHelper::getValue($data,"stu_id");
  $myOrder = ArrayHelper::getValue($floatArr,"$username");
	
	foreach ($subjects as $key => $subject) {
		$var = $key%2;
		$color1 = $var==0?'sub':'single';
		echo "</td><td class=$color1>";
		echo ArrayHelper::getValue($data,"$subject");
		echo "</td><td class=$color1>";
     $float = ArrayHelper::getValue($myOrder,"$subject.float");
		
        $color = $float>0?'green':'red';
        $arrow = $float>0?'glyphicon glyphicon-arrow-up':'glyphicon glyphicon-arrow-down';
        if ($float==0) {
          $color = null;
          $arrow = null;  
        }

        echo ArrayHelper::getValue($myOrder,"$subject.this");;
        echo "</td><td class=$color1>";

        echo "<span class='$arrow' style='color:$color;font-size:10px'>";
        echo abs($float);
        echo "</span>";

	}
	echo "</td></tr>";

}
 ?>
 </tbody>
 </table>
</div>
<!--endprint-->
    </div>
    
  </div>

</div>
</div>
</div>
</div>
  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$("#settings").removeClass("active");
$('.myTable').DataTable({
  lengthChange:false,
  searching: false,
  paging:false,
} );
</script>

<script language=javascript>
function doPrint() {
$('.charts').hide();
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

 	
 