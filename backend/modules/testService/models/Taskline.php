<?php

namespace backend\modules\testService\models;

use Yii;

/**
 * This is the model class for table "taskline".
 *
 * @property int $id
 * @property string $grade
 * @property string $title
 * @property int $line1
 * @property int $line2
 * @property int $line3
 * @property int $line4
 * @property string $note
 */
class Taskline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'taskline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grade', 'title'], 'required'],
            [['line1', 'line2', 'line3', 'line4'], 'integer'],
            [['grade'], 'string', 'max' => 5],
            [['title'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade' => '班级',
            'title' => '指标',
            'line1' => '重本任务',
            'line2' => '重本目标',
            'line3' => '本科任务',
            'line4' => '本科目标',
            'note' => 'Note',
        ];
    }
}
