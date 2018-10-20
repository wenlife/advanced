<?php

namespace backend\modules\testService\models;

use Yii;

/**
 * This is the model class for table "sc_like".
 *
 * @property int $id
 * @property string $test_id
 * @property string $stu_id
 * @property string $stu_name
 * @property string $stu_class
 * @property string $stu_school
 * @property double $yw
 * @property double $ds
 * @property double $yy
 * @property double $wl
 * @property double $hx
 * @property double $sw
 * @property double $zf
 * @property int $mc
 * @property string $note
 */
class ScLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'stu_id', 'stu_name', 'stu_class'], 'required'],
            [['yw', 'ds', 'yy', 'wl', 'hx', 'sw', 'zf'], 'number'],
            [['mc'], 'integer'],
            [['test_id', 'stu_id', 'stu_class'], 'string', 'max' => 20],
            [['stu_name', 'stu_school'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => '考试编号',
            'stu_id' => '考号',
            'stu_name' => '姓名',
            'stu_class' => '班级',
            'stu_school' => '学校',
            'yw' => '语文',
            'ds' => '数学',
            'yy' => '英语',
            'wl' => '物理',
            'hx' => '化学',
            'sw' => '生物',
            'zf' => '总分',
            'mc' => '名次',
            'note' => 'Note',
        ];
    }
}
