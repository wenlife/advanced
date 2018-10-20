<?php

namespace common\models\test;

use Yii;

/**
 * This is the model class for table "test_chapter".
 *
 * @property integer $id
 * @property string $name
 * @property string $grade
 * @property string $note
 */
class TestChapter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 300],
            [['grade'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 200]
        ];
    }

    public function getAllChapter()
    {
        return $this->find()->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'grade' => 'Grade',
            'note' => 'Note',
        ];
    }
}
