<?php

namespace common\models\test;

use Yii;

/**
 * This is the model class for table "test_torf".
 *
 * @property integer $id
 * @property integer $alone
 * @property string $content
 * @property integer $answer
 * @property string $note
 * @property integer $chapter
 * @property integer $sum
 * @property integer $wrong
 * @property integer $level
 * @property string $source
 * @property string $date
 */
class TestTorf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_torf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alone', 'answer', 'chapter', 'sum', 'wrong', 'level'], 'integer'],
            [['content', 'answer'], 'required'],
            [['date'], 'safe'],
            [['content'], 'string', 'max' => 300],
            [['note'], 'string', 'max' => 500],
            [['source'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alone' => 'Alone',
            'content' => 'Content',
            'answer' => 'Answer',
            'note' => 'Note',
            'chapter' => 'Chapter',
            'sum' => 'Sum',
            'wrong' => 'Wrong',
            'level' => 'Level',
            'source' => 'Source',
            'date' => 'Date',
        ];
    }
}
