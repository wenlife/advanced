<?php

/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use backend\modules\content\models\ContentMenu;
$this->title = '欢迎光临攀枝花七中校内网！';
?>
<style type="text/css">
  .list-group{
    list-style: none;
  }
    .list-group li{
      border:none;
      border-bottom: 1px solid #eee;
    }
</style>
<div class="body-content">
    <div class="row">
      <div class="col-sm-6">
        <div class="box box-solid">

            <div class="box-body">
                  <?=$this->render('partial_picture',['pictures'=>$pictures])?>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
      <div class="col-sm-6">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">通知公告</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?=$notice?>
            </div>
            <!-- /.box-body -->
        </div>
     </div>
  </div>

  <div class="row my">
    <div class="col-md-6">
          <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">学校新闻 </h3>
                <a href="index.php?r=site/list&cate=<?=$column->twoleft?>" class="pull-right">more</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                   <ul class="list-group">
                   <?php 
                        $dataProvider = new ActiveDataProvider([
                        'query' => ContentMenu::find()->where(['menuid'=>$column->twoleft]),
                        'pagination' => [
                            'pageSize' =>10,
                        ],
                    ]);
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => 'item_article',
                        'layout'=> "{items}",
                    ]);

                   ?>

                </ul> 
              </div>
              <!-- /.box-body -->
          </div>
      </div>
      <div class="col-md-6">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">新闻联播</h3>
              <a href="list2.html" class="pull-right">more</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <ul class="list-group">
                     <?php 
                          $dataProvider = new ActiveDataProvider([
                          'query' => ContentMenu::find()->where(['menuid'=>$column->tworight]),
                          'pagination' => [
                              'pageSize' =>10,
                          ],
                      ]);
                      echo ListView::widget([
                          'dataProvider' => $dataProvider,
                          'itemView' => 'item_article',
                          'layout'=> "{items}",
                      ]);
                     ?>
                  </ul>  
            </div>
            </div>

    </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
                <?php
                  foreach ($picture2 as $key => $value) {
                    if ($key>3) {
                      continue;
                    }
                   echo $this->render('item_thumbnail',['picture'=>$value]);
                  }
                ?>
      </div>
      <!-- /.box-body -->
      </div>
      </div>
  </div>
  <div class="row">

      <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">考试</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
                  <?php
                  foreach ($picture3 as $key => $value) {
                    if ($key>3) {
                      continue;
                    }
                   echo $this->render('item_athumbnail',['picture'=>$value]);
                  }
                ?> 
      </div>
      <!-- /.box-body -->
      </div>

  </div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  src = $('.index img').attribute('src');
  $('.index img').attribute('src','127.0.0.1:82/'+src);
</script>
