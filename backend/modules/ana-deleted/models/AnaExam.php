<?php

namespace backend\modules\ana\models;

use Yii;

/**
 * This is the model class for table "ana_exam".
 *
 * @property integer $id
 * @property string $grade
 * @property string $title
 * @property integer $level
 * @property integer $compare
 * @property string $date
 * @property string $note
 */
class AnaExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ana_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade', 'title', 'date'], 'required'],
            [['level', 'compare'], 'integer'],
            [['grade'], 'string', 'max' => 10],
            [['title', 'note'], 'string', 'max' => 200],
            [['date'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade' => 'Grade',
            'title' => 'Title',
            'level' => 'Level',
            'compare' => 'Compare',
            'date' => 'Date',
            'note' => 'Note',
        ];
    }


    public function beforeSave($insert)
    {
        if (Parent::beforeSave($insert)) {
            if ($insert) {
                $this->date = date('Y-m-d',time());
            }
            return true;
        }else{
            return false;
        }
        
    }
}
