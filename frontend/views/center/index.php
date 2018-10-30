<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '';
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
                <tr><th style="width: 10px"><?=$task->title?></th></tr>
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

              <li class=""><a href="#content" data-toggle="tab" aria-expanded="false">学习内容</a></li>
               <li class=""><a href="#test" data-toggle="tab" aria-expanded="false">测试内容</a></li>

              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
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
                    1212
              
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
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>