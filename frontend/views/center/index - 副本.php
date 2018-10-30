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
<div class="site-index">
    <div class="body-content">
        <div class="row">
          <div class="col-sm-5 my" style="margin-top: 20px; margin-bottom: 50px;box-shadow:2px 2px 2px 4px rgb(248,209,202);">
            <div class="personalMSG row" style="height:200px;background-color:rgb(248,209,202)">
              <div class="touxiang col-sm-4" style="height:200px;position:relative;">
                <a href=<?=url::to(['avatar'])?> title="修改头像">
                  <img src=<?=$file?>  style="width:160px;height:160px;border-radius:100px;position:absolute;top:15px;left:15px">
                </a>

                <span style="height:100%;display:inline-block;vertical-align: middle;"> </span>
              </div>
              <div class="col-sm-8">
                <ul class="nameplate">
                  <li><a href=<?=url::to(['detail'])?>><?=$user->name?></a></li>
                  <li><?=$user->teachclass->title?></li>
                  <li>
                    <i class="glyphicon glyphicon-star text-danger"></i>
                    <i class="glyphicon glyphicon-star text-danger"></i>
                    <i class="glyphicon glyphicon-star text-danger"></i>
                    <i class="glyphicon glyphicon-star text-danger"></i>
                    <i class="glyphicon glyphicon-star text-danger"></i>
                  </li>
                </ul>
              </div>
            </div>



      <div class="panel panel-default">
          <div class="panel-heading">
                
            </div>
          <div class="panel-body">
          <?php
          //如果没有测试 
             if ($task) {
          ?>
               <table class="table table-bordered" style="width:100%">
                <tr><td colspan="2">今日任务：<?=$task->title?></td></tr>
                <tr><td colspan="2"><?=$task->content?></td></tr>
                <tr><td colspan="2"><?=$task->feedback?></td></tr>
                <tr><td>测试</td><td>
                <?php
                  if ($ifTestWasDone) 
                  {
                    echo $ifTestWasDone."分".Html::a('(点击查看答案)',Url::toRoute(['/center/score']));
                  }else{
                    echo Html::a('点击开始答题',url::toRoute(['/site/test','id'=>$task->test]));
                  }
                  
                ?>
                </td></tr>
                <tr><td>结束</td><td><?=$task->enddate?></td></tr>
                <tr><td>教师</td><td><?=$task->teacher->name?></td></tr>
                <!-- <tr><td colspan="2"><button class="btn btn-success">提交</button></td></tr> -->
                </table>
            <?php
              }else{
                echo '没有测试！';
              }
            ?>
          </div>
      </div>
    </div>


    <div class="col-sm-6 col-sm-offset-1" style="margin-top: 20px">
    
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


            <div class="panel-group" id="accordion">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$key1?>"><?=$section_1->itemname?></a>
                              </h4>
                          </div>
                          <div id="collapse<?=$key1?>" class="panel-collapse collapse in">
                              <div class="panel-body">
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
                          </div>
                         </div>  
                       </div>
                      <?php
                      }
                      }
                       ?>

        </div>
      </div>
      <div class="row my">
          <div class="col-md-6"></div>
          <div class="col-md-6"></div>
      </div>
</div>
</div>
<style type="text/css">
 ul.nameplate{
    margin-top: 40px;
    height: 100%;
    list-style: none;
    vertical-align: middle;
  }
 ul.nameplate li{
    height:40px;
    width: 100%;
    //text-decoration: underline;
  }
  i{
    font-size: 25px;
  }
</style>    