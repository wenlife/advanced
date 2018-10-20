<?php

namespace backend\modules\ana\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\ana\models\AnaExam;
use backend\modules\ana\models\AnaScore;
use common\models\User;
use common\models\UserBanji;
use common\models\UserTeacher;
use yii\helpers\ArrayHelper;



class DefaultController extends Controller
{
    public function actionIndex()
    {

 		$exams = AnaExam::find()->all();
        
        if(Yii::$app->request->post())
        	{
        		$post = Yii::$app->request->post();
        		//exit($post['exam']);
        		//执行比对，比对结果一致则直接分析，比对结果不符合则显示不符合的内容
        		return $this->redirect(['compare','exam'=>$post['exam']]);
        		//转到分析页面
        	}

        return $this->render('index',['exam'=>$exams]);
    }


    public function actionCompare($exam)
    {
    	if (!is_numeric($exam)) {
    	   exit('非法参数');
    	}
    	//考试信息
        $allExam = AnaExam::find()->all();
    	$examModel = AnaExam::find()->where(['id'=>$exam])->one();
    	//成绩信息
        $scores = AnaScore::find()->where(['exam_id'=>$exam])->all();
        $arr_score = ArrayHelper::map($scores,'id','stu_id');

        //考试涉及到的班级
        $banjis = UserBanji::find()->where(['grade'=>$examModel->grade])->all();
        $arr_banji = ArrayHelper::map($banjis,'id','serial');
        $str = '(';
        $i=0;
        foreach ($arr_banji as $key => $sbanji) {
        	if ($i==0) {
        		$i++;
        	}else{
        		$str.=',';
        	}
        	$str.=$sbanji;
        }
        $str.=')';
        //查找到对应的学生；
        $stus = Yii::$app->db->createCommand('select id,name,username from user where class in '.$str)->queryAll();
        $arr_stu = ArrayHelper::map($stus,'id','username');

        //在成绩表中但学生无法找到,比较后六位
        foreach ($arr_score as $key => $val1) {
        	$arr_score[$key] = substr($val1,-5);
        }
        foreach ($arr_stu as $key => $val2) {
        	$arr_stu[$key] = substr($val2,-5);
        }
        $ss =array_diff($arr_score,$arr_stu);
        $cantFindUser = array();
        //在学生表中但是没有成绩
        $dd = array_diff($arr_stu,$arr_score);
        $cantFindScore = array();
        //var_export($stus);
        foreach ($scores as $key => $valscore) {
        	//echo substr($valscore['stu_id'],-5);
        	if (in_array(substr($valscore->stu_id,-5), $ss)) {
        		$cantFindUser[$valscore->stu_id] = $valscore->name;
        		//echo '<p>'.$valscore->stu_id.'--'.$valscore->name.'</p>';
        	}
        }

        foreach ($stus as $key => $valstu) {
        	if (in_array(substr($valstu['username'],-5), $dd)) {
        		$cantFindScore[$valstu['username']] = $valstu['name'];
        	}
        }
       // exit(var_export($ss));
   		return $this->render('compare',['cantFindUser'=>$cantFindUser,'cantFindScore'=>$cantFindScore,'exam'=>$exam,'allExam'=>$allExam]);

    }


