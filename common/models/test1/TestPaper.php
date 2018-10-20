<?php

namespace common\models\test;

use Yii;

/**
 * This is the model class for table "test_paper".
 *
 * @property integer $id
 * @property string $title
 * @property string $publisher
 * @property integer $state
 * @property string $items
 * @property string $score
 * @property string $note
 */
class TestPaper extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_paper';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'publisher', 'state', 'items', 'score'], 'required'],
            [['state'], 'integer'],
            [['title', 'publisher'], 'string', 'max' => 100],
            [['items', 'score', 'note'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'publisher' => 'Publisher',
            'state' => 'State',
            'items' => 'Items',
            'score' => 'Score',
            'note' => 'Note',
        ];
    }
}
