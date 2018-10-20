<?php
/* @var $this yii\web\View */
use backend\modules\content\models\Information;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'My Yii Application';
$id = Yii::$app->user->identity->username;
if(file_exists("avatar/1/$id.png"))
{
  $file = "avatar/1/$id.png";
}else{
  if($detail->gender==2)
  {
    $file = "avatar/1/female.png";
  }else{
    $file = "avatar/1/male.png";
  }
  
}
?>
<link rel="stylesheet" type="text/css" href="css/font-awesome.4.6.0.css">
<link rel="stylesheet" href="css/amazeui.min.css">
<link rel="stylesheet" href="css/amazeui.cropper.css">
<link rel="stylesheet" href="css/custom_up_img.css">
<style type="text/css">
  .up-img-cover {width: 100px;height: 100px;}
  .up-img-cover img{width: 100%;}
</style>
<div class="site-index">
    <div class="body-content">
    <div class="row">
      <h1><?=$detail->name?>的个人信息</h1>
      <table class="table table-bordered">
        <tr>
        <td rowspan="2"><center>
              <div class="up-img-cover"  id="up-img-touch" >
                <a href="index.php?r=center/avatar">
                <img class="am-circle" alt="点击图片上传" src=<?=$file?> />
              </a>
              </div>
            </center>
        </td>
        <td><?=$detail->name?></td>
        </tr>
        <tr><td><?=$class->title?></td></tr>
        <tr><td colspan="1">详细信息编辑中......<td></tr>
      </table>
    </div>
</div>
</div>

