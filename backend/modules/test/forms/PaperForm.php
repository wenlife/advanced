<?php
namespace backend\modules\test\forms;


use Yii;
use yii\base\Model;

/**
 * Login form
 */
class PaperForm extends Model
{

    public $id;
    public $title;
    public $state;
    public $items;
    public $score;
    public $note;
    public $publisher;
    public $createdate;

    public $singleChoiceScore;
    public $multiChoiceScore;
    public $JuggScore;
    public $MmoChoiceScore;



    /**
     * @inheritdoc
     */
    public function rules()
    {
         return [
            [['title', 'state', 'items', 'score', 'publisher'], 'required'],
            [['singleChoiceScore','multiChoiceScore','JuggScore','MmoChoiceScore','state'], 'integer'],
            [['title', 'publisher'], 'string', 'max' => 100],
            [['items', 'score', 'note'], 'string', 'max' => 500],
            [['createdate'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '试卷标题',
            'state' => '状态',
            'items' => 'Items',
            'score' => 'Score',
            'note' => '备注',
            'publisher' => 'Publisher',
            'createdate' => 'Createdate',
            'singleChoiceScore'=>'单选题',
            'multiChoiceScore'=>'多选题',
            'JuggScore'=>'判断题',
            'MmoChoiceScore'=>'综合题',
        ];
    }


}
