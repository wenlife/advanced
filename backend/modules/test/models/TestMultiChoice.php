<?php

namespace backend\modules\test\models;


use Yii;

/**
 * This is the model class for table "test_multichoice".
 *
 * @property integer $id
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
class TestMultiChoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_multichoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alone', 'chapter', 'sum', 'wrong'], 'integer'],
            [['content', 'options', 'answer'], 'required'],
            [['level'], 'number'],
            [['date'], 'safe'],
            [['content'], 'string', 'max' => 300],
            [['options', 'note'], 'string', 'max' => 500],
            [['answer'], 'string', 'max' => 200],
            [['source'], 'string', 'max' => 100]
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
            'options' => 'Options',
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
