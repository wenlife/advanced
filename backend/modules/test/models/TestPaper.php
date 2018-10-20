<?php

namespace backend\modules\test\models;

use Yii;

/**
 * This is the model class for table "test_paper".
 *
 * @property integer $id
 * @property string $title
 * @property integer $state
 * @property string $items
 * @property string $score
 * @property string $note
 * @property string $publisher
 * @property string $createdate
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
            [['title', 'state', 'items', 'score', 'publisher','createdate'], 'required'],
            [['state','createdate'], 'integer'],
            [['title', 'publisher'], 'string', 'max' => 100],
            [['score', 'note'], 'string', 'max' => 500],
           // [['createdate'], 'string', 'max' => 50]
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
            'state' => 'State',
            'items' => 'Items',
            'score' => 'Score',
            'note' => 'Note',
            'publisher' => 'Publisher',
            'createdate' => 'Createdate',
        ];
    }
}
