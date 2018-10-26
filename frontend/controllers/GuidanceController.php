<?php

namespace frontend\controllers;

class GuidanceController extends \yii\web\Controller
{
	public $layout = 'center';
    public function actionIndex()
    {
        return $this->render('index');
    }

}
