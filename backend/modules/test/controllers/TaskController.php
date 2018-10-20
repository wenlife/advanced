<?php

namespace backend\modules\test\controllers;

use Yii;
use backend\modules\test\models\Task;
use backend\modules\test\models\TaskSearch;
use backend\modules\test\models\TestScore;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UserTeacher;
use common\models\User;
use common\models\UserBanji;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{

    //public $layout = '/center';

    public function actions()
    {
        return[
            'Kupload'=>['class'=>'pjkui\kindeditor\KindEditorAction',]
        ];
    }

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
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            exit('请登陆！');
        }else{
            $username = Yii::$app->user->identity->username;
            $teacher = UserTeacher::find()->where(['username'=>$username])->one();
            $searchModel = new TaskSearch();
            if ($teacher) {
                 $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$teacher->id);
            }else{
                 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            }     
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$class=null)
    {
        $task = $this->findModel($id);
        $username = Yii::$app->user->identity->username;
        $teacher = UserTeacher::find()->where(['username'=>$username])->one();
        $classes = UserBanji::find()->where([$teacher->subject=>$teacher->id])->orderby('grade desc')->all();
        $students = array();
        $class='';
        if ($classes) {
            if ($post=Yii::$app->request->post()) {
             $class = $post['class'];
            }else{
            $class = $classes[0]->id;
            }
            $students = User::find()->where(['class'=>$class])->orderby('name')->all();
            $scores = array();
            foreach ($students as $key => $student) {
                $myscore = TestScore::find()->where(['userid'=>$student->username,'testid'=>$task->test])->max('score');
               //exit(var_export($myscore));
                if ($myscore) {
                   $scores[$student->username] = $myscore;
                }else{
                   $scores[$student->username] = 0;
                }
            }
            //exit(var_export($students));


        }else{
            exit('查找您任教的班级失败！');
        }


        return $this->render('view', [
            'model' => $task,
            'students' =>$students,
            'scores' => $scores,
            'classes'=>$classes,
            'class'=>$class
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        $teacherModel = new UserTeacher();


        if ($model->load(Yii::$app->request->post())) {
          
           $username = Yii::$app->user->identity->username;

           $teacher = UserTeacher::find()->where(['username'=>$username])->one();

           if (!$teacher) {
               exit('您还未由管理员分配帐户名，当前登陆无效！');
           }


           $model->creator = $teacher->id;

           $model->createdate = time();

           if (!$model->save()) {
              exit(var_export($model->getErrors()));
           }
           
           return $this->redirect(['index']);
           
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
