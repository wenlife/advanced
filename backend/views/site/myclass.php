<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
$this->title = "我的班级";

?>
<h1></h1>
<div class="row">
<div class="col-md-6">
 <div class="box box-info">
    <div class="box-header">
     
      <?php $form = ActiveForm::begin(['id' => 'form','method'=>'post','options'=>['class'=>"form-inline"]]); ?>  
        <div class="form-group">
          <?=Html::dropDownList('class',$class,ArrayHelper::Map($classes,'id','title'),['class'=>'form-control'])?>
        </div>
        <button type="submit" class="btn btn-info">提交</button>
      <?php ActiveForm::end(); ?>   

      <!-- /. tools -->
    </div>
    <div class="box-body">
      <table class="table table-bordered">
        <tr><th>姓名</th><th>账号</th><th>密码</th><th>操作</th></tr>
        <?php
        foreach ($students as $key => $student) {
         echo "<tr><td>";
         echo $student->name;
         echo "</td><td>";
         echo $student->username;
         echo "</td><td>";
         echo $student->username;
         echo "</td><td>";
         echo Html::a('重置密码',['resetpwd','username'=>$student->username]);
         echo "</td></tr>";

        }
        ?>
      </table>
    </div>
    <div class="box-footer clearfix">
      
    </div>
  </div>
</div>
</div>