<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
$id = Yii::$app->user->identity->username;
?>
<div class="site-index">

    <div class="body-content">
        <div class="row">
          <div class="col-sm-5 my" style="border:1px dashed #ccc;margin-top:20px;margin-bottom: 50px;">
            <div class="personalMSG row" style="height:200px">
              <div class="touxiang col-sm-4" style="height:200px;">
              <a href=<?=url::to(['avatar'])?> >
              <?php 
                if(file_exists("avatar/1/$id.png"))
                {
                  $file = "avatar/1/$id.png";
                }else{
                  $file = "avatar/1/default.png";
                }
              ?>
              <img src=<?=$file?> alt="" style="width:160px;height:160px;border-radius:100px;vertical-align: middle;">
              </a>
              <span style="height:100%;display:inline-block;vertical-align: middle;"> 
              </span>

              </div>
              <div class="col-sm-8 ">
              <ul class="nameplate">
              <li><a href=<?=url::to(['userdetail'])?>><?=$user->name?></a></li>
              <li><?=$user->banji->title?></li>
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
                <tr><td colspan="2"><?=$task->title?></td></tr>
                <tr><td>内容</td><td><?=$task->content?></td></tr>
                <tr><td>问题</td><td><?=$task->feedback?></td></tr>
                <tr><td>测试</td><td>
                <?php
                  if ($ifTestWasDone) 
                  {
                    echo $ifTestWasDone."(已完成)";
                  }else{
                    echo Html::a('点击开始答题',url::toRoute(['test','id'=>$task->test]));
                  }
                  
                ?>
                </td></tr>
                <tr><td>结束</td><td><?=$task->enddate?></td></tr>
                <tr><td>教师</td><td><?=$task->creator?></td></tr>
                <tr><td colspan="2"><button class="btn btn-success">提交</button></td></tr>
                </table>
            <?php
              }else{
                echo '没有测试！';
              }
            ?>
           </div>
           </div>



            </div>


    <div class="col-sm-6 col-sm-offset-1">

            <div class="panel panel-default" >
              
              <?php 
                  $dataProvider = new ActiveDataProvider([
                    'query' => Information::find(),
                    'pagination' => [
                        'pageSize' =>10,
                    ],
                  ]);
                   ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'item',
                    'layout'=> "{items}",
                  ]);

              ?>

            </div>

            <div class="section1">
            <div class="panel-group" id="accordion">
            <h4>信息技术基础</h4>

            <?php
            if ($section1) {
            foreach ($section1 as $key1 => $section_1) {
              //exit(var_export($section_1));
            ?>
            <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" 
                                  href="#collapse<?=$key1?>">
            <?php
                echo $section_1->itemname;
            ?>
             </a>
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