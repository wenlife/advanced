<?php

namespace backend\modules\testService\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property int $id
 * @property string $title
 * @property string $stu_grade
 * @property int $type
 * @property string $date
 * @property string $note
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc_exam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'stu_grade', 'type', 'date'], 'required'],
            [['type', 'compare'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['stu_grade'], 'string', 'max' => 10],
            [['date'], 'safe'], 
            [['note'], 'string', 'max' => 500],
        ];
    }

    public function getTypename()
    {
        $arr = [1=>'校级',2=>'市级','3'=>'省级'];
        return $arr[$this->type];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
           'id' => '编号',
           'title' => '标题',
           'stu_grade' => '学生年级',
           'date' => '考试日期',
           'type' =>'考试类别',
           'note' => '备注',
           'compare'=>'对比数据'
        ];
    }
}
