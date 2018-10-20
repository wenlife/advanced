<?php

namespace backend\modules\content\controllers;

use Yii;
use backend\modules\content\models\Video;
use backend\modules\content\models\VideoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\modules\content\forms\UploadForm;
use yii\web\UploadedFile;

/**
 * VideoController implements the CRUD actions for Video model.
 */
class VideoController extends Controller
{
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
     * Lists all Video models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model  = Video::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }


    public function actionUpload($infoid)
    {
         $model = new UploadForm();
		 $model_video = new Video();

        if (Yii::$app->request->isPost) {
     // *@property integer $attachid
     // * @property integer $infoid
     // * @property integer $gbid
     // * @property string $attachdesc
     // * @property integer $showorder
     // * @property string $size
     // * @property string $filename
     // * @property string $expand_name
     // * @property string $url
     // * @property string $keywords
     // * @property integer $level
     // * @property integer $filestatus
     // * @property integer $isdl
     // * @property string $releaser
     // * @property string $release_date
     // * @property string $deletedate
            //$model->load(Yii::$app->request->post());
             $post = Yii::$app->request->post();
            //$post = $post['UploadForm'];

            if (is_numeric($infoid)) {
                $model->infoid = $infoid;
            }else{
                exit("unexpected value of infoid!");
            }
            //$model->infoid = $post['infoid'];
            //$model->attachdesc = $post['attachdesc'];
            // $model->showorder = $post['showorder'];
           // $model->setAttributes($post);
            $model->load(Yii::$app->request->post());
            //$model->showorder = $post['showorder'];
             //exit(var_export($model->toArray()));
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            //exit(var_export($model->toArray()));

            if ($url = $model->upload()) {
                $model_video->infoid = $model->infoid;
                $model_video->attachdesc = $model->attachdesc;
                $model_video->showorder = $post['UploadForm']['showorder'];
                $model_video->filename = $model->filename;//$model->imageFile->baseName;
                $model_video->expand_name = $model->imageFile->extension;
                $model_video->size  = $model->imageFile->size;
                $model_video->release_date = time();
                $model_video->releaser = Yii::$app->user->identity->username;
                $model_video->url = $url;
                $model_video->save();
                $this->redirect(['videolist/index']);
               //exit(var_export($model_video->toArray()));
            }
        }
        return $this->render('upload', ['model' => $model,'infoid'=>$infoid]);
    }
    /**
     * Displays a single Video model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $video =  $this->findModel($id);
        $videoModel = new Video();
        $videoCollection = $videoModel->find(['id','filename'])->where(['infoid'=>$video->infoid])->orderBy('showorder')->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'collection'=>$videoCollection,
        ]);
    }

    /**
     * Creates a new Video model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
        $model = new Video();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {          
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Video model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Video model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$listid=null)
    {
        $model = $this->findModel($id);
        unlink($model->url);
        $model->delete();
       // return $this->redirect(['index']);
        if ($listid) {
            return $this->redirect(['videolist/view','id'=>$listid]);
        }else{
            return $this->goBack();
        }
        
    }

    /**
     * Finds the Video model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Video the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
