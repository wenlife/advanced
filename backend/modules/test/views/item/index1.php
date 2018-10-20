<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'index';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="row">
       <h1><?= Html::encode($this->title) ?></h1>
   <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   <p>
       <?= Html::a('Create Test Item', ['create'], ['class' => 'btn btn-success']) ?>
   </p>
   <?= GridView::widget([
       'dataProvider' => $dataProvider,
       'filterModel' => $searchModel,
       'columns' => [
           ['class' => 'yii\grid\SerialColumn'],
           'id',
           'alone',
           'type',
           //'content',
           ['label'=>'content','value'=>substr($model->content, 0,20,)]
           'options',
           // 'answer',
           // 'note',
           // 'chapter',
           // 'sum',
           // 'wrong',
           // 'level',
           // 'source',
           // 'date',
           ['class' => 'yii\grid\ActionColumn'],
       ],
   ]); ?>
</div>





<?php $form = ActiveForm::begin(['method'=>'get','options'=>['class'=>'form-inline']]); ?>
<div class="btn-group pull-right">
<?=Html::a('新建单选题',['create','type'=>1],['class'=>'btn btn-primary'])?>
<?=Html::a('新建多选题',['create','type'=>2],['class'=>'btn btn-info'])?>
<?=Html::a('新建判断题',['create','type'=>3],['class'=>'btn btn-primary'])?>
<?=Html::a('新建综合题',['create','type'=>4],['class'=>'btn btn-info'])?>
</div>
<?=Html::a('试题选用',['itemlist'],['class'=>'btn btn-info'])?>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3">Email address</label>
    <?=Html::dropDownList('type',null,$typeName,['prompt' => '请选择题目类型','class'=>'form-control','style'=>'width:150px']);?>
  </div>

  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword3">Password</label>
     <?=Html::dropDownList('chapter',null,ArrayHelper::map($chapter,'id','name'),['prompt' => '请选择题目章节','class'=>'form-control','style'=>'width:150px']);?>
  </div>
 
  <button type="submit" class="btn btn-success">submit</button>
 <?php ActiveForm::end(); ?>
<br>
 <table class="table table-bordered">
    <tr><th>id</th><th>chapter</th><th>type</th><th>title</th><th>note</th><th>operation</th></tr>
    <?php
        foreach ($model as $key => $value) {
           echo "<tr><td>";
           echo $value->id;
           echo "</td><td>";
           echo $value->chapter;
           echo "</td><td>";
           echo $typeName[$value->type];
           echo "</td><td>";
           echo mb_substr($value->content,0,80);
           echo "</td><td>";
           echo $value->note;
           echo "</td><td>";
           echo Html::a('查看',['view','id'=>$value->id]);
           echo "</td><td>";
           echo Html::a('修改',['update','id'=>$value->id]);
           echo "</td></tr>";
        }
    ?>
   </table>

   </div>