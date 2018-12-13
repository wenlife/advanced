<?php
use yii\helpers\Html;
?>
<p class="btn-group">
    <?= Html::a('总体成绩', ['dash','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('班级进步', ['improve','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('达标统计', ['beyondline','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('班级成绩', ['bj','school'=>$school,'exam'=>$exam->id], ['class' => 'btn btn-success']) ?>
</p>