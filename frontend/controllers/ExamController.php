<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\testService\forms\UploadXml;
use backend\modules\testService\models\Exam;
use backend\modules\testService\models\ScLike;
use backend\modules\testService\models\SclikeSearch;
use backend\modules\testService\models\ScWenke;
use backend\modules\testService\models\ScwenkeSearch;
use yii\web\UploadedFile;
use backend\modules\testService\libary\DataAnalysis;
use backend\modules\testService\libary\DataCollection;
use backend\modules\testService\libary\DataColl;
use backend\modules\testService\libary\DataColw;
use backend\modules\testService\libary\ClassRespond;
use backend\modules\school\models\TeachClass;
use PHPExcel;
use backend\libary\CommonFunction;
class ExamController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$exams = Exam::find()->all();
        return $this->render('index',['exams'=>$exams]);
    }


    public function actionDash($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }

        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $subjectmaxlk = $datalk->getSubjectMax();
        //var_export($datalk->getSubjectMax());
        //exit();
       // $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $subjectmaxwk = $datawk->getSubjectMax();
        //$maxSubject = array_merge($max1,$max2);
        //$avgwkSchool = $datawk->getAvg();
         if (!$scwk||!$sclk) {
           return $this->render('error',['message'=>'您所选的考试成绩还未录入！']);
        }

        $lksearchModel = new SclikeSearch();
        $lkdataProvider = $lksearchModel->search(Yii::$app->request->queryParams,$school,$exam);
        $wksearchModel = new ScwenkeSearch();
        $wkdataProvider = $wksearchModel->search(Yii::$app->request->queryParams,$school,$exam);

        return $this->render('dash', [
            'exam'=>$test,
            'school'=>$school,
            'sclk'=>$sclk,
            'scwk'=>$scwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'lksearchModel'  => $lksearchModel,
            'lkdataProvider' => $lkdataProvider,
            'wksearchModel'  => $wksearchModel,
            'wkdataProvider' => $wkdataProvider,
            'subjectmaxlk'=>$subjectmaxlk,
            'subjectmaxwk'=>$subjectmaxwk,
        ]);
    }

    public function actionAvg($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }
        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

        //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
                //文理科班级成绩以及班级分析数据
        // max 最高分  avg 平均分 pass及格率 float进步率
        $scAnal = array();
        foreach ($bjlk as $keyl => $bjl) {
            $datalk->loadData($exam,$school,$bjl);
           // $datalk_compare->loadData($test_compare->id,$school,$bjl);
            $scAnal[$keyl]['max'] = $datalk->getMax();
            $scAnal[$keyl]['avg'] = $datalk->getAvg();
            $scAnal[$keyl]['pass'] = $datalk->getPassed();
          //  $scAnal[$keyl]['float'] = $datalk->avgFloat($avglkSchool,$datalk_compare->getAvg(),$avglkSchool_compare);
        }
       // $avgFloatw = array();//进步率数组
        $scAnaw = array();
        foreach ($bjwk as $keyw => $bjw) {
            $datawk->loadData($exam,$school,$bjw);
        //    $datawk_compare->loadData($test_compare->id,$school,$bjw);
            $scAnaw[$keyw]['max'] = $datawk->getMax();
            $scAnaw[$keyw]['avg'] = $datawk->getAvg();
            $scAnaw[$keyw]['pass'] = $datawk->getPassed();
        //    $scAnaw[$keyw]['float'] = $datawk->avgFloat($avgwkSchool,$datawk_compare->getAvg(),$avgwkSchool_compare);
        }
                //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);


        return $this->render('avg',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'avglkSchool'=>$avglkSchool,
            'avgwkSchool'=>$avgwkSchool,
            'resTeacher'=>$resTeacher,
            'scAnal'=>$scAnal,
            'scAnaw'=>$scAnaw,
        ]);
    }


    public function actionImprove($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }
        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

        //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
          //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);

        //考试对比数组是否存在
        if ($test->compare) {
            $test_compare = Exam::find()->where(['id'=>$test->compare])->one();
            $datalk_compare = new Datacoll();
            $sclk_compare = $datalk_compare->loadData($test_compare->id,$school);
            $avglkSchool_compare = $datalk_compare->getAvg();
            $datawk_compare = new Datacolw();
            $scwk_compare = $datawk_compare->loadData($test_compare->id,$school);
            $avgwkSchool_compare = $datawk_compare->getAvg();
        }

        //文理科班级成绩以及班级分析数据
        // max 最高分  avg 平均分 pass及格率 float进步率
        $scAnal = array();
        foreach ($bjlk as $keyl => $bjl) {
            $datalk->loadData($exam,$school,$bjl);
            $bjdata = $datalk_compare->loadData($test_compare->id,$school,$bjl);
            //上次考试没有数据
            if (empty($bjdata)) {
                $scAnal[$keyl]['float'] = 0;
                continue;
            }

          //  $scAnal[$keyl]['max'] = $datalk->getMax();
            $scAnal[$keyl]['avg'] = $datalk->getAvg();
            $scAnal[$keyl]['avg_last'] = $datalk_compare->getAvg();
          //  $scAnal[$keyl]['pass'] = $datalk->getPassed();
            $scAnal[$keyl]['float'] = $datalk->avgFloat($avglkSchool,$datalk_compare->getAvg(),$avglkSchool_compare);
        }
        $avgFloatw = array();//进步率数组
        $scAnaw = array();
        foreach ($bjwk as $keyw => $bjw) {
            $datawk->loadData($exam,$school,$bjw);
            $bjdata = $datawk_compare->loadData($test_compare->id,$school,$bjw);
             if (empty($bjdata)) {
                $scAnaw[$keyw]['float'] = 0;
                continue;
            }
         //   $scAnaw[$keyw]['max'] = $datawk->getMax();
            $scAnaw[$keyw]['avg'] = $datawk->getAvg();
            $scAnaw[$keyw]['avg_last'] = $datawk_compare->getAvg();
        //  $scAnaw[$keyw]['pass'] = $datawk->getPassed();
            $scAnaw[$keyw]['float'] = $datawk->avgFloat($avgwkSchool,$datawk_compare->getAvg(),$avgwkSchool_compare);
        }


        return $this->render('improve',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'resTeacher'=>$resTeacher,
            'scAnal'=>$scAnal,
            'scAnaw'=>$scAnaw,

        ]);
    }


    public function actionBeyondline($school,$exam)
    {
        $test = Exam::find()->where(['id'=>$exam])->one();
        if (!$exam) {
           return $this->render('error',['message'=>'您选择的考试不存在！']);
        }
        //该次考试 所选学校的文理科成绩信息
        $datalk = new DataColl();
        $sclk = $datalk->loadData($exam,$school);
        $avglkSchool = $datalk->getAvg();
        $datawk = new DataColw();
        $scwk = $datawk->loadData($exam,$school);
        $avgwkSchool = $datawk->getAvg();

                //所选考试和学校的班级文理科班级列表
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
          //任教对应关系读取；
        $resModel = new ClassRespond();
        $resTeacher = $resModel->getTeachers($school,$exam);

        $datalk->loadData($exam,$school,null,'zf desc','grade');
        $datawk->loadData($exam,$school,null,'zf desc','grade');

        $schoolLineStudentListlk = $datalk->getDistinct('stu_id','zf desc','grade');
        $schoolLineStudentListwk = $datawk->getDistinct('stu_id','zf desc','grade');
        $lkzfline = $datalk->getColomnMin('zf');
        $wkzfline = $datawk->getColomnMin('zf');

        $lk_uponline = $datalk->getUponLine($exam,$school,$schoolLineStudentListlk);
        $wk_uponline = $datawk->getUponLine($exam,$school,$schoolLineStudentListwk);


        return $this->render('beyondline',[
            'school'=>$school,
            'exam'=>$test,
            'bjlk'=>$bjlk,
            'bjwk'=>$bjwk,
            'lkuponline'=>$lk_uponline,
            'wkuponline'=>$wk_uponline,
            'wksubjects'=>$datawk->getSubjects(),
            'lksubjects'=>$datalk->getSubjects(),
            'resTeacher'=>$resTeacher,
        ]);


    }

   public function actionBj($school,$exam,$bj=null,$export=0)
    {
        $test = Exam::findOne($exam);
        $compareExam = $test->compare;
        
        $datalk = new DataColl();
        $datawk = new DataColw();
        $sclk = $datalk->loadData($exam,$school);
        $scwk = $datawk->loadData($exam,$school);
        $bjlk = $datalk->getClassList();
        $bjwk = $datawk->getClassList();
        //班级信息处理
        $bjarr1 = array_merge($bjlk,$bjwk);
        sort($bjarr1);
        foreach ($bjarr1 as $key => $value) {
           $bjarr[$value] = $value;
        }
        if ($bj==null) { $bj = current($bjlk);}

        $type = in_array($bj, $bjlk)?'lk':'wk';


        if ($compareExam) {
            $cana = new DataCollection($type);
            $cana->loadData($compareExam,$school);
            $compareArrayCompare = $cana->getScoreList();
            $cana->loadData($compareExam,$school,$bj,'zf desc');
            $rankCompare = $cana->getScoreRank($compareArrayCompare);
        }else{
            $rankCompare = null;
        }

        //年级成绩，返回数组用于显示科目排名
        $ana = new DataCollection($type);
        $ana->loadData($exam,$school,null,'zf desc');

        $compareArray = $ana->getScoreList();
        $scbj = $ana->loadData($exam,$school,$bj,'zf desc');
        $rank = $ana->getScoreRank($compareArray);

        //准备导出数据
        //static function export($title='export',$headerArr=null,Array $data)
        if($export == 1)
        {
            $header = ["编号","考号","姓名","学校","班级"];
            
            $subjects = $ana->getSubjects();
            foreach ($subjects as $key => $subject) {
                $subjectName = CommonFunction::getSubjects()[$subject];
                $header[] = $subjectName."得分";
                $header[] = $subjectName."排名";
                $header[] = $subjectName."升降";
            }

            $data = array();
            $key =1;
            foreach ($scbj as $keys => $sc) {
                $data[$key]['id'] = $key;
                $data[$key]['username'] = $sc->stu_id;
                $data[$key]['name'] = $sc->stu_name;
                $data[$key]['school'] = $sc->stu_school;
               $data[$key]['class'] = $sc->stu_class;
                foreach ($subjects as $keysubject=> $subject) {                  
                    $data[$key][$subject] = $sc->$subject;
                    if (isset($rankCompare[$sc->stu_id][$subject])) {
                        $float = $rankCompare[$sc->stu_id][$subject]-$rank[$sc->stu_id][$subject];
                    }else{
                        $float = 0;
                    }
                $data[$key][$subject.'rank'] = $rank[$sc->stu_id][$subject];
                $data[$key][$subject.'float'] = $float;
                }
                $key++;
            }

          CommonFunction::export('export',$header,$data);
           
        }


        //$this->export('班级成绩',null,$scbj);
        return $this->render('bj',[
            'school'=>$school,
            'exam'=>$test,
            'bj'=>$bj,
            'bjarr'=>$bjarr,
            'type'=>$type,
            'subjects'=>$ana->getSubjects(),
            'scbj'=>$scbj,
            'rank' => $rank,
            'rankCompare'=>$rankCompare,
            'export'=>$export,
        ]);
    }

}
