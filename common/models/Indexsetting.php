<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "indexsetting".
 *
 * @property integer $id
 * @property integer $type
 * @property string $content
 * @property string $note
 */
class Indexsetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'indexsetting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'content'], 'required'],
            [['type'], 'integer'],
            [['content'], 'string'],
            [['note'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'content' => 'Content',
            'note' => 'Note',
        ];
    }
}
