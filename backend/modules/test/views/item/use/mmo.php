<?php
use yii\helpers\Html;
?>
<div class="items">
<P><?=$model->content?></P>
<hr>
<?php
	$options = $model->answer;
	if (!is_null($model->answer)) {
		$order = $order-3;
		foreach ($options as $key => $value) {
			echo $this->render($value->getViewName(),['model'=>$value,'order'=>$order++]);
		}
	}
	
?>
</div>