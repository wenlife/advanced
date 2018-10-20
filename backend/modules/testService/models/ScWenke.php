<?php

namespace backend\modules\testService\models;

use Yii;

/**
 * This is the model class for table "sc_wenke".
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
 * @property double $zz
 * @property double $ls
 * @property double $dl
 * @property double $zf
 * @property int $mc
 * @property string $note
 */
class ScWenke extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc_wenke';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'stu_id', 'stu_name', 'stu_class'], 'required'],
            [['yw', 'ds', 'yy', 'zz', 'ls', 'dl', 'zf'], 'number'],
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
            'test_id' => '考试',
            'stu_id' => '学生考号',
            'stu_name' => '学生姓名',
            'stu_class' => '班级',
            'stu_school' => '学校',
            'yw' => '语文',
            'ds' => '数学',
            'yy' => '英语',
            'zz' => '政治',
            'ls' => '历史',
            'dl' => '地理',
            'zf' => '总分',
            'mc' => '名次',
            'note' => '总分',
        ];
    }
}
