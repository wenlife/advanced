<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $subject
 * @property integer $gender
 * @property string $note
 */
class UserTeacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'subject'], 'required'],
            [['gender'], 'integer'],
            [['name','username','secode'], 'string', 'max' => 50],
            [['subject'], 'string', 'max' => 20],
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
            'name' => '姓名',
            'pinx' => '拼写',
            'subject' => '任教科目',
            'type' => '类型',
            'graduate' => '任教学校',
            'note' => '备注',
        ];
    }
}
