<?php

/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row my">
          <div class="col-sm-6">
            <div id="carousel1" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel1" data-slide-to="1"></li>
                  <li data-target="#carousel1" data-slide-to="2"></li>
                  <li data-target="#carousel1" data-slide-to="3"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                  <img src="images/16.jpg" alt="First slide image" class="center-block">
                    <div class="carousel-caption">
                      <h3>Miku</h3>
                      <p>Hear my song and dancing</p>
                    </div>
                  </div>
                  <div class="item"><img src="images/17.jpg" alt="Second slide image" class="center-block">
                    <div class="carousel-caption">
                      <h3>Nagato Yuki</h3>
                      <p>By your side nothing else</p>
                    </div>
                  </div>
                  <div class="item"><img src="images/18.jpg" alt="Third slide image" class="center-block">
                    <div class="carousel-caption">
                      <h3>Maduoka</h3>
                      <p>Save you a thousand times no regret</p>
                    </div>
                  </div>
                  <div class="item"><img src="images/19.jpg" alt="Third slide image" class="center-block">
                    <div class="carousel-caption">
                      <h3>Sakura</h3>
                      <p>Do u know that 5cm per second the speed sakura falling down</p>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span></a>
                <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
                </a>
            </div>
             <br>
          </div>
          <div class="col-sm-6">
           <div class="panel panel-default">
              <div class="panel-heading panel-notice">
                
              </div>
              <div class="panel-body"> Panel content </div>
           </div>
         </div>
    </div>

    <div class="row my">
      <div class="col-md-6">
              <div class="panel panel-default">
                  <div class="panel-heading panel-student">
                 <h3 class="panel-title">
                          <a href="index.php?r=site/list&cate=1"><img src="images/more.jpg" class="pull-right" alt=""></a>
                  </h3> 
              </div>
                   <ul class="list-group">

                   <?php 
                        $dataProvider = new ActiveDataProvider([
                        'query' => Information::find(),
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

                </ul>    
            </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-default">
           <div class="panel-heading panel-school">
             <h3 class="panel-title">
              <a href="list2.html"><img src="images/more.jpg" class="pull-right" alt=""></a>
             </h3>     
           </div>
            <div class="panel-body">
                <div class="media">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="images/15.jpg" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Middle aligned media</h4>
                   Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                  </div>
                </div>
                <div class="media">
                  <div class="media-left media-middle">
                    <a href="#">
                      <img class="media-object" src="images/15.jpg" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Middle aligned media</h4>
                   Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, 
                  </div>
                </div>   
            </div>
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
            <div class="col-md-3">
                <div class="thumbnail">
                <img src="images/15.jpg" alt="Thumbnail Image 1">
                  <div class="caption">
                    <h3>Thumbnail 1 label</h3>
                    <p>Optional content and buttons for Thumbnail #1</p>
                    
                  </div>
                </div>
              </div>
            <div class="col-md-3">
            <div class="thumbnail">
            <img src="images/15.jpg" alt="Thumbnail Image 1">
              <div class="caption">
                <h3>Thumbnail 1 label</h3>
                <p>Optional content and buttons for Thumbnail #1</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="thumbnail">
            <img src="images/15.jpg" alt="Thumbnail Image 1">
              <div class="caption">
                <h3>Thumbnail 1 label</h3>
                <p>Optional content and buttons for Thumbnail #1</p>
                
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="thumbnail">
            <img src="images/15.jpg" alt="Thumbnail Image 1">
              <div class="caption">
                <h3>Thumbnail 1 label</h3>
                <p>Optional content and buttons for Thumbnail #1</p>
                
              </div>
            </div>
          </div>
          
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
              <div class=" col-md-3">
               
                <a href="#" class="thumbnail">
                  <img src="images/15.jpg" alt="...">
                </a>
              </div>
              <div class=" col-md-3">
                <a href="#" class="thumbnail">
                <img src="images/13.jpg" alt="...">
                </a>
              </div>
              <div class=" col-md-3">
                <a href="#" class="thumbnail">
                  <img src="images/15.jpg" alt="...">
                </a>
              </div>
              <div class=" col-md-3">
                <a href="#" class="thumbnail">
                <img src="images/13.jpg" alt="...">
                </a>
              </div>
            </div>
      </div>
  </div>
  </div>

    

    </div>
</div>
