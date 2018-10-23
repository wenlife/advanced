<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'center';

?>
 <link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">用户数量</span>
              <span class="info-box-number"><small>教师12</small></span>
              <a href="index.php?r=site/myclass"><span class="info-box-number"><small>学生<?=$students?></small></span></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-book-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">文章数量</span>
              <span class="info-box-number"><?=$articles?>篇</span>
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
            <span class="info-box-icon bg-green"><i class="ion ion-ios-copy-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">试题数量</span>
              <span class="info-box-number"><?=$testItems?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-bluetooth-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">访问次数</span>
              <span class="info-box-number count">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">

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

             
                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>

          </div>
          <!-- /.box -->

       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">服务器信息</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <ul>
                  <li>操作系统 <?=php_uname()?></li>
                  <li>PHP版本 <?=PHP_VERSION?></li>
                  <li>PHP运行 <?=php_sapi_name() ?></li>
                  <li>YII版本 <?=Yii::getVersion()?></li>
                  <li><span id="nowTime"></span> 
                  </li>
                
    
              
              <script language="JavaScript">
                document.write("<li>浏览器名称: "+navigator.appName+"</li>");
                document.write("<li>浏览器版本号: "+navigator.appVersion+"</li>");
                document.write("<li>系统语言: "+navigator.systemLanguage+"</li>");
                document.write("<li>系统平台: "+navigator.platform+"</li>");
                document.write("<li>浏览器是否支持cookie: "+navigator.cookieEnabled+"</li>");
              </script>
              </ul>
              <!-- /.table-responsive -->
            </div>

          </div>


        </div>
        <!-- /.col -->

        <div class="col-md-4">

          <div class="info-box ">
            <span class="info-box-icon"><i class="icon"></i></span>

            <div class="info-box-content">
              <a href="index.php?r=site/myclass" class="boxlink"><span class="info-box-text"></span></a>
              <span class="info-box-number">人</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    未完成当前任务人数
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

     </div>
     </div>   
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <style type="text/css">
    .boxlink{
      color:white; 
    }
    a.boxlink:hover{
      color:blue; 
    }
  </style>

  <script type="text/javascript">
    function current(){ 
  var  d  = new Date();
  var str = '系统时间：'; 
    str +=d.getFullYear()+'年'; //获取当前年份 
    str +=d.getMonth()+1+'月'; //获取当前月份（0——11） 
    str +=d.getDate()+'日'; 
    str +=d.getHours()+'时'; 
    str +=d.getMinutes()+'分'; 
    str +=d.getSeconds()+'秒'; 
  return str; 
} 
setInterval(function(){$("#nowTime").html(current)},1000); 
</script> 
