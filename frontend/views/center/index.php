<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '学生首页';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
        <!-- /.col -->
        <div class="col-md-12">
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