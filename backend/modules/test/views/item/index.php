<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\test\models\TestitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '试题管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-item-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Test Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'alone',
            ['attribute'=>'type','value'=>function($model){
                                $typearr =['1'=>'单选题','2'=>'多选题','3'=>'判断题','4'=>'材料题'];
                                return $typearr[$model->type];}],
            //'content',
            ['attribute'=>'content','value'=>function($model){
                $content = $model->content;
                $content=strip_tags($content);
                $content=preg_replace('/\n/is','',$content);
                $content=preg_replace('/ |　/is','',$content);
                $content=preg_replace('/&nbsp;/is','',$content);
                return strlen($model->content)>100?mb_substr($content,0,50).'...':$content;}],
            //'options',
            // 'answer',
            // 'note',
             'chapter',
            // 'sum',
            // 'wrong',
             'level',
            // 'source',
            // 'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
