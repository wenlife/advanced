<?php
namespace backend\modules\test\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestScore;
use backend\modules\test\models\Task;
use backend\modules\school\models\TeachClass;
use backend\modules\school\models\TeachManage;
use backend\modules\guest\models\UserTeacher;
use common\models\user;


class DefaultController extends Controller
{
    public function actionIndex()
    {

        $classes = TeachClass::find()->count();
        $testItems = TestItem::find()->count();

        $username = Yii::$app->user->identity->username;
        $teacher = UserTeacher::find()->where(['username'=>$username])->one();
        $classes = TeachManage::find()->where(['teacher_id'=>$teacher->id])->orderby('year_id desc')->all();
        $taskNow = Task::find()->where(['creator'=>$teacher->id,'state'=>1])->orderby('createdate desc')->one();
        //exit(var_export($taskNow));
        $classDetail = array();
        foreach ($classes as $key => $class) {
            $classDetail[$class->class_id]['studentCount'] = User::find()->where(['class'=>$class->class_id])->count();
            //练习情况统计
            $allStudent = User::find()->where(['class'=>$class->class_id])->all();
            $submitYet = 0;
            $scoreArray = array();
            if($taskNow){
                foreach ($allStudent as $key => $student) {
                    $score = TestScore::find()->where(['userid'=>$student->username,'testid'=>$taskNow->test])->max('score');
                    if ($score) {
                       $scoreArray[$student->username] = $score;
                    }else{
                        $submitYet++;
                    }
                    # code...
                }
            }
            $classDetail[$class->class_id]['submitYet'] = $submitYet;
            if(count($scoreArray))
            {
                $classDetail[$class->class_id]['avg'] = round(array_sum($scoreArray)/count($scoreArray));
            }else{
                $classDetail[$class->class_id]['avg'] = 0;
            }

        }
        $tasks = Task::find()->where(['creator'=>$teacher->id])->orderby('createdate desc')->all();
        $taskCount = array();
        foreach ($tasks as $key => $task) {
            //任务完成统计
            $taskCount[$task->id] = TestScore::find()->select('userid')->distinct()->where(['testid'=>$task->test])->count();
        }
        //exit(var_export($taskCount));
        

        // $this->layout = "main";
        return $this->render('index',[
            'classes' =>$classes,
            'testItems'=>$testItems,
            'tasks' =>$tasks,
            'taskCount'=>$taskCount,
            'classses'=>$classes,
            'classDetail'=>$classDetail,
        ]);
    }
}
