<?php
use yii\helpers\Html;
$this->title = '查看试题';
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
<div class="col-sm-6">
<?=$this->render('display/'.$view,['model'=>$model])?>
</div>
</div>
