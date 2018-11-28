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
              <li class="active"><a href="#test" data-toggle="tab" aria-expanded="false">课堂任务</a></li>
              <li class=""><a href="#content" data-toggle="tab" aria-expanded="false">信息技术学习</a></li>   
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">信息技术练习</a></li>
            </ul>
            <div class="tab-content">

            <div class="tab-pane" id="content">
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
              <div class="tab-pane  active" id="test">
              <div class="row">
                <div class="col-md-4">
                     <div class="box hover">                     
                        <div class="box-body">
                                    <div id="indicatorContainer" class="text-center">
                                
                                   </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                         <p class="text-center">个人任务完成</p>
                        </div>
                        <!-- /.box-footer-->
                      </div>

                </div>
                <div class="col-md-4">
                      <div class="box hover">                     
                        <div class="box-body">
                                    <div id="indicatorContainer1" class="text-center">
                                
                                   </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                             <p class="text-center">班级任务完成</p>
                        </div>
                        <!-- /.box-footer-->
                      </div>
       
                </div> 
                                <div class="col-md-4">
                      <div class="box hover">                     
                        <div class="box-body">
                                    <div id="indicatorContainer2" class="text-center">
                                
                                   </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <p class="text-center">学期时间</p>
                        </div>
                        <!-- /.box-footer-->
                      </div>
       
                </div>   
              </div>
              <div class="row">
                <div class="col-md-12">
                     <div class="box box-primary" >
                        <div class="box-header with-border">
                          <h3 class="box-title">今日学习内容</h3>

                          <div class="box-tools pull-right">
                            <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                          </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="min-height:200px">
                          <p>
                            <?=$task->feedback?>
                            
                          </p>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer box-comments">
                          <div class="box-comment">
                            <!-- User image -->
                            <div class="comment-text">
                                  <span class="username">
                                    备注
                                    <span class="text-muted pull-right">8:03 PM Today</span>
                                  </span><!-- /.username -->
                              每节课按时完成任务，任务完成不合格的班级将会受到处罚
                            </div>
                            <!-- /.comment-text -->
                          </div>
                        </div>
                        <!-- /.box-footer-->
                      </div>
                  </div>

              </div>
            
              </div>


              <div class="tab-pane" id="settings">
                <div class="bs-example" data-example-id="thumbnails-with-custom-content">
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img data-src="holder.js/100%x200" alt="100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTY3MTE2Nzg2YmQgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjcxMTY3ODZiZCI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
          <div class="caption">
            <h3>现在进行时</h3>
            <p>学习现在进行时的用法和</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img data-src="holder.js/100%x200" alt="100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTY3MTE2N2E1ZDQgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjcxMTY3YTVkNCI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
          <div class="caption">
            <h3>非谓语动词</h3>
            <p>非谓语动词的基本形式和用法</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img data-src="holder.js/100%x200" alt="100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTY3MTE2N2E3NmEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNjcxMTY3YTc2YSI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
          <div class="caption">
            <h3>匀速直线运动</h3>
            <p>抛物线运动的分析方法和</p>
          </div>
        </div>
      </div>
    </div>
  </div>
                  
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>


<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/radialIndicator.js"></script>
<script type="text/javascript">
var bg1 = radialIndicator('#indicatorContainer',{
            barColor: '#87CEEB',
            barWidth: 10,
            initValue: 80,
            roundCorner : true,
            percentage: true
        });

  $('.hover').mouseover(function(){
    $(this).css('border','1px solid #ccc');
    bg1.option('barColor','#ccc');
  });
  $('.hover').mouseout(function(){
    $(this).css('border','none');
  });


  // $('#indicatorContainer').radialIndicator({
  //               barColor: '#87CEEB',
  //               barWidth: 10,
  //               initValue: 80,
  //               roundCorner : true,
  //               percentage: true
  //           });
    $('#indicatorContainer1').radialIndicator({
                barColor: '#3fc',
                barWidth: 10,
                initValue: 40,
                roundCorner : true,
                percentage: true
            });
        $('#indicatorContainer2').radialIndicator({
                barColor: 'red',
                barWidth: 10,
                initValue: 40,
                roundCorner : true,
                percentage: true
            });
</script>