    public function actionDetox($exam,$line=200)
    {
        
        //查询考试涉及到的班级
        $examModel = AnaExam::find()->where(['id'=>$exam])->one();
        $banjis    = UserBanji::find()->where(['grade'=>$examModel->grade])->orderby('serial')->all();
        //$inBanji   = ArrayHelper::map($banjis,'id','serial');
        //教师信息数组
        $teachers  = UserTeacher::find()->all();
        $teacherArray = ArrayHelper::map($teachers,'id','name');
        //获取本次考试全部成绩用于排序处理
        $scores    = AnaScore::find()->where(['exam_id'=>$exam])->all();
        //$scoreArrayForCompare = array()
        //年级分数数组
        foreach ($scores as $k => $kscore) {
            $yw[] = $kscore->yw; $ds[] = $kscore->ds; $yy[] = $kscore->yy;
            $wl[] = $kscore->wl; $hx[] = $kscore->hx; $sw[] = $kscore->sw;
            $zz[] = $kscore->zz; $ls[] = $kscore->ls; $dl[] = $kscore->dl;
            $zf[] = $kscore->zf;
        }
        rsort($yw);rsort($ds);rsort($yy);
        rsort($wl);rsort($hx);rsort($sw);
        rsort($zz);rsort($dl);rsort($ls);
        rsort($zf);

        $subjectArray = array('yw','ds','yy','wl','hx','sw','zz','ls','dl');
        //$transSubject = ['yw'=>'yuwen','ds'=>'shuxue','yy'=>'yingyu','wl'=>'wuli','hx'=>'huaxue','sw','zz','ls','dl']
        //各班平均分
        // $classAverage[1]['yw'] = ['teacher'=>'xuzhichang','max'=>'100','avg'=>'92.111'];
        $classAverage = array();
        foreach($banjis as $key=>$banji)
        {

            $allscore = AnaScore::find()
                        ->where(['and','class='.$banji->serial,'exam_id'=>$exam])
                        ->leftjoin('user as u','u.username=stu_id')
                        ->all();

            $classAverage[$banji->serial]['zf']['teacher'] = $teacherArray[$banji->monitor];
            // $allscore = $cond->all();
            $zongfen = array();
            foreach ($allscore as $key => $score) {
               $zongfen[] = $score->zf;
            }
            //rsort($zongfen);
            //exit(count($zongfen).var_export($zongfen));
            $classAverage[$banji->serial]['zf']['max'] = max($zongfen);                                    
            $classAverage[$banji->serial]['zf']['avg'] = round(array_sum($zongfen)/count($zongfen));
            
            foreach ($subjectArray as $key => $subject) {
                
                $classAverage[$banji->serial][$subject]['teacher'] = array_key_exists($banji->$subject,$teacherArray)?$teacherArray[$banji->$subject]:$banji->$subject;
                $cond = AnaScore::find()
                        ->where(['and',$subject.'>0','class='.$banji->serial,'exam_id'=>$exam])
                        ->leftjoin('user as u','u.username=stu_id');


                $classAverage[$banji->serial][$subject]['max'] = $cond->max($subject);
                $classAverage[$banji->serial][$subject]['avg'] = $cond->average($subject);
                //达标统计
                $subArr = $$subject;//科目名
                $cond2 = AnaScore::find()
                        ->where(['and',$subject.'>'.$subArr[$line-1],'class='.$banji->serial,'exam_id'=>$exam])
                        ->leftjoin('user as u','u.username=stu_id');

                $classAverage[$banji->serial][$subject]['online'] = $cond2->count();
                $allStu = $cond2->all();
                $safe = 0;
                foreach ($allStu as $key => $valstu) {
                    if($valstu->zf>$zf[$line-1]){
                        $safe++;
                    }
                }
                $classAverage[$banji->serial][$subject]['safe'] = $safe;
            //$classAverage[$banji->serial]['yw']['avg'] = AnaScore::find()->where(['and','yw>0','class='.$banji->serial])->max('yw');
             # code...
            }
        }
        //exit(var_export($classAverage));
        //exit(var_export($classAverage[$banji->serial]['yw']['max']));
        //exit(var_export($inBanji));
        return $this->render('detox',['classAvg'=>$classAverage,'subjectArray'=>$subjectArray,'banjis'=>$banjis]);
    }

