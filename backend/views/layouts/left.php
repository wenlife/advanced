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
                    ['label' => '主页','icon' => 'dashboard text-green', 'url' => ['/site/center']],
                    
                    //成绩分析系统
                    ['label' => '系统功能模块', 'options' => ['class' => 'header']],
                    ['label' => '成绩分析模块','icon' => 'bar-chart text-red', 'url' => ['/testService/exam']],
                    //选课建议系统
                    ['label' => '选科指导模块','icon'=>'cog','items'=>[
                        ['label' => '内容待定','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ]],
                    //信息技术练习
                    ['label' => '在线教学模块','icon'=>'cog','items'=>[
                        ['label' => '试题管理','icon'=>'globe', 'url' => ['/test/item']],
                        ['label' => '试卷管理','icon'=>'leaf','url' => ['/test/testpaper']],
                        ['label' => '课堂任务','icon'=>'tasks', 'url' => ['/test/task']],
                    ]],
                    //文章系统
                    ['label' => '信息发布模块','icon'=>'cog','items'=>[
                        ['label' => '内容','icon'=>'book','url' => ['/content/contentmenu']],
                        ['label' => '文章','icon'=>'book','url' => ['/content/article']],
                        ['label' => '视频','icon'=>'play', 'url' => ['/content/videolist']],
                        ['label' => '图片','icon'=>'tint', 'url' => ['/content/picturelist']],             
                        ['label' => '栏目', 'icon'=>'tasks','url' => ['/content/infoitem']],
                    ]],

                    //用户关系
                    ['label' => '学校关系系统', 'options' => ['class' => 'header']],
                     ['label' => '报名系统','icon'=>'cog','items'=>[
                           ['label'=>'录取表管理','icon'=>'user','url'=>['#']],
                           ['label'=>'报名管理','icon'=>'user','url'=>['#']],
                           ['label'=>'学生基础信息完善','icon'=>'user','url'=>['#']],
                    ]],

                    ['label' => '学校人事管理','icon'=>'cog','items'=>[
                        ['label'=>'学生信息管理系统','icon'=>'user','url'=>['#']],
                        ['label'=>'教师信息管理系统','icon'=>'user','url'=>['#']],
                    ]],
                    ['label' => '学校任教单元管理','icon'=>'cog','items'=>[
                    ['label' => '学期','icon'=>'calendar text-blue','url' => ['/school/teachyear']],
                    ['label' => '班级','icon'=>'group text-primary','url' => ['/school/teachclass']],
                    ['label' => '任教','icon'=>'tripadvisor text-primary','url' => ['/school/teachmanage']],
                    ]],
                    ['label' => '系统管理', 'options' => ['class' => 'header']],
                    ['label' => '前台界面设置','icon'=>'cog','items'=>[
                        ['label'=>'置顶图片','icon'=>'fire','url'=>['/interface/logo']],
                        ['label'=>'前台栏目设置','icon'=>'th','url'=>['/interface/setting']],
                        ['label'=>'学生中心通知设置','icon'=>'bell','url'=>['/interface/notice']],
                    ]],
                    ['label' => '系统用户管理','icon'=>'cog','items'=>[
                        ['label'=>'管理员','icon'=>'user','url'=>['/guest/adminuser']],
                        ['label'=>'学生用户','icon'=>'user','url'=> ['/guest/user']],
                        ['label'=>'教师用户','icon'=>'user text-blue','url' => ['/guest/teacher']],
                    ]],
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