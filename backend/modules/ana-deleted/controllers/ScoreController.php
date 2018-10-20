<?php

namespace backend\modules\ana\controllers;

use Yii;
use backend\modules\ana\models\AnaScore;
use backend\modules\ana\models\AnascoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\ana\models\AnaExam;
use backend\forms\UploadOnly;
use yii\web\UploadedFile;
/**
 * AnaController implements the CRUD actions for AnaScore model.
 */
class ScoreController extends Controller
{
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
     * Lists all AnaScore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnascoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionImport()
    {
        $model = new UploadOnly();
        $exams = AnaExam::find()->all();


      if($post=Yii::$app->request->post())
        {
            $model->load($post);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($url = $model->upload()) {
               if($model->imageFile->extension == 'xlsx'){
                    $objReader = new \PHPExcel_Reader_Excel2007();
                    $objPHPExcel = $objReader->load($url,'utf-8');
                }elseif($model->imageFile->extension == 'xls'){
                    $objReader = new \PHPExcel_Reader_Excel5();
                    $objPHPExcel = $objReader->load($url,'utf-8');
                }
            }else{
                exit('upload error');
            }
            
            $objWorksheet = $objPHPExcel->getSheet(0);
            $highestRow = $objWorksheet->getHighestRow();//最大行数，为数字
            $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字
            $tableData = [];
            for($row = 2;$row<=$highestRow;$row++){
                for($col=0;$col< $highestColumnIndex;$col++){
                    $tableData[$row][$col] = $objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
                }
            }

            //exit(var_export($tableData));

            //验证

            //导入
            $score = new AnaScore();

            $conn = Yii::$app->db->beginTransaction();
            $i=1;
            foreach ($tableData as $key => $data) {

                $nscore = clone $score;
                $nscore->stu_id = $data[0];
                $nscore->name = $data[1];
                $nscore->exam_id = $model->param;
                $nscore->yw = $data[3];
                $nscore->ds = $data[4];
                $nscore->yy = $data[5];
                $nscore->wl = $data[6];
                $nscore->hx = $data[7];
                $nscore->sw = $data[8];
                $nscore->zz = $data[9];
                $nscore->ls = $data[10];
                $nscore->dl = $data[11];
                //exit(var_export($nscore->stu_id));
                if(!$nscore->save())
                { 
                    //(var_export($nscore->stu_id));

                    exit(var_export($nscore->getErrors()).'第'.$i.'个，姓名：'.$nscore->name);
                }

                $i++;

            }
            $conn->commit();

            $model->delFile();
            //exit(var_export($tableData));
            
            $this->redirect(['index']);
        }


        return $this->render('import',['exams'=>$exams,'model'=>$model]);
    }

    /**
     * Displays a single AnaScore model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnaScore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnaScore();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AnaScore model.
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
     * Deletes an existing AnaScore model.
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
     * Finds the AnaScore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AnaScore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnaScore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
