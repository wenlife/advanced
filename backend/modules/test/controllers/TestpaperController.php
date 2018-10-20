<?php

namespace backend\modules\test\controllers;

use Yii;
use backend\modules\test\models\Testpaper;
use backend\modules\test\forms\PaperForm;
use backend\modules\test\models\TestpaperSearch;
use backend\modules\test\models\TestScore;

use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestChapter;
use backend\modules\test\libary\ItemExchange;
use common\models\UserTeacher;
use common\models\UserBanji;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestpaperController implements the CRUD actions for Testpaper model.
 */
class TestpaperController extends Controller
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
     * Lists all Testpaper models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestpaperSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Testpaper model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $itemArray = unserialize($model->items);
        $testItem = new TestItem();
        $itemForPaper = array();
        foreach ($itemArray as $typeKey => $itemTypeArray) {
            foreach ($itemTypeArray as $itemKey => $itemid) {
                $item = $testItem->findItem($itemid);
                // $itemExchange = new ItemExchange($item);
                // $itemExchange->fillForm();
                // $fm_model = $itemExchange->getForm();
                $itemForPaper[$typeKey][$itemid] = $item;
            }
        }

        ksort($itemForPaper);

        return $this->render('view', [
            'model' => $model,
            'itemsAllType' => $itemForPaper
        ]);
    }

    /**
    *
    **/
    public function actionExam($id)
    {
        $testItem = new TestItem();
        $model = $this->findModel($id);

        //===========================================
        //如果该用户已经做过回答，则直接跳转到结果界面

        if(Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            $score = unserialize($model->score);
            //exit(var_export($score));
            //检查答案，计算总分
            $zongfen = 0;
            foreach ($post as $itemid => $answer) {
               $zongfen += $testItem->checkAnswer($itemid,$answer,$score);
            }

            $testScore = new TestScore();
            $testScore->userid = Yii::$app->user->identity->username;
            $testScore->testid = $id;
            $testScore->answer = serialize($post);
            $testScore->score = $zongfen;
            $testScore->date = time();
            if ($testScore->save()) {
                 $this->redirect(['index']);
            }else{
                var_export($testScore->getErrors());
                exit(0);
            }


        }
        
        $itemArray = unserialize($model->items);
        
        $itemForPaper = array();
        foreach ($itemArray as $typeKey => $itemTypeArray) {
            foreach ($itemTypeArray as $itemKey => $itemid) {
                $item = $testItem->findItem($itemid);
                $itemForPaper[$typeKey][$itemid] = $item;
            }
        }
        ksort($itemForPaper);
       return $this->render('exam', [
            'model' => $model,
            'itemsAllType' => $itemForPaper
        ]);
    }


    public function actionScore($testid)
    {
        $model = $this->findModel($testid);
        $itemArray = unserialize($model->items);
        $testItem = new TestItem();
        $itemForPaper = array();
        foreach ($itemArray as $typeKey => $itemTypeArray) {
            foreach ($itemTypeArray as $itemKey => $itemid) {
                $item = $testItem->findItem($itemid);
                $itemExchange = new ItemExchange($item);
                $itemExchange->fillForm();
                $fm_model = $itemExchange->getForm();
                $itemForPaper[$typeKey][$itemid] = $fm_model;
            }
        }

        ksort($itemForPaper);
        ///////////////////////////////////////////////////////
        $username = Yii::$app->user->identity->username;
        $teacher = UserTeacher::find()->where(['username'=>$username])->one();
        if ($teacher) {
            $id = $teacher->id;
            $subject = $teacher->subject;
            if (!$subject) {
                exit('管理员还未设置您的任教科目！');
            }
        }else{
            exit('未发现教师信息!');
        }
        $classes = UserBanji::find()->where([$subject=>$id])->orderby('grade desc')->all();
        //exit(var_export($classes));
        if (!$classes) {
            exit('您不任教任何班级！');
        }
        $classModel = $classes[0];
        //var_export($classModel);
        //exit($class);
        $class = $classModel->id;
        if(Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            $class = $post['class'];
        }
        $students = User::find()->where(['class'=>$class])->all();
        //var_export($students);
        //exit();\
        $scores = array();
        foreach ($students as $key => $student) {
            $scores[$student->username] = TestScore::find()->where(['testid'=>$testid,'userid'=>$student->username])->max('score');
        }

        return $this->render('score',['students'=>$students,'scores'=>$scores,'classes'=>$classes,'class'=>$class,'itemsAllType'=>$itemForPaper,'test'=>$model]);
    }

    /**
     * Creates a new Testpaper model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $dataModel = new Testpaper();
        $formModel = new PaperForm();

        if ($formModel->load(Yii::$app->request->post())) {
        // 复制值
            $dataModel->title = $formModel->title;
            $dataModel->state = $formModel->state;
            $dataModel->note  = $formModel->note;
        //获取COOKIES中保存的试题数据
            $getCookie = Yii::$app->request->cookies;
            $items = $getCookie->get("items");
            if ($items) {
                $items = (array)$items;
                $items = $items["value"];
            }
            $dataModel->items = serialize($items);
        //讲各类型题目的分值合并，并计算出试卷总分
            $score = array();
            $score[1] = $formModel->singleChoiceScore;
            $score[2] = $formModel->multiChoiceScore;
            $score[3] = $formModel->JuggScore;
            $score[4] = $formModel->MmoChoiceScore;
            $score['sum'] =0;

            for ($i=1; $i <=4 ; $i++) {
                if (array_key_exists($i,$items)) {
                     $score['sum'] += $score[$i]*count($items[$i]);
                }
            }
            $dataModel->score = serialize($score);

            //创建信息赋值   
            $dataModel->publisher = Yii::$app->user->identity->username;
            $dataModel->createdate = time();

            if ($dataModel->save()) {
                $cookies = Yii::$app->response->cookies;
                $cookies->remove('items');
                $this->redirect(['index']);
            }else{
                var_export($dataModel->getErrors());

                foreach ($dataModel as $key => $value) {
                    echo "<P>".$key."----".$value."</p>";
                }    

            }

        } else {
            return $this->render('create', [
                'model' => $formModel,
               // 'data' =>$dataModel,
            ]);
        }
    }

    /**
     * Updates an existing Testpaper model.
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
     * Deletes an existing Testpaper model.
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
     * Finds the Testpaper model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Testpaper the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Testpaper::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
