<?php

namespace backend\modules\testService\models;

use Yii;
use backend\modules\school\models\TeachClass;
/**
 * This is the model class for table "sc_classmap".
 *
 * @property integer $id
 * @property string $school
 * @property string $grade
 * @property string $excel_class_name
 * @property integer $system_class_id
 * @property string $note
 */
class Classmap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sc_classmap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['school', 'grade', 'excel_class_name', 'system_class_id'], 'required'],
            [['system_class_id'], 'integer'],
            [['school', 'excel_class_name', 'note'], 'string', 'max' => 100],
            [['grade'], 'string', 'max' => 5]
        ];
    }

    public function getSysClass()
    {
       return  $this->hasOne(TeachClass::className(),['id'=>'system_class_id']);
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'school' => 'School',
            'grade' => 'Grade',
            'excel_class_name' => 'Excel Class Name',
            'system_class_id' => 'System Class ID',
            'note' => 'Note',
        ];
    }
}
