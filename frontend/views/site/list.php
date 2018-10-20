 <?php
   //var_export($article);
use yii\helpers\Html;
use backend\modules\content\libary\InformationConverse;
?>

      <div class="panel panel-default" >
        <div class="panel-notice"></div>
        <table class="table table-hover">
        <?php
          if (empty($article)) {
             echo "<tr><td colspan=3>没有信息！</td></tr>";
          }

          foreach ($article as $key => $page) {
              $converter = new InformationConverse($page);
              echo "<tr><td>";
              echo Html::a($page->title,$converter->contentFrontView());
              echo "</td><td>";
              echo $page->author;
              echo "</td><td>";
              echo $page->publish_date;
              echo "</td>";
          }
        ?>    	
        </table>
      </div>
      