<?php

namespace backend\modules\school\models;

use Yii;

/**
 * This is the model class for table "user_banji".
 *
 * @property integer $id
 * @property string $grade
 * @property integer $serial
 * @property string $title
 * @property integer $type
 * @property string $monitor
 * @property string $yw
 * @property string $ds
 * @property string $yy
 * @property string $zz
 * @property string $ls
 * @property string $dl
 * @property string $wl
 * @property string $hx
 * @property string $sw
 * @property string $xx
 * @property string $note
 */
class UserBanji extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_banji';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade', 'serial', 'title', 'type', 'monitor'], 'required'],
            [['serial', 'type'], 'integer'],
            [['grade'], 'string', 'max' => 5],
            [['title', 'note'], 'string', 'max' => 200],
            [['monitor', 'yw', 'ds', 'yy', 'zz', 'ls', 'dl', 'wl', 'hx', 'sw', 'xx'], 'string', 'max' => 50]
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
            'serial' => 'Serial',
            'title' => 'Title',
            'type' => 'Type',
            'monitor' => 'Monitor',
            'yw' => 'Yw',
            'ds' => 'Ds',
            'yy' => 'Yy',
            'zz' => 'Zz',
            'ls' => 'Ls',
            'dl' => 'Dl',
            'wl' => 'Wl',
            'hx' => 'Hx',
            'sw' => 'Sw',
            'xx' => 'Xx',
            'note' => 'Note',
        ];
    }
}