    public function actionBanji($exam,$class=1)
    {
        if (Yii::$app->request->post()) {
            $class = Yii::$app->request->post()['class'];   
        }

        $examModel  = AnaExam::find()->where(['id'=>$exam])->one();
        $classModel = UserBanji::find()->where(['serial'=>$class])->one();
        //本次考试所有成绩
        $scores = AnaScore::find()->where(['exam_id'=>$exam])->all();
        //$arr_score = ArrayHelper::map($scores,'id','stu_id');

        //考试涉及到的班级和同类型班级
        $allBanjis = UserBanji::find()->where(['grade'=>$examModel->grade])->orderby('serial')->all();
        $banjis    = UserBanji::find()->where(['type'=>$classModel->type])->orderby('serial')->all();
        $inBanji   = ArrayHelper::map($banjis,'id','serial');
        //生成年级成绩数组用于比较
        foreach ($scores as $key => $value) {
            //选择属于该类别班级的学生的总分用于排序
            if (in_array($value->stuinfo->class,$inBanji)) {$viewScore[$value->stu_id] = $value->ZF;}
        }
        arsort($viewScore);//排序，利用成绩
        foreach ($scores as $key => $value) {
            //将每个学生的总分变更为学生信息
            if (in_array($value->stuinfo->class,$inBanji)) {$viewScore[$value->stu_id] = $value;}
        }
        $scoreForCompare = $this->compare($viewScore);//生成年级成绩排序数组
        foreach ($viewScore as $key => $value) {
            if ($value->stuinfo->class==$class) {$classScore[$value->stu_id] = $value;}//获取该班级成绩数据
        }
        //所有科目排序
        $subjectArray = array('yw','ds','yy','wl','hx','sw','zz','ls','dl','zf');
        if ($examModel->compare) {
           $scorePrev = AnaScore::find()->where(['exam_id'=>$examModel->compare])->all();  
           foreach ($scorePrev as $k2 => $val2) {
                if (in_array($val2->stuinfo->class,$inBanji)){$viewScorePrev[$val2->stu_id] = $val2;}   
            }
            $scoreForComparePrev = $this->compare($viewScorePrev);
        }
        //对每个同学生成名次升降数组  
        $zfArray = array();//同时获取总分数组用于求得综合和总分平均分 
        foreach ($classScore as $ks => $stuVal) {
            foreach ($subjectArray as $kj => $subject) {
                 if($stuVal->$subject)
                 {
                    $scoreOrder[$ks][$subject]['N'] = array_search($stuVal->$subject,$scoreForCompare[$subject])+1;
                 }else{
                    $scoreOrder[$ks][$subject]['N'] = '--';
                 }
                 if($examModel->compare&&array_key_exists($ks,$viewScorePrev)&&$viewScorePrev[$ks])
                 {
                    $scoreOrder[$ks][$subject]['P'] = array_search($viewScorePrev[$ks]->$subject,$scoreForComparePrev[$subject])+1;
                 }else{
                    $scoreOrder[$ks][$subject]['P'] = '--';
                 }
                if ($examModel->compare&&$scoreOrder[$ks][$subject]['N']!='--'&&$scoreOrder[$ks][$subject]['P']!='--') {
                    $scoreOrder[$ks][$subject]['C'] = $scoreOrder[$ks][$subject]['P']-$scoreOrder[$ks][$subject]['N'];
                }else{
                    $scoreOrder[$ks][$subject]['C'] = '--';
                }
            }
           $zfArray[] = $stuVal->zf;
           $zhzfArray[] = $stuVal->zhzf;
        }
        //班级平均分
        $avg = array();
        $avg['zf']['avg'] = round(array_sum($zfArray)/count($zfArray),2);
        $avg['zhzf']['avg'] = round(array_sum($zhzfArray)/count($zhzfArray),2);
        $subjectArray2 = array('yw','ds','yy','wl','hx','sw','zz','ls','dl');
        foreach ($subjectArray2 as $key => $subject) {
            $cond = AnaScore::find()
                     ->where(['and',$subject.'>0','class='.$class,'exam_id'=>$exam])
                     ->leftjoin('user as u','u.username=stu_id');
            $cond2 = AnaScore::find()
                     ->where(['and',$subject.'>0','exam_id'=>$exam]);
            $avg[$subject]['avg'] = $cond->average($subject);
            $avg[$subject]['max'] = $cond->max($subject);
            $avg[$subject]['grade'] = $cond2->average($subject);
        }
             

        return $this->render('banji',['banji'=>$allBanjis,'score'=>$classScore,'order'=>$scoreOrder,'class'=>$class,'avg'=>$avg]);
    }


