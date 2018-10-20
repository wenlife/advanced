<?php
namespace backend\models\test;

use Yii;
use yii\base\Model;
use common\models\test\TestChapter;
use common\models\test\TestItem;
use common\libary\Exchange;
use common\libary\ItemExchange;
/**
 * Login form
 */
class MmoForm extends Model implements Exchange
{
 /* @property integer $id
 * @property integer $alone
 * @property string $content
 * @property string $options
 * @property string $answer
 * @property string $note
 * @property integer $chapter
 * @property integer $sum
 * @property integer $wrong
 * @property double $level
 * @property string $source
 * @property string $date
 */
    public $id;
    public $content;
    public $options;
    public $answer;
    public $chapter;
    public $source;
    public $date;
    public $note;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // required
            [['content'], 'required'],
            [['date'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['options', 'note'], 'string', 'max' => 500],
            [['source'], 'string', 'max' => 100]
        ];
    }

    public function getChapter()
    {
          $testChapter = new TestChapter();
          return $testChapter->getAllChapter();
    }

    public function fillForm($model)
    {
        $db_record = $model->toArray();
        $this->Attributes = $db_record;
        $this->id = $db_record['id'];
        if (!is_null($model->answer)) {
            $subitem = $model->answer;//unserialize($model->options);
            foreach ($subitem as $key => $item) {
                $itemExchange = new ItemExchange($item);
                $itemExchange->fillForm();
                $form = $itemExchange->getForm();
                //$form->fillForm($item);
                $subitem[$key] = $form;
               // exit(var_export($form));
            }
            $this->answer = $subitem;
        }
    }

    public function postModel($post)
    {
        $form = $post['MmoForm'];
        $form['answer'] = null;
        return $form;
    }

    public function getViewName()
    {
        return 'mmo';
    }

}
