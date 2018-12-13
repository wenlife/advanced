<?php

namespace backend\modules\school\controllers;

use Yii;
use backend\modules\school\models\TeachManage;
use backend\modules\school\models\TeachmanageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\school\forms\Teach;
use backend\modules\school\models\TeachYearManage;
use backend\modules\school\models\TeachClass;
use backend\libary\CommonFunction;


/**
 * TeachmanageController implements the CRUD actions for TeachManage model.
 */
class TeachmanageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeachManage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeachmanageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $years = TeachYearManage::find()->all();
        $banji = TeachClass::find()->orderBy('serial')->all();
        $teachArray = array();
        $yearpost = 1;
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            //var_export($post);
            //exit();
            $yearpost = $post['yearpost'];
        }
            $teachMa = new TeachManage();
            $teachArray = array();
            //$subjectWithBzr = CommonFunction::getSubjects();
            //$subjectWithBzr['bzr'] = '班主任';
            foreach ($banji as $key_banji => $value_banji) {
                foreach (CommonFunction::getAllTeachDuty() as $subject => $subject_name) {
                    $teach = $teachMa::find()->where(['year_id'=>$yearpost,'class_id'=>$value_banji->id,'subject'=>$subject])->one();
                    if ($teach&&$teach->teacher) {
                       $teachArray[$value_banji->id][$subject] = ['id'=>$teach->id,'name'=>$teach->teacher->name];
                    }else{
                       // $teachArray[$value_banji->id][$subject] = ['id'=>'not','name'=>'not set'];
                    }
                   
                }
            }
        //  var_export($teachArray);
        // exit();

         //   $all = $teachma::find()->where(['year_id'=>$year])->all();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year'=>$years,
            'yearpost'=>$yearpost,
            'banji'=>$banji,
            'teachArray'=>$teachArray,
        ]);
    }

    /**
     * Displays a single TeachManage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TeachManage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeachManage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionAdd()
    {
        $teachmod = new TeachManage();
        $model = new Teach();
         if ($model->load(Yii::$app->request->post())) {

            
            foreach (CommonFunction::getAllTeachDuty() as $subject => $name) {
                $teachma = new TeachManage();
                if (isset($model->$subject)&&$model->$subject!=null) {
                   $teachma->year_id = 1;//$model->grade;
                   $teachma->class_id = $model->banji;
                   $teachma->teacher_id = $model->$subject;
                   $teachma->subject = $subject;
                  //var_export($teachma);
                  // exit();
                   if ($teachma->save()) {
                    
                   }else{
                    var_export($teachma->getErrors());
                    exit();
                   }

                }
            }

            //var_export($model);
            //exit();
            return $this->redirect(['index']);
        }

        return $this->render('add', [
            'model' => $model,
            'teachmod'=>$teachmod,
        ]);
    }

    /**
     * Updates an existing TeachManage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeachManage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeachManage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeachManage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeachManage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
