<?php
use yii\helpers\Url;
$this->title = "测试管理";
?>

<div class="guest-default-index">
        <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">分类项目</span>
              <span class="info-box-number">90<small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">试题数</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">试卷数</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">测试数</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <div class="row">
        <div class="col-md-6">
                     <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">任务完成情况</h3>
              
              <div class="box-tools pull-right">
                <a href="index.php?r=test/task" title="点击管理全部任务"><span class="label label-success">任务管理</span></a>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>内容</th>
                    <th>测试</th>
                    <th>测试完成数</th>
                     <th>具体</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    foreach ($tasks as $key => $task) {
                  ?>
                  <tr>
                    <td><a"><?=$task->id?></td>
                    <td><?=$task->title?></td>
                    <td><?=$task->paper->title?></td>
                    <td>
                      <span class="label label-success"><?=$taskCount[$task->id]?></span>
                    </td>
                    <td>
                      <a href="<?=Url::toRoute(['/test/testpaper/score','testid'=>$task->paper->id])?>" class="">查看</a>
                    </td>
                  </tr>
                  <?php

                    }
                  ?>
             
                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
        </div>
        <div class="col-md-6">
          <?php
            $color=['bg-green','bg-yellow','bg-red','bg-aqua'];
            $icon = ['ion-ios-heart-outline','ion-ios-pricetag-outline','ion-ios-cloud-download-outline','ion-ios-cloud-download-outline'];
            foreach ($classes as $key => $class) {
          ?>
          <div class="info-box <?=$color[array_rand($color)]?>">
            <span class="info-box-icon"><i class="ion <?=$icon[array_rand($icon)]?>"></i></span>

            <div class="info-box-content">
              <a href="index.php?r=site/myclass" class="boxlink"><span class="info-box-text"><?=$class->teachclass->title?></span></a>
              <span class="info-box-number"><?=$classDetail[$class->class_id]['studentCount']?>人</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    未完成当前任务人数<?=$classDetail[$class->class_id]['submitYet']?>，平均分<?=$classDetail[$class->class_id]['avg']?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
        <?php   
              }
          ?>
        </div>
    </div>
</div>
