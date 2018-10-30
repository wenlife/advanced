<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
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
        'brandUrl' =>'http://www.pzhqz.com', //Yii::$app->homeUrl,
        'options' => [
            'class' => 'my navbar-inverse navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'items'=>[
            ['label' => '个人中心', 'url' => ['/center']],
            ['label' => '选科指导中心', 'url' => ['/center']], 
        ],
        'options'=>['class'=>'navbar-nav'],
    ]);

        $menuItems = [
         

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
        <div class="row my">
            <div class="jumbotron"></div>
        </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])?>
        <?= Alert::widget() ?>
        <div class="row my">
            <div class="my col-sm-12">
            <?= $content ?>
            </div>
      
        </div>
    </div>
</div>


<div class="footer" style="clear:both;height: auto">
    <div class="container">
        <p class="text-center">攀枝花七中信息技术教研组 倾力制作</p>
        <p class="text-center">Yii powerd</p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
