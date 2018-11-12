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
      <img src="<?='http://localhost:83/'.$picture->url?>" style="width:100%;height:300px"  alt="First slide image" class="center-block">
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