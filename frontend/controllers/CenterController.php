<?php
namespace frontend\controllers;
use Yii;
use common\models\FrontendLoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\user;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachManage;

use backend\modules\test\models\Task;
use backend\modules\content\models\Information;
use backend\modules\content\models\infoitem;
use backend\modules\content\models\Videolist;
use backend\modules\content\models\Video;
use backend\modules\content\models\Picturelist;
use backend\modules\content\models\Picture;

use backend\modules\test\models\Testpaper;
use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestScore;

use frontend\forms\UploadForm;
use yii\web\UploadedFile;
use backend\modules\test\libary\ItemExchange;

class CenterController extends \yii\web\Controller
{
	public $layout ='center';
    public function actionIndex()
    {

       if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }else{
            $username = Yii::$app->user->identity->username;           
            $user = User::findByUsername($username);
        }
        
        $teacherID = TeachManage::find()->where(['class_id'=>$user->class,'subject'=>'xx'])->one();// $class->xx;

        $taskModel = new Task();
        $task = $taskModel->find()->where(['creator'=>$teacherID,'state'=>1])->orderBy('createdate desc')->one();
        if ($task) {
            $testScoreModel = new TestScore();
            $testScore = $testScoreModel->find()->where(['userid'=>Yii::$app->user->identity->username,'testid'=>$task->test])->all();
            if (empty($testScore)) {
                $ifTestWasDone = false;
            }else{
                $ifTestWasDone = 1;
                foreach ($testScore as $k => $test) {
                    if ($test->score > $ifTestWasDone) {
                        $ifTestWasDone = $test->score;
                    }
                }
            }
        }else{
            $ifTestWasDone=false;
        }
        
        $itemModel = new infoitem();
        $section1 = $itemModel->find()->where(['parentid'=>19])->all();

        return $this->render('index',['task'=>$task,'user'=>$user,'section1'=>$section1,'ifTestWasDone'=>$ifTestWasDone]);

    }

    public function actionAvatar()
    {

        $model= new UploadForm();
        if (Yii::$app->request->Post()) {

           $post = Yii::$app->request->post();
            $file_src = "src.png"; 
            $filename162 = "upload/1.png"; 
            $filename48 = "upload/2.png"; 
            $filename20 = "upload/3.png";   

            $src= base64_decode($_POST['pic']);
            $pic1=base64_decode($_POST['pic1']);   
            $pic2=base64_decode($_POST['pic2']);  
            $pic3=base64_decode($_POST['pic3']);  

            if($src) {
                file_put_contents($file_src,$src);
            }

            file_put_contents($filename162,$pic1);
            file_put_contents($filename48,$pic2);
            file_put_contents($filename20,$pic3);
            return $this->redirect(['index']);

       }
         $username = Yii::$app->user->identity->username;
        //Session_start();       //使用SESSION前必须调用该函数。
        $_SESSION['uid'] = $username;
         return $this->render('avatar',['username'=>$username]);
        // return 'resss';
    }


    public function  actionLearn()
    {
    	return $this->render('learn');
    }

    public function actionReview($scoreid)
    {
        $score = TestScore::find()->where(['id'=>$scoreid])->one();
        $id = $score->testid;
        //$model = $this->findModel($id);
        $model = Testpaper::findOne($id);
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
        
        //exit(var_export(unserialize($score->answer)));
        $myAnswer = unserialize($score->answer);

        //查找得分
        return $this->render('review',[
            'model'=>$model,
            'itemsAllType' => $itemForPaper,
            'myAnswer' => $myAnswer,
            'score'=>$score,
        ]);
    }


    public function actionTest($id)
    {
        $testItem = new TestItem();
        $testPaper = new Testpaper();
        $model = $testPaper->findOne($id);

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


            $username = Yii::$app->user->identity->username;
            $ifHasTested = TestScore::find()->where(['userid'=>$username,'testid'=>$id])->max('score');
            if ($ifHasTested) {
               if ($zongfen>$ifHasTested) {
                  $testScore = TestScore::find()->where(['userid'=>$username,'testid'=>$id])->one();
                   $testScore->answer = serialize($post);
                   $testScore->score = $zongfen;
                   $testScore->date = time();
               }else{
                  Yii::$app->getSession()->setFlash('warning','得分小于上次测试，此次结果不作保存！');
                  return $this->redirect(['/center']);
               }
            }else{
                $testScore = new TestScore();
                $testScore->userid = $username;
                $testScore->testid = $id;
                $testScore->answer = serialize($post);
                $testScore->score = $zongfen;
                $testScore->date = time();
            }



            if ($testScore->save()) {
                Yii::$app->getSession()->setFlash('success','测试提交成功！');
                return $this->redirect(['/center']);
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
       return $this->render('test', [
            'model' => $model,
            'itemsAllType' => $itemForPaper
        ]);
    }

    public function actionScore()
    {
        $testScore = new TestScore();
        $username = Yii::$app->user->identity->username;
        $score = $testScore->find()->where(['userid'=>$username])->all();
        //exit($username);
       // exit(var_export($score));
        return $this->render('score',['score'=>$score]);
    }

    public function actionTask()
    {    
        $user = User::findByUsername(Yii::$app->user->identity->username);
        //$class = TeachClass::find($userStu->class)->one();
        $teacherID = TeachManage::find()->where(['class_id'=>$user->class,'subject'=>'xx'])->one();// $class->xx;
        $tasks = Task::find()->where(['creator'=>$teacherID])->orderBy('state')->all();
         return $this->render('task',['tasks'=>$tasks]);

    }

    public function actionDetail()
    {   
        //$this->layout = false;
        $userStu = User::findByUsername(Yii::$app->user->identity->username);
        $class = TeachClass::find()->where(['id'=>$userStu->class])->one();

        return $this->render('detail',['detail'=>$userStu,'class'=>$class]);
    }

    public function actionTestlist()
    {
        $paperModel = new Testpaper();
        $papers = $paperModel->find()->all();
         
         return $this->render('testlist',['papers'=>$papers]);

    }

}
