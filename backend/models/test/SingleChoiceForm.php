<?php
namespace backend\models\test;

use Yii;
use yii\base\Model;
use common\models\test\TestChapter;
use common\libary\Exchange;

/**
 * Login form
 */
class SingleChoiceForm extends Model implements Exchange
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
    public $optionA;
    public $optionB;
    public $optionC;
    public $optionD;
    public $answer;
    public $note;
    public $chapter;
    public $source;
    public $date;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // required
            [['content', 'optionA','optionB','optionC','optionD','answer'], 'required'],
            [['chapter'], 'integer'],
            [['date'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['options', 'note'], 'string', 'max' => 500],
            [['answer'], 'string', 'max' => 200],
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
        $options = unserialize($db_record['options']);
        $db_record['optionA'] = $options['optionA'];
        $db_record['optionB'] = $options['optionB'];
        $db_record['optionC'] = $options['optionC'];
        $db_record['optionD'] = $options['optionD'];      
        $this->Attributes = $db_record;
        $this->id = $db_record['id'];
    }

    public function postModel($post)
    {
       $form = $post['SingleChoiceForm'];
       $form['options'] = serialize(['optionA'=>$form['optionA'],'optionB'=>$form['optionB'],'optionC'=>$form['optionC'],'optionD'=>$form['optionD']]);
       return $form;
    }

    public function getViewName()
    {
        return  "singlechoice";
    }

}
