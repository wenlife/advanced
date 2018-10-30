<?php

namespace backend\modules\guest\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use  yii\db\Exception;
use backend\modules\school\models\TeachClass;
use PHPExcel;
use backend\modules\guest\forms\UploadOnly;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


 //导入学生需要验证数据
     public function actionImport()
    {
        $model = new UploadOnly();
        $classes = TeachClass::find()->orderby('grade desc,serial')->all();
        //exit(var_export($classes));

        if($post=Yii::$app->request->post())
        {
            $model->load($post);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($url = $model->upload()) {
               
            }

            $objReader = new \PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($url);

            $objWorksheet = $objPHPExcel->getSheet(0);
            $highestRow   = $objWorksheet->getHighestRow();//最大行数，为数字
            $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字
            if($highestColumnIndex>100)
            {
                exit('导入数据量超过100，导入不能顺利进行！');
            }
         
            $conn = Yii::$app->db->beginTransaction();
            try{           
                $user = new User();
                for($row = 2;$row<=$highestRow;$row++){
                    $userModel = clone $user;
                    //$student = array();
                    //$row =2;  
                    $studentid = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
                    if (is_null($studentid)) {
                       continue;
                    }
                    $userModel->username = $studentid;
                    $userModel->setPassword($studentid);
                    $userModel->status = 10;
                    $userModel->generateAuthKey();
                    $userModel->name = $objWorksheet->getCellByColumnAndRow(1,$row)->getValue();
                    $userModel->gender = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue();
                    $userModel->class = $model->class;
                    $userModel->type = 1;
                    //var_export($userModel);
                    //var_export($userModel->getErrors());
                    if (!$userModel->save()) {
                        throw new Exception('insert error'); 
                        //exit(var_export($userModel->getErros()));
                        }
                    }
                //exit(var_export($students));
                $conn->commit();
            }catch(excetion $e){
                $conn->rollback();
                exit(var_export($e));
            }
            return $this->redirect(['index']);  
        }
        return $this->render('import',['model'=>$model,'class'=>$classes]);
    }


    public function actionImport1()
    {

        $model = new UploadOnly();
        $classes = UserBanji::find()->orderby('serial')->all();
        //exit(var_export($classes));

        if($post=Yii::$app->request->post())
        {
            //exit(var_export($post));
            $model->load($post);
            //exit($model->class);
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($url = $model->upload()) {
               
            }

            $objReader = new \PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($url);

            $objWorksheet = $objPHPExcel->getSheet(0);
            $highestRow = $objWorksheet->getHighestRow();//最大行数，为数字
            $highestColumn = $objWorksheet->getHighestColumn();//最大列数 为字母
            $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); //将字母变为数字

            
           
            $tableData = [];
           //  for($row = 2;$row<=$highestRow;$row++){
           //      for($col=0;$col< $highestColumnIndex;$col++){
           //          $tableData[$row][$col] = $objWorksheet->getCellByColumnAndRow($col,$row)->getValue();
           //      }
           //  }
           //  exit(var_dump($tableData));
           //  echo  $highestRow;
           // exit($highestRow);
            $conn = Yii::$app->db->beginTransaction();
            try{           
              // $students= array();
                $user = new User();
                for($row = 2;$row<=$highestRow;$row++){
                    $userModel = clone $user;
                    //$student = array();
                    //$row =2;  
                    $studentid = $objWorksheet->getCellByColumnAndRow(0,$row)->getValue();
                    $userModel->username = $studentid;
                    $userModel->setPassword($studentid);
                    $userModel->status = 10;
                    $userModel->generateAuthKey();
                    $userModel->name = $objWorksheet->getCellByColumnAndRow(1,$row)->getValue();
                    $userModel->gender = $objWorksheet->getCellByColumnAndRow(2,$row)->getValue()=='男'?1:2;
                    $userModel->class = $model->class;
                    $userModel->type = 1;
                    //var_export($userModel);
                    //var_export($userModel->getErrors());
                    //$student = [$userModel->username,$userModel->password_hash,$userModel->status,$userModel->name,$userModel->gender,$userModel->class,$userModel->type];
                    //$students[] = $student;
                    if (!$userModel->save()) {
                        throw new Exception('insert error'); 
                        //exit(var_export($userModel->getErros()));
                    }
                }
                //exit(var_export($students));
                $conn->commit();
            }catch(excetion $e){
                $conn->rollback();
                exit(var_export($e));
            }
            return $this->redirect(['index']);
            
        }
        return $this->render('import',['model'=>$model,'class'=>$classes]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
