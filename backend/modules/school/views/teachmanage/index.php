<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\libary\CommonFunction;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\guest\models\TeachmanageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '任教管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-manage-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p></p>
<?php $form = ActiveForm::begin(['id'=>'form1','options'=>['class'=>'form-inline']]); ?>
  <div class="form-group">
     <?= Html::a('创建单个任教', ['create'], ['class' => 'btn btn-success']) ?>
  </div>
  <div class="form-group">
    <?= Html::a('班级任教', ['add'], ['class' => 'btn btn-success']) ?>
  </div>
  <div class="form-group">
    <?php
echo Html::dropDownList('yearpost',null,ArrayHelper::map($year,'id','title'),['class'=>'form-control']);
?>
  </div>
  <button type="submit" class="btn btn-primary">查询</button>
    <?php ActiveForm::end(); ?>
<p></p>
</div>
<div class="tab">
<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">年级教师任教表</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">

<table class="table table-bordered">
<thead>
    <tr>
        <th>班级</th>
        <th>类型</th>
       
    <?php
    foreach (CommonFunction::getAllTeachDuty() as $subject => $name) {
        echo '<th>'.$name.'</th>';
    }
    ?>
</tr>
</thead>
<tbody>
<?php
foreach ($banji as $key => $bj) {
   echo "<tr><td>";
   echo $bj->title;
   echo "</td><td>";
   echo $bj->type=='lk'?'理科':'文科';
   echo "</td>";
   foreach (CommonFunction::getAllTeachDuty() as $subject => $name) {
    echo '<td>';
       if (isset($teachArray[$bj->id][$subject])) {
        echo Html::a($teachArray[$bj->id][$subject]['name'],Url::toRoute(['update','id'=>$teachArray[$bj->id][$subject]['id']]),['class'=>'a']);
         // echo "<a href='index.php?r='>$teachArray[$bj->id][$subject]['name']";
       }
    echo '</td>';
   }
   echo '</tr>';
}
?>
</tbody>

</table>
</div>
</div>
</div>
<style type="text/css">
    th,td{
        text-align: center;
    }
</style>
