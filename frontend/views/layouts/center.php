<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\models\Indexsetting;
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
    'brandLabel' => '攀枝花七中校内网',
    'brandUrl' =>'http://www.pzhqz.com', //Yii::$app->homeUrl,
    'options' => [
        'class' => 'my navbar-inverse navbar-fixed-top',
    ],
]);

echo Nav::widget([
    'items'=>[
        ['label' => '个人中心', 'url' => ['/center']], 
    ],
    'options'=>['class'=>'navbar-nav'],
]);
$menuItems = [
   // ['label'=>'学习中心','url'=>['learn']],
    ['label'=>'查询成绩','url'=>['center/score']],
    ['label'=>'任务列表','url'=>['center/task']],
    ['label'=>'个人信息','url'=>['center/detail']],
    ['label'=>'测试中心','url'=>['center/test']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    $menuItems[] = ['label' => 'signup', 'url' => ['/site/signup']];
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
                <?php
                $setting = new Indexsetting();
                $notice = $setting->find()->where(['type'=>3])->one();
                if($notice){
            ?>
            <div class="alert alert-info alert-dismissible" role="alert" style="margin:0px; height:auto">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <div class="notice">
                 <?=$notice->content?>
             </div>
    
            </div>
            <?php
              }
            ?>
        </div>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
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