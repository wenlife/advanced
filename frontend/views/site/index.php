<?php

/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

use backend\modules\content\models\ContentMenu;
$this->title = 'My Yii Application';
?>
<div class="index">

    <div class="body-content">

        <div class="row my">
          <div class="col-sm-6">
            <?=$this->render('partial_picture',['pictures'=>$pictures])?>
             <br>
          </div>
          <div class="col-sm-6">
           <div class="panel panel-default">
              <div class="panel-heading panel-notice"></div>
              <div class="panel-body">
               <?=$notice?>
             </div>
           </div>
         </div>
    </div>

    <div class="row my">
      <div class="col-md-6">
              <div class="panel panel-default">
                  <div class="panel-heading panel-student">
                 <h3 class="panel-title">
                          <a href="index.php?r=site/list&cate=<?=$column->twoleft?>"><img src="http://localhost:82/images/more.jpg" class="pull-right" alt=""></a>
                  </h3> 
              </div>
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
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
           <div class="panel-heading panel-school">
             <h3 class="panel-title">
              <a href="list2.html"><img src="http://localhost:82/images/more.jpg" class="pull-right" alt=""></a>
             </h3>     
           </div>
            
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

  <div class="row my">
    <div class="panel panel-default">
      <div class="panel-heading panel-school">
        <h3 class="panel-title"></h3>
        </div>
      <div class="panel-body">
        <div class="row my">
          <?php
            foreach ($picture2 as $key => $value) {
              if ($key>3) {
                continue;
              }
             echo $this->render('item_thumbnail',['picture'=>$value]);
            }
          ?>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
  <div class="panel panel-default" >
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div class="row">
          <?php
            foreach ($picture3 as $key => $value) {
              if ($key>3) {
                continue;
              }
             echo $this->render('item_athumbnail',['picture'=>$value]);
            }
          ?>  
        </div>
      </div>
  </div>
  </div>

    

    </div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  src = $('.index img').attribute('src');
  $('.index img').attribute('src','127.0.0.1:82/'+src);
</script>
