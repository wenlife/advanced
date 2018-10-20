<?php

namespace backend\modules\content\controllers;

use Yii;
use backend\modules\content\models\Videolist;
use backend\modules\content\models\Video;
use backend\modules\content\models\VideolistSearch;

use backend\modules\content\forms\UploadOnly;
use yii\web\UploadedFile;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\content\models\ContentMenu;


/**
 * VideolistController implements the CRUD actions for Videolist model.
 */
class VideolistController extends Controller
{
    //使用其他模板
    //public $layout="/center.php";

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
     * Lists all Videolist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = Videolist::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single Videolist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $videoModel = new Video();
        $videos = $videoModel->find()->where(['infoid'=>$id])->orderBy('showorder')->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'videos'=>$videos,
            'id'=>$id,
        ]);
    }

    /**
     * Creates a new Videolist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Videolist();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d',time());
            $model->author = Yii::$app->user->identity->username;
            if($model->save())
            {
              return $this->redirect(['view', 'id' => $model->id]);
            }else{
              exit(var_export($model->getErrors()));
           }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Videolist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       // $contentMenu = ContentMenu::find()->where(['articleid'=>$id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // $contentMenu->getVals($model->cid,$model->id,'picture',$model->title,$model->note,$model->author,$model->date);
           // $contentMenu->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     *
     */
    public function actionCover($id)
    {
        $model = new UploadOnly();
        $videolist = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($url = $model->upload()) {
                $videolist->cover = $url;
                $videolist->save();
               $this->redirect(['/content/videolist']);
            }
        }
        return $this->render('cover', ['model' => $model]);
    }

    /**
     * Deletes an existing Videolist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {  
        $this->findModel($id)->delete();
        $videoModel = new Video();
        //同时删除视频库的数据，并且删除文件；同时删除封面文件
        $video =$videoModel->find()->where(['infoid'=>$id])->all();
        foreach ($video as $key => $value) {
           unlink($value->url);
           if ($value->cover) {unlink($value->cover);}
           $value->delete();    
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Videolist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videolist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videolist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
