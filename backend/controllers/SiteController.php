<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\BackendLoginForm;
use yii\filters\VerbFilter;
use backend\modules\content\models\Information;
use backend\modules\content\models\ContentMenu;
use backend\modules\content\models\infoitem;
use backend\modules\content\models\Videolist;
use backend\modules\content\models\Video;
use backend\modules\content\models\Picturelist;
use backend\modules\content\models\Picture;
use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestScore;
use backend\modules\test\models\Task;
use backend\models\SignupForm;
use backend\modules\guest\models\UserTeacher;
use common\models\AdminUser;
use common\models\user;
use backend\modules\school\models\TeachClass;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function init()
   {
     if (Yii::$app->user->isGuest) 
      {
        $this->layout = '/simple';

      }
   }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','signup','index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout','list','detail','vdetail','pdetail','center','test','myclass','resetpwd','myinfo'],
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
        ];
    }

    public function actionIndex()
    { 
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['testService/exam/forteacher']);
        }

        
        return $this->render('index');
    }

    public function actionTest()
    {
        $this->layout = 'test';
        return $this->render('test');
    }

    
   public function actionCenter()
    {

        $articles = ContentMenu::find()->count();
        $students = User::find()->count();
        $teachers = UserTeacher::find()->count();
        $classes = TeachClass::find()->count();
        $testItems = TestItem::find()->count();

        $username = Yii::$app->user->identity->username;
        $teacher = UserTeacher::find()->where(['username'=>$username])->one();
 
        return $this->render('center',[
            'articles'=>$articles,
            'students'=>$students,   
            'testItems'=>$testItems,
        ]);
    }


    public function actionMyclass()
    {
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
          $students = User::find()->where(['class'=>$class])->all();

        return $this->render('myclass',['class'=>$class,'classes'=>$classes,'students'=>$students]);

        }else{
            exit('查找您任教的班级失败！');
        }

    }

    public function actionMyinfo()
    {
        return $this->render('myinfo');
    }


    public function actionResetpwd($username)
    {
        $user = User::findByUsername($username);
        if ($user) {
            $user->setPassword($user->username);
            $user->generateAuthKey();
            if($user->save())
            {
                echo "重置用户".$username.'的密码为用户名成功！';
            }

        }
    }

    public function actionList($cate)
    {
        $this->layout = "content";
        $infoItem = new infoitem();
        $item = $infoItem->find()->where(['itemid'=>$cate])->one();

        if(!$item){exit('栏目不存在！');}
    //     'itemType'=>[
    //         0=>"综合",
    //         1=>"文章",
    //         2=>"视频",
    //         3=>"图片",
    //         4=>"轮播",
    // ],
        //exit(var_export($item));

        $Information = new Information();
        $videolist = new Videolist();
        $piclist = new Picturelist();

        if($item->itemtype>0)
        {
            switch ($item->itemtype) {
                case '1':
                    $contents = Information::find()->where(['infoitem'=>$cate])->all();
                    $view = 'list';
                    break;
                case '2':
                    $contents = Videolist::find()->where(['cid'=>$cate])->all();
                    $view = 'videolist';
                    break;
                case '3':
                    $contents = Picturelist::find()->where(['cid'=>$cate])->all();
                    $view = 'piclist';
                    break;

                default:
                    exit('请在list中设置相应类别的页面');
                    break;
            }

            return $this->render($view,['article'=>$contents]);

        }else{

            exit('综合页面还在开发中');

        }

        
    }


    public function actionDetail($id)
    {
        $this->layout = "content";
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
        //$this->layout = false;
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new BackendLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
        $this->layout = 'main-login';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            //exit(var_export($model));
            //如果已经注册
            if(AdminUser::findByUsername($model->username)){
                exit('您已经注册，如果忘记密码，可到信息中心重置！');
            }
            //查找是否有安全码
            $teacherModel = new userTeacher();
            $teacher = $teacherModel->find()->where(['username'=>$model->username])->one();
            if ($teacher!=null&&($teacher->secode == $model->secode)) {
                $model->name = $teacher->name;
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                        }
                }else{
                    exit('注册失败！');
                }
            }else{
                echo "用户名或者安全码不正确！";
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
