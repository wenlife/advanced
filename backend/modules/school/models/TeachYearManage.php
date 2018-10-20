<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "teach_year_manage".
 *
 * @property int $id
 * @property string $title
 * @property string $start_date
 * @property string $end_date
 * @property string $note
 */
class TeachYearManage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teach_year_manage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'start_date', 'end_date'], 'required'],
            [['start_date', 'end_date'], 'safe'],
            [['title'], 'string', 'max' => 200],
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
            'title' => '学年标题',
            'start_date' => '开始日期',
            'end_date' => '结束日期',
            'note' => '备注',
        ];
    }
}
