<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '学生首页';
//$this->params['breadcrumbs'][] = $this->title;
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
?>
<div class="row">
        <div class="col-md-3">

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
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">

              <li class=""><a href="#content" data-toggle="tab" aria-expanded="false">信息技术学习</a></li>
               <li class=""><a href="#test" data-toggle="tab" aria-expanded="false">选科指导中心</a></li>

              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">视频中心</a></li>
            </ul>
            <div class="tab-content">

            <div class="tab-pane active" id="content">
            <?php
            if ($section1) {
            foreach ($section1 as $key1 => $section_1) {
              //exit(var_export($section_1));
            ?>
            <div class="box box-success direct-chat direct-chat-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$section_1->itemname?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                  $dataProvider = new ActiveDataProvider([
                    'query' => Information::find()->where(['infoitem'=>$section_1->itemid]),
                    'pagination' => [
                        'pageSize' =>10,
                    ],
                  ]);
                  echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'item',
                    'layout'=> "{items}",
                  ]);

              ?>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                  <a href="<?=Url::toRoute(['/site/list','cate'=>$section_1->itemid])?>" class="small-box-footer pull-right">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box-footer-->
          </div>
              <?php
              }
              }
               ?>
              </div>
              <div class="tab-pane" id="test">

              </div>


              <div class="tab-pane" id="settings">
                  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>