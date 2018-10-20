<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\datetime\DateTimePicker;
use backend\modules\content\models\Infoitem;
use yii\helperS\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\content\Information */
/* @var $form yii\widgets\ActiveForm */
$infoItem  = new infoItem();
$list = $infoItem->find()->all();
?>

<div class="information-form">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form'],]); ?>

    
        <div class="row">
            <div class="col-xs-4 col-sm-4">
                <?= $form->field($model, 'infoitem')->dropDownList(ArrayHelper::map($list,'itemid','itemname')) ?>
                <?= $form->field($model, 'headline')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'subhead')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'releaser')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-xs-4 col-sm-4">
                <?= $form->field($model, 'level')->dropDownList([0=>'正常',1=>'置顶',2=>'紧急']) ?>
                <?= $form->field($model, 'headcolor')->textInput(['maxlength' => true])?>
                <?= $form->field($model, 'subhcolor')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'publish_date')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '发布日期','language'=>"zh" ],
                            'pluginOptions' => [
                               'format' => 'yyyy-mm-dd', 
                                'startDate' => '01-Mar-2014 12:00 AM',
                               'todayHighlight' => true,
                               'minView'=>'month',
                               'autoclose'=>true,
                               'language'=>"zh-CN"
                            ]
                        ]); ?>
                <?= $form->field($model, 'release_date')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '发布日期','language'=>"zh" ],
                            'pluginOptions' => [
                               'format' => 'yyyy-mm-dd', 
                                'startDate' => '01-Mar-2014 12:00 AM',
                                'minView'=>'month',
                               'todayHighlight' => true,
                               'autoclose' => true,
                               'language'=>"zh-CN"
                            ]
                        ]); ?>
             </div>
    
            
        </div>


        <div class="row">   
         <div class="col-xs-10 col-md-10">
               <?= $form->field($model, 'content')->widget('kucha\ueditor\UEditor',['clientOptions' => ['initialFrameHeight' => '500',]]); ?>
        </div>
        </div>
        
        <div class="row">
            <div class="col-xs-2 col-sm-2">
                <?= $form->field($model, 'ishow')->checkBox() ?>
            </div>
            <div class="col-xs-2 col-sm-2">
                <?= $form->field($model, 'iscomment')->checkBox() ?>
            </div>
            <div class="col-xs-2 col-sm-2">
                <?= $form->field($model, 'isdelete')->checkBox() ?>
            </div>
        </div>

               

               
               

        <div class="row">
            
            <div class="col-xs-4 col-sm-4"> 
              <?= $form->field($model, 'deletedate')->widget(DateTimePicker::classname(), [
                            'options' => ['placeholder' => '删除日期','language'=>"zh" ],
                            'pluginOptions' => [
                               'format' => 'yyyy-mm-dd', 
                               'startDate' => '01-Mar-2014 12:00 AM',
                               'todayHighlight' => true,
                               'minView'=>'month',
                               'autoclose' => true,
                               'language'=>"zh-CN"
                            ]
                        ]); ?>
            </div>
</div>
<div class="form-group">
<?= Html::submitButton($model->isNewRecord ? '提交' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>
