<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use backend\modules\content\models\infoitem;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '攀枝花第七高级中学',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'my navbar-inverse navbar-fixed-top',
        ],
    ]);


    $databaseMenu = infoitem::find()->orderBy(['parentid'=>'desc'])->all();

    //var_export($contentMenu);
    $contentMenu = ARRAY();
    foreach ($databaseMenu as $key => $value) {
        if($value->parentid==0){
            $contentMenu[$value->itemid] = $value;
        }

    }

    echo Nav::widget([
        'items'=>[
            ['label' => 'Center', 'url' => ['/site/center']],
        ],
        'options'=>['class'=>'navbar-nav'],
    ]);

    $menuItems = [
        
        ['label' => '用户', 'items'=>[

            ['label' => '管理员', 'url' => ['/guest/adminuser']],
            ['label' => '学生', 'url' => ['/guest/user']],
            ['label' => '班级', 'url' => ['/guest/userclass']],
            ['label' => '教师', 'url' => ['/guest/teacher']],
        ]],

        ['label' => '文章','items'=>[
            ['label' => '文章', 'url' => ['/content/article']],
            ['label' => '视频', 'url' => ['/content/videolist']],
            ['label' => '图片', 'url' => ['/content/picturelist']],

        ]],

        ['label' => '界面', 'items'=>[
            ['label'=>'首页图片','url'=>['/interface/logo']],
            ['label'=>'首页栏目设置','url'=>['interface/setting']],
        ]
        ],
         
        ['label' => '栏目', 'url' => ['/content/infoitem']],
        
        ['label' => '练习','items'=>[
            ['label' => '试题', 'url' => ['/test/item']],
            ['label' => '作业', 'url' => ['/test/testpaper']],
            ['label' => '任务', 'url' => ['/test/task']],
        ]],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>
    <div class="container">
    <div class='row'>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    </div>
</div>


<div class="footer" style="clear:both;height: auto">
    <div class="container">
        <p class="text-center">小马飞奔工作室 倾力制作</p>
        <p class="text-center">Yii powerd</p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
