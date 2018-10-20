<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/avatar/default.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username;?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    //主页设置
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => '主页','icon' => 'dashboard text-green', 'url' => ['/site/index']],
                //    ['label' => '界面','icon'=>'cog', 'items'=>[
                    ['label'=>'首页图片','icon'=>'fire','url'=>['/interface/logo']],
                    ['label'=>'首页栏目设置','icon'=>'th','url'=>['/interface/setting']],
                    ['label'=>'首页通知设置','icon'=>'bell','url'=>['/interface/notice']],
               //     ]],
                    //成绩分析系统
                    ['label' => '成绩分析系统', 'options' => ['class' => 'header']],
                    ['label' => '考试','icon' => 'bar-chart text-red', 'url' => ['/testService/exam']],
                    //选课建议系统
                    ['label' => '选课系统', 'options' => ['class' => 'header']],
                    ['label' => '选课政策','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ['label' => '学科简介','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ['label' => '专业要求','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ['label' => '倾向测试','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ['label' => '综合推荐','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    //信息技术练习
                    ['label' => '信息技术练习', 'options' => ['class' => 'header']],
                    ['label' => '试题','icon'=>'globe', 'url' => ['/test/item']],
                    ['label' => '作业','icon'=>'leaf','url' => ['/test/testpaper']],
                    ['label' => '任务','icon'=>'tasks', 'url' => ['/test/task']],
                    //英语单词测试
                    ['label' => '英语测试', 'options' => ['class' => 'header']],
                    ['label' => '单词过关','icon'=>'tasks', 'url' => ['/english/wordTest']],
                    //文章系统
                    ['label' => '内容管理', 'options' => ['class' => 'header']],
                    ['label' => '内容','icon'=>'book','url' => ['/content/contentmenu']],
                    ['label' => '文章','icon'=>'book','url' => ['/content/article']],
                    ['label' => '视频','icon'=>'play', 'url' => ['/content/videolist']],
                    ['label' => '图片','icon'=>'tint', 'url' => ['/content/picturelist']],             
                    ['label' => '栏目', 'icon'=>'tasks','url' => ['/content/infoitem']],
                    //用户管理
                    ['label' => '用户信息', 'options' => ['class' => 'header']],
                    ['label'=>'管理员','icon'=>'user','url'=>['/guest/adminuser']],
                    ['label'=>'学生','icon'=>'user','url'=> ['/guest/user']],
                    ['label' => '教师','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    //用户关系
                    ['label' => '学校结构', 'options' => ['class' => 'header']],
                    ['label' => '学期','icon'=>'calendar text-blue','url' => ['/school/teachyear']],
                    ['label' => '班级','icon'=>'group text-primary','url' => ['/school/teachclass']],
                    ['label' => '任教','icon'=>'tripadvisor text-primary','url' => ['/school/teachmanage']],
                    //开发工具
                    ['label' => '工具', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>