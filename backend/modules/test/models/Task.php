<?php

namespace backend\modules\test\models;

use Yii;
use common\models\UserTeacher;
use backend\modules\test\models\TestPaper;
/**
 * This is the model class for table "test_task".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $feedback
 * @property integer $test
 * @property string $enddate
 * @property string $createdate
 * @property integer $state
 * @property string $creator
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content','enddate', 'createdate', 'creator','state'], 'required'],
            [['content', 'feedback'], 'string'],
            [['test', 'state','creator'], 'integer'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    public function getTeacher()
    {
        return $this->hasOne(UserTeacher::className(),['id'=>'creator']);
    }

    public function getPaper()
    {
         return $this->hasOne(TestPaper::className(),['id'=>'test']);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '任务内容',
            'feedback' => '回答问题',
            'test' => '指定测试',
            'enddate' => '结束时间',
            'createdate' => '创建时间',
            'state' => '任务状态',
            'creator' => '创建人',
        ];
    }
}
