<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title="个人信息";
?>
<div class='row'>
	<div class="col-md-6">
     <div class="box box-primary">
        <div class="box-header">
          <i class="ion ion-clipboard"></i>
          <h3 class="box-title">个人信息</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
          	<table class="table table-bordered" style="table-layout: fixed;width:800px">
          		 <tr><td colspan="2" rowspan="3" width="30%">
          		 	<img src="/images/avatar/default.png" width="200px" /></td><td colspan="2">张无忌  <small>教师</small></td></tr>
          		 <tr><td colspan="2">中学高级</td></tr>
          		 <tr><td>男</td><td>中国</td></tr>
          		 <tr><td colspan="4"><b>个人留言</b></td></tr>
          		 <tr><td colspan="4">学高为师，身正为范</td></tr>
          		 <tr><td colspan="4"><b>个人简介</b></td></tr>
          		 <tr><td colspan="4">大学 略</td></tr>
          		 <tr><td colspan="4">工作 略</td></tr>
          		 <tr><td colspan="4">荣誉 略</td></tr>
          	</table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
          <button type="button" class="btn btn-default pull-right">修改</button>
        </div>
      </div>
  </div>
</div>