<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\content\models\Infoitem;
use yii\helperS\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\infoitem */
/* @var $form yii\widgets\ActiveForm */

$infoItem  = new infoItem();
$list = $infoItem->find()->where(['parentid'=>0])->all();
$plist = ArrayHelper::map($list,'itemid','itemname');
$plist[0] = '顶层目录';
?>

<div class="infoitem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parentid')->dropDownList($plist) ?>

    <?= $form->field($model, 'itemname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'itemurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'itemtype')->dropDownList(Yii::$app->params['itemType']) ?>

    <?= $form->field($model, 'itemdesc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'itemorder')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
