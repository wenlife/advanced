    <?php
       //var_export($article);
    use yii\helpers\Html;
    ?>

          <div class="panel panel-default" >
            <div class="panel-notice"></div>
            <table class="table table-hover">
            <?php

              if (empty($article)) {
                 echo "<tr><td colspan=3>没有信息！</td></tr>";
              }

              foreach ($article as $key => $page) {
              
                  echo "<tr><td>";
                  echo Html::a($page->headline,['/site/detail',"id"=>$page->infoid]);
                  echo "</td><td>";
                  echo $page->author;
                  echo "</td><td>";
                  echo $page->publish_date;
                  echo "</td>";
              }
            ?>
            	
            </table>
          </div>