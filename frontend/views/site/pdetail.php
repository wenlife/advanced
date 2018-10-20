<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\content\models\Picturelist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Picturelists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picturelist-view">
<div class='row'>
<div class='col-sm-9'>
<h1><?=$model->title?></h1>
<hr>
</div>
<div class="col-sm-9">
	<div id="carousel1" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <li data-target="#carousel1" data-slide-to="0" class="active"></li>
        <?php 
            for ($i=1; $i < count($pictures) ; $i++) { 
            	echo '<li data-target="#carousel1" data-slide-to="'.$i.'"></li>';
            }
        ?>
          
        </ol>
        <div class="carousel-inner" role="listbox">
	    <?php foreach($pictures as $key=>$picture){ ?>
	          <div class="item <?php if($key==0) echo 'active'; ?>">
	          <img src="<?=$picture->url?>" alt="First slide image" class="center-block">
	            <div class="carousel-caption">
	              <h3><?=$picture->headline?></h3>
	              <p><?=$picture->describes?></p>
	            </div>
	          </div>
	    <?php } ?>

        </div>
        <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span></a>
        <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
 </div>
 <div class="col-sm-3">

  <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'note',
            'cid',
            'is_collection',
            'kewords',
            'date',
            'author',
        ],
    ]) ?>
 </div>
 </div>
</div>