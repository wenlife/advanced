 <?php
   //var_export($article);
use yii\helpers\Html;
use backend\modules\content\libary\InformationConverse;
?>
<section class="content">
<div class="row">
<div class="box box-primary">
    <div class="box-header with-border">
         <h3 class="box-title">文章列表</h3>

    </div>
    <!-- /.box-header -->
    <div class="box-body">
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
</div>
</div>
</section>
      