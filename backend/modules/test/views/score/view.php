<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\test\models\TestScore */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Test Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-score-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>



 <?php 

    $order = 1;
    //var_export($itemsAllType);
    $givenAnswer = unserialize($answer);
   // exit(var_export($answer));
    foreach ($itemsAllType as $typeKey => $items) {

        foreach ($items as $itemKey => $item) {
           
?>
<div class="well">
<div class="row">
<div class="col-sm-10 item-border">
<?php
 if ($item->getViewName()=='mmo') {
            $order+=3;
            echo $this->render('display/'.$item->getViewName(),['order'=>$order++,'model'=>$item,'givenAnswer'=>$givenAnswer]);
        }else{
            $order+=1;
            echo $this->render('display/'.$item->getViewName(),['order'=>$order++,'model'=>$item,'givenAnswer'=>$givenAnswer[$item->id]]);
        }
?>
</div>
</div>
</div>

<?php
        }          
    }

?>

</div>
<?php

function rshowAnswer($options,$rightanswer,$givenanswer)
{
        
        foreach ($options as $key => $option) {
            if (is_array($rightanswer)) {

                if (in_array($key, $givenanswer)) {
                    if (in_array($key, $rightanswer)) {
                       $color = 'success';
                    }else{
                       $color = 'danger';
                    }
                }else{
                    $color ='';
                }
                if (in_array($key, $rightanswer)) {
                   $ifright = '(正确答案)';
                }else{
                    $ifright = '';
                }
                echo "<tr style='text-indent:20px' class='$color'><td colspan=3>$options[$key]$ifright</td></tr>";
            }else{

                if ($key==$givenanswer) {
                        if ($givenanswer==$rightanswer) {
                            $color ='success';
                        }else{
                            $color = 'danger';
                        }
                }else{
                        $color='';
                }
                //$color = ($key==$givenanswer&&$givenanswer==$rightanswer)?'text-success':'text-danger';
                $ifright = $key==$rightanswer?'(正确答案)':'';
                echo "<tr style='text-indent:20px' class='$color'><td colspan=3>$options[$key]$ifright</td></tr>";
            }
       }
}

?>


<style type="text/css">
label{
    font-weight: normal;
    width:100%;
    text-indent: 20px;
    line-height: 25px;
}
label>input{
    margin-right: 20px;
    width:30px;
}
label:hover{
    background-color:white;
}
</style>
