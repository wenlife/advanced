<?php

namespace backend\modules\content\controllers;

use Yii;
use backend\modules\content\models\Picturelist;
use backend\modules\content\models\PicturelistSearch;
use backend\modules\content\forms\UploadPic;
use backend\modules\content\models\Picture;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use backend\modules\content\models\ContentMenu;



/**
 * PicturelistController implements the CRUD actions for Picturelist model.
 */
class PicturelistController extends Controller
{
    //public $layout = '/center';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Picturelist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PicturelistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Picturelist model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $pModel = new Picture();
        $pictures = $pModel->find()->where(['infoid'=>$id])->orderby('showorder')->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'pictures'=>$pictures,
        ]);
    }

    /**
     * Creates a new Picturelist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Picturelist();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d',time());
            $model->author = Yii::$app->user->identity->username;
            $imageFile = UploadedFile::getInstance($model,'cover');
            if ($imageFile!=null){
                $url = 'upload/cover/'.uniqid().'.'.$imageFile->extension;
                if (in_array($imageFile->extension,['jpg','png','jpeg','gif','swf'])) {
                   $imageFile->saveAs($url);
                }else{
                    exit('您上传的封面不是图片！');
                }     
                $model->cover = $url;
            }else{
                $model->cover='';
            }
            
            if ($model->save()) {

               //$contentMenu = new ContentMenu();
              // $contentMenu->getVals($model->cid,$model->id,'picture',$model->title,$model->note,$model->author,$model->date);
              // $contentMenu->save();
               return $this->redirect(['view', 'id' => $model->id]);
            }else{
               exit('数据库保存失败！');
            }          
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Picturelist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$contentMenu = ContentMenu::find()->where(['articleid'=>$id])->one();
        $url = $model->cover;
        if ($model->load(Yii::$app->request->post())) {
            //是否上传了新的图片，如果是，删除原图，替换为新图
             $imageFile = UploadedFile::getInstance($model,'cover');
             if ($imageFile!=null) {
                if ($url!=null) {unlink($url);} 
                $url = 'upload/cover/'.uniqid().'.'.$imageFile->extension;
                if (in_array($imageFile->extension,['jpg','png','jpeg','gif','swf'])) {
                   $imageFile->saveAs($url);
                }else{
                    exit('您上传的封面不是图片！');
                }     
             }
             $model->cover = $url;
            if($model->save()){
             // $contentMenu->getVals($model->cid,$model->id,'picture',$model->title,$model->note,$model->author,$model->date);
             //  $contentMenu->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                exit('保存失败！');
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpload($id)
    {
       $uploadForm = new UploadPic();
       $picture = new Picture();
       $post = Yii::$app->request->post();
       if ($uploadForm->load(Yii::$app->request->post())) {
           $imageFile = UploadedFile::getInstance($uploadForm,'imageFile');
           $filename = uniqid();
           $url = 'upload/picture/'.$filename.'.'.$imageFile->extension;
          
           //exit(var_export($picture->toArray()));
           $picture->headline = $uploadForm->title;
           $picture->infoid = $id;
           $picture->picitem = 2;
           $picture->describes = $uploadForm->attachdesc;
           $picture->showorder = $uploadForm->showorder;
           $picture->filename = $filename;
           $picture->expand_name = $imageFile->extension;
           $picture->url = $url;
           $picture->releaser = Yii::$app->user->identity->username;
           $picture->release_date = time();
           $imageFile->saveAs($url);
           $picture->size = $imageFile->size;
           $imageWH = getimagesize($url);
           $picture->keywords = $imageWH[0].'*'.$imageWH[1] ;

           if ($picture->save()) {
               $this->redirect(['view','id'=>$id]);
           }else{
               unlink($url);
               exit(var_export($picture->getErrors()));
           }    
       }
       return $this->render('upload',['model'=>$uploadForm]);
    }

    public function actionDeletepic($id,$listid)
    {
        $picModel = new Picture();
        $pic = $picModel->findOne($id);
        if ($pic->url) {
           unlink($pic->url);
        }
        $pic->delete();
        return $this->redirect(['view','id'=>$listid]);
    }
    /**
     * Deletes an existing Picturelist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->cover) {unlink($model->cover);}
        $model->delete();
        //删除保存的图片
        $picModel = new Picture();
        $pics = $picModel->find()->where(['infoid'=>$id])->all();
        if (!empty($pics)) {
           if($picModel->deleteAll(['infoid'=>$id]))
           {
               foreach ($pics as $key => $pic) {
                    if ($pic->url) {
                       unlink($pic->url);
                    }
               }
            }
        }


        return $this->redirect(['index']);
    }

    /**
     * Finds the Picturelist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Picturelist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Picturelist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
