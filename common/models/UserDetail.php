<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_detail".
 *
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $avatar
 * @property string $msg
 * @property string $info
 * @property string $phone
 */
class UserDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'name'], 'required'],
            [['id'], 'integer'],
            [['username', 'avatar'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 50],
            [['msg'], 'string', 'max' => 200],
            [['info'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'msg' => 'Msg',
            'info' => 'Info',
            'phone' => 'Phone',
        ];
    }
}
