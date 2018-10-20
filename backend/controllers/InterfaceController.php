<?php
namespace backend\controllers;

use Yii;
use backend\modules\content\forms\UploadPic;
use backend\modules\content\models\infoitem;
use backend\modules\content\models\Picturelist;
use common\models\Indexsetting;
use backend\models\IndexForm;

class InterfaceController extends \yii\web\Controller
{
	//public $layout = 'center';
    public function actionIndex()
    {
      
        return $this->render('index');
    }

    public function actions()
    {
        return[
           
            'upload' => ['class' => 'kucha\ueditor\UEditorAction',],

        ];
    }

    public function actionLogo()
    {

    	$model = new UploadPic();
    	if (Yii::$app->request->post()) {
    		return;
    	}
    	return $this->render('logo',['model'=>$model]);
    }

    public function actionSetting()
    {
        $itemModel = new infoitem();
        $picturelistModel = new Picturelist();
        $setting = new Indexsetting();
        $indexForm = new IndexForm();

        $items = $itemModel->find()->all();
        $Picturelists = $picturelistModel->find()->all();

        $faceSetting = $setting->find()->where(['type'=>2])->one();
        if ($faceSetting) {
           $indexForm = unserialize($faceSetting->content);
        }else{
            $faceSetting = new Indexsetting();
        }

        if($indexForm->load(Yii::$app->request->post()))
            {
                $faceSetting->type='2';
                $faceSetting->content = serialize($indexForm);
                $faceSetting->note = '界面配置信息';
                $faceSetting->save();
               // return $this->redirect([''])
            }

    	return $this->render('setting',['items'=>$items,'picturelists'=>$Picturelists,'model'=>$indexForm]);
    }

    public function actionNotice()
    {
        $setting = new Indexsetting();
        $notice = $setting->find()->where(['type'=>3])->one();
        if (!$notice) {
            $notice = new Indexsetting();
        }
        if ($post = Yii::$app->request->post()) {
          $notice->type=3;
          $notice->content = $post['notice'];
          $notice->note = '首页通知';
          $notice->save();
        }
        return $this->render('notice',['notice'=>$notice->content]);
    }

}
