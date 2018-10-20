<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$this->title = '考试情况对比';
$this->params['breadcrumbs'][] = ['label' => 'ana', 'url' => ['score']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">
<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
<a href=<?=Url::to(['detox','exam'=>$exam])?> id="all" class='btn btn-primary'>整体分析</a>
<a href=<?=Url::to(['banji','exam'=>$exam])?> id="class" class='btn btn-primary'>班级分析</a>
<a href=<?=Url::to(['grade','exam'=>$exam])?> id="type" class='btn btn-primary'>分类分析</a>
<a href=<?=Url::to(['index','exam'=>$exam])?> class='btn btn-primary'>返回</a>
<div class="row">
<div class="col-md-6">

<h1>学生姓名不存于系统中的学生</h1>
<table class="table table-bordered">
<tr><th>学号</th><th>姓名</th></tr>
<?php
	foreach ($cantFindUser as $key => $valstu) {
		echo '<tr><td>'.$key.'</td><td>'.$valstu.'</td></tr>';
	}
?>
</table>
</div>

<div class="col-md-6">
<h1>如法找到考试成绩的学生</h1>
<table class="table table-bordered">
<tr><th>学号</th><th>姓名</th></tr>
<?php
	foreach ($cantFindScore as $key => $valscore) {
		echo '<tr><td>'.$key.'</td><td>'.$valscore.'</td></tr>';
	}
?>

</table>
</div>


</div>
</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript">
	$('.compare').change(function(){
		url = $('#type').attr('url');
		url = url+'&copmare='+$('.compare').value;
		$('$type').attr('url',url);
	})
</script>