    public function actionGrade($exam,$type=1)
    { 

        $examModel = AnaExam::find()->where(['id'=>$exam])->one();
        if (Yii::$app->request->post()) {
            $type  = Yii::$app->request->post()['type'];
        }
        $classType = ['1'=>'理科','2'=>'文科'];//硬编码，注意更改
        
        $banjis    = UserBanji::find()->where(['type'=>$type])->orderby('serial')->all();
        $inBanji   = ArrayHelper::map($banjis,'id','serial');

        $scores    = AnaScore::find()->where(['exam_id'=>$exam])->all();
        $viewScore = Array();
        
        foreach ($scores as $key => $value) {
            //选择属于该类别班级的学生的总分用于排序
            if (in_array($value->stuinfo->class,$inBanji)) {$viewScore[$value->stu_id] = $value->ZF;}
        }
       
        arsort($viewScore);
        foreach ($scores as $key => $value) {
            //将每个学生的总分变更为学生信息
            if (in_array($value->stuinfo->class,$inBanji)) {$viewScore[$value->stu_id] = $value;}
        }
        //文理科总分前20
        $scoreForCompare = $this->compare($viewScore);
        $subjectArray = array('yw','ds','yy','wl','hx','sw','zz','ls','dl','zf');
        //是否存在对比考试
        $viewScorePrev = array();
        $scoreOrder = array();
        $scoreForComparePrev = array();

        if ($examModel->compare) {
           $scorePrev = AnaScore::find()->where(['exam_id'=>$examModel->compare])->all();  
           foreach ($scorePrev as $k2 => $val2) {
                if (in_array($val2->stuinfo->class,$inBanji)){$viewScorePrev[$val2->stu_id] = $val2;}   
            }
            $scoreForComparePrev = $this->compare($viewScorePrev);
        }
            
        foreach ($viewScore as $ks => $stuVal) {
            foreach ($subjectArray as $kj => $subject) {
                 if($stuVal->$subject)
                 {
                    $scoreOrder[$ks][$subject]['N'] = array_search($stuVal->$subject,$scoreForCompare[$subject])+1;
                 }else{
                    $scoreOrder[$ks][$subject]['N'] = '--';
                 }
                 if($examModel->compare&&array_key_exists($ks,$viewScorePrev)&&$viewScorePrev[$ks])
                 {
                   // exit('chazhao dao');
                    $scoreOrder[$ks][$subject]['P'] = array_search($viewScorePrev[$ks]->$subject,$scoreForComparePrev[$subject])+1;
                 }else{
                    $scoreOrder[$ks][$subject]['P'] = '--';
                 }
                if ($examModel->compare&&$scoreOrder[$ks][$subject]['N']!='--'&&$scoreOrder[$ks][$subject]['P']!='--') {
                    $scoreOrder[$ks][$subject]['C'] = $scoreOrder[$ks][$subject]['P']-$scoreOrder[$ks][$subject]['N'];
                }else{
                    $scoreOrder[$ks][$subject]['C'] = '--';
                }
            }
        }

        return $this->render('grade',[
            'preScore'=>$viewScorePrev,
            'score'=>$viewScore,
            'scoreOrder'=>$scoreOrder,
            'preCompare'=>$scoreForComparePrev,
            'compare'=>$scoreForCompare,
            'classType'=>$classType,
            'type'=>$type,
            'subjectArray'=>$subjectArray]);


   }



    public function compare($viewScore)
    {
        foreach ($viewScore as $k => $kscore) {
            $yw[] = $kscore->yw; $ds[] = $kscore->ds; $yy[] = $kscore->yy;
            $wl[] = $kscore->wl; $hx[] = $kscore->hx; $sw[] = $kscore->sw;
            $zz[] = $kscore->zz; $ls[] = $kscore->ls; $dl[] = $kscore->dl;
            $zf[] = $kscore->zf;
        }
        rsort($yw);rsort($ds);rsort($yy);
        rsort($wl);rsort($hx);rsort($sw);
        rsort($zz);rsort($dl);rsort($ls);
        rsort($zf);
        $scoreForCompare = array();
        $scoreForCompare['yw'] = $yw;
        $scoreForCompare['ds'] = $ds;
        $scoreForCompare['yy'] = $yy;
        $scoreForCompare['wl'] = $wl;
        $scoreForCompare['hx'] = $hx;
        $scoreForCompare['sw'] = $sw;
        $scoreForCompare['zz'] = $zz;
        $scoreForCompare['dl'] = $dl;
        $scoreForCompare['ls'] = $ls;
        $scoreForCompare['zf'] = $zf;

        return $scoreForCompare;
    }





}
