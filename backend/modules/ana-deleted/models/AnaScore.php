<?php

namespace backend\modules\ana\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "ana_score".
 *
 * @property integer $id
 * @property integer $stu_id
 * @property string $name
 * @property integer $exam_id
 * @property double $yw
 * @property double $ds
 * @property double $yy
 * @property double $wl
 * @property double $hx
 * @property double $sw
 * @property double $zz
 * @property double $ls
 * @property double $dl
 */
class AnaScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $sum;

    // function __construct()
    // {
    //     parent::__construct();
    //    $this->sum =  $this->yw+$this->ds+$this->yy+$this->getZHZF();
    // }

    public static function tableName()
    {
        return 'ana_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stu_id', 'exam_id'], 'required'],
            [['exam_id'], 'integer'],
            [['yw', 'ds', 'yy', 'wl', 'hx', 'sw', 'zz', 'ls', 'dl'], 'number'],
            [['name'], 'string', 'max' => 200],
            [['stu_id'], 'string', 'max' => 255]
        ];
    }


    public function getZHZF()
    {
        return $this->wl+$this->sw+$this->hx+$this->zz+$this->ls+$this->dl;
    }


    public function getZF()
    {
       return $this->yw+$this->ds+$this->yy+$this->getZHZF();
    }

    public function getStuinfo()
    {
        return $this->hasOne(User::ClassName(),['username'=>'stu_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stu_id' => 'Stu ID',
            'name' => 'Name',
            'exam_id' => 'Exam ID',
            'yw' => 'Yw',
            'ds' => 'Ds',
            'yy' => 'Yy',
            'wl' => 'Wl',
            'hx' => 'Hx',
            'sw' => 'Sw',
            'zz' => 'Zz',
            'ls' => 'Ls',
            'dl' => 'Dl',
        ];
    }
}
