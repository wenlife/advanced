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

use backend\modules\content\models\Information;
use backend\modules\content\models\infoitem;
use backend\modules\content\models\Videolist;
use backend\modules\content\models\Video;
use backend\modules\content\models\Picturelist;
use backend\modules\content\models\Picture;
use backend\modules\content\models\ContentMenu;

use backend\modules\test\models\Testpaper;
use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestScore;


use frontend\forms\UploadForm;
use yii\web\UploadedFile;

use common\models\Indexsetting;
use backend\models\IndexForm;
use common\libary\InfomationCoverse;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    //public $layout = 'center';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','avatar','center','test'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex()
    {
     //   return $this->redirect(['login']);
        $indexSettingModel = new Indexsetting();
        $indexSetting = $indexSettingModel->find()->where(['type'=>2])->one();
        if (!$indexSetting) {
            exit('主页栏目还没有设置！');
        }
       // $form = new IndexForm();
        $column = unserialize($indexSetting->content);
        $pictureModel = new Picture();
        $pictures = $pictureModel->find()->where(['infoid'=>$column->oneleft])->all();
        $picture2 = $pictureModel->find()->where(['infoid'=>$column->threeleft])->all();
        $picture3 = $pictureModel->find()->where(['infoid'=>$column->threeright])->all();

        //通知消息
        $notice = $indexSettingModel->find()->where(['type'=>3])->one();

        return $this->render('index',['column'=>$column,'pictures'=>$pictures,'picture2'=>$picture2,'picture3'=>$picture3,'notice'=>$notice->content]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    // public function actionCenter()
    // {

    //     $userStu = User::findByUsername(Yii::$app->user->identity->username);
    //     $class = userBanji::find($userStu->class)->one();
    //     $teacherID = $class->xx;

    //     $taskModel = new Task();
    //     $task = $taskModel->find()->where(['creator'=>$teacherID])->orderBy('createdate desc')->one();
    //     if ($task) {
    //         $testScoreModel = new TestScore();
    //         $testScore = $testScoreModel->find()->where(['userid'=>Yii::$app->user->identity->username,'testid'=>$task->test])->all();
    //         if (empty($testScore)) {
    //             $ifTestWasDone = false;
    //         }else{
    //             $ifTestWasDone = 1;
    //             foreach ($testScore as $k => $test) {
    //                 if ($test->score > $ifTestWasDone) {
    //                     $ifTestWasDone = $test->score;
    //                 }
    //             }
    //         }
    //     }else{
    //         $ifTestWasDone=false;
    //     }
        

    //     //$ifPaperWasDone = 

    //     if(Yii::$app->user->isGuest){
    //         return $this->redirect(['site/login']);
    //     }else{
    //         $username = Yii::$app->user->identity->username;           
    //         $user = User::findByUsername($username);
    //     }

    //     $itemModel = new infoitem();
    //     $section1 = $itemModel->find()->where(['parentid'=>19])->all();

    //     return $this->render('center',['task'=>$task,'user'=>$user,'section1'=>$section1,'ifTestWasDone'=>$ifTestWasDone]);

    // }

    // public function actionTaskdetail()
    // {
    //     exit('testing');
    // }

    public function actionAvatar()
    {

        //$model= new UploadForm();
        if (Yii::$app->request->post()) {
            exit($_POST);
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

            $rs['status'] = 1;

            print json_encode($rs);
        }
        $username = Yii::$app->user->identity->username;
        //Session_start();       //使用SESSION前必须调用该函数。
        $_SESSION['uid'] = $username;
        return $this->render('avatar',['username'=>$username]);
    }

    public function actionGetpic()
    {
        $username = Yii::$app->user->identity->username;
        return $username;
    }

    public function actionList($cate)
    {
        $this->layout = "center";
        $content = new ContentMenu();
        if (is_numeric($cate)) {
            $items = $content->find()->where(['menuid'=>$cate])->all();
        }
        return $this->render('list',['article'=>$items]);      
    }

    public function actionDetail($id)
    {
       // $this->layout = "content";
        return $this->render('detail',['model'=>Information::findOne($id)]);
    }

    public function actionVdetail($id,$vid=null)
    {
        $videoModel = new Video();
        $videos = $videoModel->find()->where(['infoid'=>$id])->orderBy('showorder')->all();

        return $this->render('vdetail', [
            'model' => Videolist::findOne($id),
            'videos'=>$videos,
            'vid'=>$vid,
        ]);
    }

    public function actionPdetail($id)
    {
        $picModel = new Picture();
        $pics = $picModel->find()->where(['infoid'=>$id])->orderBy('showorder')->all();
           return $this->render('pdetail', [
            'model' => Picturelist::findOne($id),
            'pictures'=>$pics,
        ]);
    }



    public function actionLogin()
    {
       // $this->layout = "content";
        if (!\Yii::$app->user->isGuest) {
           // return $this->goHome();
            return $this->redirect(['/center']);
        }

        $model = new FrontendLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            return $this->redirect(['/center']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        exit('暂时不提供注册！');
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
