<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VideolistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '上传封面';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-index">
<div class="box box-widget">
        <div class="box-header with-border">

          <!-- /.user-block -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <button>提交</button>

<?php ActiveForm::end() ?>
</div>
</div>

</div>