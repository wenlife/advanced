<?php
namespace backend\modules\test\controllers;

use Yii;
use backend\modules\test\models\TestItem;
use backend\modules\test\models\TestChapter;
use backend\modules\test\libary\ItemExchange;

use backend\modules\test\models\TestitemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ItemController extends \yii\web\Controller
{

    //使用其他模板
    //public $layout="/center.php";
    
    public function actions()
    {
        return[
            'Kupload'=>['class'=>'pjkui\kindeditor\KindEditorAction',],
            'upload' => ['class' => 'kucha\ueditor\UEditorAction',],

        ];
    }

    public function actionIndex()
    {
        $testItem = new TestItem();
        $items = $testItem->findAllItem();
        $chapterModel = new TestChapter();
        $chapter = $chapterModel->getAllChapter();
         $searchModel = new TestitemSearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'model'=>$items,
            'typeName'=>ItemExchange::typeNames(),
            'chapter'=>$chapter,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);

    }

    public function actionCreate($type)
    {    
        $db_model = new TestItem();
        $itemExchange = new ItemExchange($db_model,$type);
        $fm_model = $itemExchange->getForm();      
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $db_model->attributes = $fm_model->postModel($post);
            $db_model->type = $type;
            $db_model->date = date("Y-m-d");
            $id = $db_model->save();
            $this->redirect(['view','id'=>$db_model->id]);
        }
      
        return $this->render('create',['model'=>$fm_model,'view'=>$fm_model->getViewName(),'type'=>$type]);
    }


    public function actionUpdate($id)
    {
        $db_model = TestItem::findItem($id);
        $itemExchange = new ItemExchange($db_model);
        //$itemExchange->fillForm($db_model);
        $fm_model = $itemExchange->getForm();
        $fm_model->fillForm($db_model);

        if(Yii::$app->request->post())
        {
            $post = Yii::$app->request->post();
            $db_model->attributes = $fm_model->postModel($post);
            $db_model->save();
            $this->redirect(['view','id'=>$db_model->id]);
        }
        return $this->render('update',['model'=>$fm_model,'view'=>$fm_model->getViewName()]);
    }


    public function actionView($id)
    {
        $db_model = TestItem::findItem($id);
       // exit(var_export($db_model));
        $itemExchange = new ItemExchange($db_model);
        $itemExchange->fillForm();
        $fm_model = $itemExchange->getForm();
       // exit(var_export($fm_model->answer));
        return $this->render('view',['model'=>$fm_model,'view'=>$fm_model->getViewName()]);
    }

    public function actionAddsub($id,$type)
    {
        $db_model = new TestItem();
        $main = TestItem::findItem($id);
        $itemExchange = new ItemExchange($db_model,$type);
        $fm_model = $itemExchange->getForm();      
        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $db_model->attributes = $fm_model->postModel($post);
            $db_model->alone = $id; //!------------
            $db_model->type = $type;
            $db_model->date = date("Y-m-d");
            if($db_model->save())
            {
                $mainOptions = unserialize($main->options);
                if (!is_array($mainOptions)) {
                   $mainOptions = array();
                }
                //array_unshift($mainOptions, $db_model->id);
                $mainOptions[] = $db_model->id;
                $main->options = serialize($mainOptions);
                $main->answer = null;
                $main->save();
            }
            $this->redirect(['view','id'=>$id]);
        }
      
        return $this->render('addsub',['model'=>$fm_model,'view'=>$fm_model->getViewName(),'type'=>$type]);
    }



    public function actionItemlist()
    {
        $testItem = new TestItem();
        $type=null;
        $chapter=null;
        if(Yii::$app->request->post())
            {
                $post = Yii::$app->request->post();
                $arr = [];
                if ($type = $post['type']) {
                   $arr['type'] = $type;
                }
                if ($chapter = $post['chapter']) {
                   $arr['chapter'] = $chapter;
                }
                $arr['alone'] = 0;
                $items = $testItem->find()->where($arr)->all();
            }else{
                $items = $testItem->findAllItem();
            }
        
        $chapterModel = new TestChapter();
        $chapters = $chapterModel->getAllChapter();      
        return $this->render('itemlist',['type'=>$type,'chapter'=>$chapter,'model'=>$items,'chapters'=>$chapters,'typeName'=>ItemExchange::typeNames(),]);
    }


    public function actionSetcookie($cookie)
    {
        //Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(is_string($cookie))
        {
            $temCookies = array();
            $pare = explode(':',$cookie);
            $getCookies = Yii::$app->request->cookies;
            $oldCookies = $getCookies->get('items');
            if ($oldCookies) {
                $oldCookies = (array)$oldCookies;
                $items = $oldCookies['value'];
                if (array_key_exists($pare[0],$items)) {
                    array_unshift($items[$pare[0]], $pare[1]);
                }else{
                    $items[$pare[0]] = [$pare[1]];
                }

            }else{

                $items[$pare[0]] = [$pare[1]];
                //$temCookies[] = $pare[1];
            }
            
             $setCookies = Yii::$app->response->cookies;
             $setCookies->add(new \yii\web\Cookie(['name'=>'items','value'=>$items,'expire'=>time()+3600]));

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $items;//[$pare[0],count($items[$pare[0]])];
            //return ['1'=>['0'=>'11','1'=>'12','2'=>'13'],'2'=>['21','22','23'],'3'=>['31','32','33']];
           // return ['name'=>'xxx','value'=>'1212'];
        }


    }

    public function actionResetcookie()
    {
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('items');
        $this->redirect(['itemlist']);
    }

    public function actionPreview()
    {
        
    }

    /** 
    * Deletes an existing TestItem model. 
    * If deletion is successful, the browser will be redirected to the 'index' page. 
    * @param integer $id 
    * @return mixed 
    */ 
   public function actionDelete($id) 
   { 
       $this->findModel($id)->delete(); 
       $this->redirect(['index']);
   }

   protected function findModel($id)
    {
        if (($model = TestItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
