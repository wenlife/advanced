<?php

namespace backend\modules\school\models;

use Yii;
use backend\modules\testService\models\Taskline;
/**
 * This is the model class for table "teach_class".
 *
 * @property int $id
 * @property string $title
 * @property string $grade
 * @property int $serial 
 * @property string $type
 * @property string $school
 * @property string $note
 */
class TeachClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'grade', 'serial', 'type'], 'required'],
            [['serial'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['grade'], 'string', 'max' => 10],
            [['type'], 'string', 'max' => 50],
            [['school'], 'string', 'max' => 100],
            [['note'], 'string', 'max' => 500],
        ];
    }


    public function getTaskline()
    {
       return  $this->hasOne(Taskline::className(),['grade'=>'grade','banji'=>'serial']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '班级标题',
            'grade' => '年级届次',
            'type' => '类别',
            'school' => '学校',
            'note' => '备注',
        ];
    }
}
