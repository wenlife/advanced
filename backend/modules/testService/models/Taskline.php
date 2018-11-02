<?php

namespace backend\modules\testService\models;

use Yii;
use backend\modules\school\models\TeachClass;
/**
 * This is the model class for table "sc_taskline".
 *
 * @property integer $id
 * @property string $grade
 * @property integer $banji
 * @property integer $line1
 * @property integer $line2
 * @property integer $line3
 * @property integer $line4
 * @property string $note
 */
class Taskline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sc_taskline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade', 'banji'], 'required'],
            [['banji', 'line1', 'line2', 'line3', 'line4'], 'integer'],
            [['grade'], 'string', 'max' => 5],
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
            'grade' => '年级',
            'banji' => '班级',
            'line1' => '重本任务',
            'line2' => '重本目标',
            'line3' => '本科任务',
            'line4' => '本科目标',
            'note' => 'Note',
        ];
    }
}
