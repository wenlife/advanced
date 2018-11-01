<?php

namespace backend\modules\testService\controllers;

use Yii;
use backend\modules\testService\models\Taskline;
use backend\modules\testService\models\TasklineSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\testService\forms\uploadExcel;

/**
 * TasklineController implements the CRUD actions for Taskline model.
 */
class TasklineController extends Controller
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
     * Lists all Taskline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TasklineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionImport()
    {
       $model = new uploadExcel();


      if($post=Yii::$app->request->post())
        {
            $model->load($post);
            $model->var2 = 'isnot';
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($url = $model->upload()) {
               if($model->file->extension == 'xlsx'){
                    $objReader = new \PHPExcel_Reader_Excel2007();
                    $objPHPExcel = $objReader->load($url,'utf-8');
                }elseif($model->file->extension == 'xls'){
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

        $conn = Yii::$app->db->beginTransaction();
        $i=2;
        $linemodel = new Taskline();
        foreach ($tableData as $key => $classline) { 
            //如果系统存在数据，则更新
            $checkIfExists = Taskline::find()->where(['grade'=>$model->var1,'banji'=>$classline[0]])->one();
            if ($checkIfExists) {
               $saveModel = $checkIfExists;
            }else{
               $saveModel  = clone $linemodel;
            }
            $saveModel->grade = $model->var1;
            $saveModel->banji = $classline[0];
            $saveModel->line1 = $classline[1];
            $saveModel->line2 = $classline[2];
            $saveModel->line3 = $classline[3];
            $saveModel->line4 = $classline[4];
            
            if(!$saveModel->save())
                { 
                    //(var_export($nscore->stu_id));
                    $conn->rollBack();
                    $model->delFile(); 
                    exit(var_export($saveModel->getErrors()).'第'.$i.'行出现问题');

                }
            $i++;

        }
        $conn->commit();
        $model->delFile(); 
        $this->redirect(['index']);
        //var_export($tableData);
        //exit();
        }



        return $this->render('import',['model'=>$model]);
    }

    /**
     * Displays a single Taskline model.
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
     * Creates a new Taskline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Taskline();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Taskline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Taskline model.
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
     * Finds the Taskline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taskline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Taskline::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
