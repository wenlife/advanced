<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = '个人信息';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->identity->username;
if(file_exists("avatar/1/$id.png"))
{
  $file = "avatar/1/$id.png";
}else{
  $file = $detail->gender==2?"avatar/1/female.png":"avatar/1/male.png"; 
}
?>
<div class="site-index">
<div class="row">

<section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">留言板</a></li>
              <li><a href="#timeline" data-toggle="tab">好友动态</a></li>
              <li><a href="#settings" data-toggle="tab">个性设置</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">马文林</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    同学们，我们的信息技术学习网站正在开发中。该网站开发的目标是不仅让大家能够在线完成信息技术的学习和考试，同时也能完成其他科目的在线学习，查询管理自己的个人信息，并且能直接参与学校的各项事务中，还能提供选科方面的指导，在线娱乐的区域。还有学校内部各个年级，各个同学之间的信息交流平台，因此希望大家共同努力，建设起我们七中校园的快乐平台，请大家积极提供新功能建议和改进意见！
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">江老师</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    同学们，如果大家在学习中遇到了任何自己无法解决的心理烦恼，请大家来找我。我将会为大家解决
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">发送</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">刘老师</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <li class="time-label">
                    <span class="bg-green">
                        2018年10月8日
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">你</a> 评论了陈浩南的状态</h3>

                      <div class="timeline-body">
                         包真的在你头上啊，你是不是傻！
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-danger btn-flat btn-xs">删除</a>
                      </div>
                    </div>
                  </li>
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          2018年10月7日
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">高一年级</a>发布了状态</h3>

                      <div class="timeline-body">
                        今天晚上七点在操场开展全年级成绩分析大会及关于李怀特同学等打架斗殴的处理教育决定，请各位同学和老师按时参加！
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">查看</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li class="time-label">
                    <span class="bg-green">
                        2018年10月2日
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">陈浩南</a> 回复了你</h3>

                      <div class="timeline-body">
                         兄弟放心，包在我头上！
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">查看回复</a>
                      </div>
                    </div>
                  </li>
                  <!-- timeline item -->
                  <li class="time-label">
                    <span class="bg-green">
                        2018年10月2日
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">陈浩南</a>同意了你的好友请求
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li class="time-label">
                    <span class="bg-green">
                        2018年10月1日
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">金沙湾老大</a> 评论了你的状态</h3>

                      <div class="timeline-body">
                         请问你是哪个班的，下课找你比划一下！
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">查看回复</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          2018年9月1日
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">刘老师</a> 上传了图片</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">隐身</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="see" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">联系方式</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="contact" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">主题颜色</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="color" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">个人状态</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="state" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">提交</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
</div>


</div>

