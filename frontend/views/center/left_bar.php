<?php
use yii\helpers\Url;
use common\models\user;
use backend\modules\test\models\TestScore;
use backend\modules\test\models\Task;
use backend\modules\school\models\TeachManage;
use yii\helpers\Html;
$id = Yii::$app->user->identity->username;
if(file_exists("avatar/1/$id.png"))
{
  $file = "avatar/1/$id.png";
}else{
  if($user->gender==2)
  {
    $file = "avatar/1/female.png";
  }else{
    $file = "avatar/1/male.png";
  }
  
}
 if(Yii::$app->user->isGuest){
      return $this->redirect(['site/login']);
  }else{
      $username = Yii::$app->user->identity->username;           
      $user = User::findByUsername($username);
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
     <a href=<?=url::to(['avatar'])?> title="修改头像">
    <img class="profile-user-img img-responsive img-circle" src=<?=$file?> alt="User profile picture">
  </a>

    <h3 class="profile-username text-center"><a href=<?=url::to(['detail'])?>><?=$user->name?></a></h3>

    <p class="text-muted text-center"><?=$user->teachclass->title?></p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>未完成任务</b> <a class="pull-right">1,322</a>
      </li>
      <li class="list-group-item">
        <b>已完成任务</b> <a class="pull-right">543</a>
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
      <tr><td><?=$task->feedback?></td></tr>
      <tr><td><?=$task->enddate?></td></tr>
      <tr><td><?=$task->teacher->name?></td></tr>
      <tr><td><?php
        if ($ifTestWasDone) 
        {
          echo $ifTestWasDone."分".Html::a('(点击查看答案)',Url::toRoute(['/center/score']));
        }else{
          echo Html::a('点击开始答题',url::toRoute(['/site/test','id'=>$task->test]));
        }?></td></tr>
    </tbody>
  </table>

  <?php } ?>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->