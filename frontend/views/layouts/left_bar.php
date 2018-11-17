<?php
use yii\helpers\Url;
use common\models\user;
use yii\helpers\Html;
use backend\modules\test\models\TestScore;
use backend\modules\test\models\Task;
use backend\modules\school\models\TeachManage;

//$id = Yii::$app->user->identity->username;
if(Yii::$app->user->isGuest){
    return $this->redirect(['site/login']);
}else{
    $username = Yii::$app->user->identity->username;           
    $user = User::findByUsername($username);
}
if(file_exists("avatar/1/$username.png"))
{
  $file = "avatar/1/$username.png";
}else{
  if($user->gender==2)
  {
    $file = "avatar/1/female.png";
  }else{
    $file = "avatar/1/male.png";
  }
  
}

$teacherID = TeachManage::find()->where(['class_id'=>$user->class,'subject'=>'xx'])->one();// $class->xx;

$taskModel = new Task();
$task = $taskModel->find()->where(['creator'=>$teacherID,'state'=>1])->orderBy('createdate desc')->one();
if ($task) {
    $testScoreModel = new TestScore();
    $testScore = $testScoreModel->find()->where(['userid'=>Yii::$app->user->identity->username,'testid'=>$task->test])->all();
    if (empty($testScore)) {
        $ifTestWasDone = false;
    }else{
        $ifTestWasDone = 1;
        foreach ($testScore as $k => $test) {
            if ($test->score > $ifTestWasDone) {
                $ifTestWasDone = $test->score;
            }
        }
    }
}else{
  $ifTestWasDone=false;
}
?>
<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    
  <?= \hyii2\avatar\AvatarWidget::widget(['imageUrl'=>'uploads/avatar/'.$username.'/avatar_big.png']); ?>

    <h3 class="profile-username text-center"><a href=<?=url::to(['detail'])?>><?=$user->name?></a></h3>

    <p class="text-muted text-center"><?=$user->teachclass->title?></p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>本学期持续</b> <a class="pull-right">2018.9.1-2019.2.10</a>
      </li>
      <li class="list-group-item">
        <b>综合评定</b> <a class="pull-right">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star-half"></span>
        </a>
      </li>

    </ul>

    <a href="#" class="btn btn-primary btn-block"><b>查看统计</b></a>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- About Me Box -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">今日任务</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <?php if ($task) {  ?>
  <table class="table table-condensed">
      <tbody>
      <tr><th><?=$task->title?></th></tr>
      <tr><td><?=$task->content?></td></tr>
      <tr><td><?=$task->teacher->name?><span class="pull-right"><?=$task->enddate?></span></td></tr>
      <tr><td><?php
        if ($ifTestWasDone) 
        {
          echo $ifTestWasDone."分".Html::a('(点击查看答案)',Url::toRoute(['/center/score']));
        }else{
          echo Html::a('点击开始答题',url::toRoute(['/site/test','id'=>$task->test]),['class'=>'btn btn-primary']);
        }?></td></tr>
    </tbody>
  </table>

  <?php } ?>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->