<?php
  use yii\helpers\Html;
?>
<div class="panel panel-default">
   <div class="panel-heading panel-school">
     <h3 class="panel-title">
      
     </h3>     
   </div>
    <div class="panel-body">
    <?php foreach ($article as $key => $value) {?>
        <div class="media">
          <div class="media-left media-middle">
            <a href="#">
              <img class="media-object" src="<?php echo $value->cover; ?>" alt="...">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading">
              <?php echo  Html::a($value->title,['vdetail','id'=>$value->id])?>
            </h4>
            <?php echo $value->note ?>
          </div>
        </div>
        <hr>
    <?php }?>
          
    </div>
</div>