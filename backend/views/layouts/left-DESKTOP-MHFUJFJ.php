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
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],

                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                    ['label'=>'用户','icon'=>'user','url'=>'#','items'=>[

                        ['label'=>'管理员','icon'=>'user','url'=>['/guest/adminuser']],
                        ['label'=>'学生','icon'=>'user','url'=> ['/guest/user']],
                        ['label'=>'班级','icon'=>'user','url'=>['/guest/userclass']],
                        ['label'=>'教师','icon'=>'user','url'=>['/guest/teacher']],

                    ]],
                    ['label' => '文章','icon'=>'book','items'=>[
                        ['label' => '文章','icon'=>'book','url' => ['/content/article']],
                        ['label' => '视频','icon'=>'play', 'url' => ['/content/videolist']],
                        ['label' => '图片','icon'=>'tint', 'url' => ['/content/picturelist']],

                     ]],
                    ['label' => '界面','icon'=>'cog', 'items'=>[
                        ['label'=>'首页图片','icon'=>'fire','url'=>['/interface/logo']],
                        ['label'=>'首页栏目设置','icon'=>'th','url'=>['interface/setting']],
                        ['label'=>'首页通知设置','icon'=>'bell','url'=>['interface/notice']],
                    ]],
                             
                    ['label' => '栏目', 'icon'=>'tasks','url' => ['/content/infoitem']],
                    ['label' => '练习','icon'=>'dashboard','items'=>[
                        ['label' => '试题','icon'=>'globe', 'url' => ['/test/item']],
                        ['label' => '作业','icon'=>'leaf','url' => ['/test/testpaper']],
                        ['label' => '任务','icon'=>'tasks', 'url' => ['/test/task']],
                    ]],


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