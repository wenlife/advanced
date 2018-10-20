<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '指标分配';
?>

<div class="testService">

<div class="box">
            <div class="box-header">

              <h3 class="box-title">各班级指标分配</h3>

              <div class="box-tools">
              	<?php $form = ActiveForm::begin(['method'=>'get','options'=>['class'=>'form-inline']]); ?>
                <div class="input-group">   
                 	 <?=Html::dropDownlist('grade',null,['1'=>'2019届'],['class'=>'form-control'])?>
	                 <span class="input-group-btn">
	                 <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
	             	 </span>
                </div>
                <?php ActiveForm::end(); ?> 
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              	<tr>
                  <th>班级</th>
                  <th>重本第一条线</th>
                  <th>重本第二条线</th>
                  <th>本科第一条线</th>
                  <th>本科第二条线</th>
                </tr>
              	<?php
              		foreach ($classes as $key => $class) {
              			echo "<tr><td>";
              			echo $class->title;
              			echo "</td><td>";
              			echo Html::Input($class->id);
              			echo "</td><td>";
              			echo Html::Input($class->id);
              			echo "</td><td>";
              			echo Html::Input($class->id);
              			echo "</td><td>";
              			echo Html::Input($class->id);
              			echo "</td></tr>";
              		}

              	?>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>

</div>