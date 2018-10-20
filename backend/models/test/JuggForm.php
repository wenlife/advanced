<?php
namespace backend\models\test;

use Yii;
use yii\base\Model;
use common\models\test\TestChapter;
use common\models\test\TestItem;

/**
 * Login form
 */
class JuggForm extends Model
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
            [['content','answer'], 'required'],
            [['date'], 'safe'],
            [['content'], 'string', 'max' => 500],
            [['answer'], 'string', 'max' => 200],
            [['source'], 'string', 'max' => 100]
        ];
    }

    public function getChapter()
    {
          $testChapter = new TestChapter();
          return $testChapter->getAllChapter();
    }

    public function fillForm(TestItem $model)
    {
        $db_record = $model->toArray();
        $this->Attributes = $db_record;
        $this->id = $db_record['id'];
    }

    public function postModel($post)
    {
        $form = $post['JuggForm'];
        return $form;
    }

    public function getViewName()
    {
        return 'jugg';
    }
}
