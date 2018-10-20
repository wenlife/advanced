<?php

namespace backend\modules\test\controllers;

use Yii;
use backend\modules\test\models\TestScore;
use backend\modules\test\models\TestscoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\modules\test\models\Testpaper;
use backend\modules\test\models\TestItem;

/**
 * ScoreController implements the CRUD actions for TestScore model.
 */
class ScoreController extends Controller
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
     * Lists all TestScore models.
     * @return mixed
     */
    public function actionIndex($testid)
    {
        $searchModel = new TestscoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$testid);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TestScore model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $scoreModel = $this->findModel($id);
        $paper = new Testpaper();
        $papermodel = $paper->findOne($scoreModel->testid);
        $itemArray = unserialize($papermodel->items);
        $testItem = new TestItem();
        $itemForPaper = array();
        foreach ($itemArray as $typeKey => $itemTypeArray) {
            foreach ($itemTypeArray as $itemKey => $itemid) {
                $item = $testItem->findItem($itemid);
                $itemForPaper[$typeKey][$itemid] = $item;
            }
        }

        ksort($itemForPaper);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'papermodel' => $papermodel,
            'itemsAllType' => $itemForPaper,
            'answer' =>$scoreModel->answer,
        ]);
    }

    /**
     * Creates a new TestScore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestScore();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TestScore model.
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
     * Deletes an existing TestScore model.
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
     * Finds the TestScore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestScore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestScore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
