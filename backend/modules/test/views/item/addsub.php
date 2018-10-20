<?php

use yii\helpers\Html;


$this->title = 'add sub';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-sm-9">
<?=$this->render('form/'.$view,['model'=>$model])?>
</div>
</div>
