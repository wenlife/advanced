<?php
namespace backend\modules\guest\forms;

use yii\base\Model;

/**
 * Signup form
 */
class Teach extends Model
{
    public $grade;
    public $banji;
    public $yy;
    public $ds;
    public $yw;
    public $wl;
    public $hx;
    public $sw;
    public $zz;
    public $ls;
    public $dl;
    public $bzr;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['grade','banji'], 'required'],
            [['yw','ds','yy','wl','hx','sw','zz','dl','ls','bzr'],'string','max'=>100],

        ];
    }

    public function attributeLabels()
    {
        return [
            'grade'=>'年级',
            'banji'=>'班级',
            'yw'=>'语文',
            'ds'=>'数学',
            'yy'=>'英语',
            'wl'=>'物理',
            'hx'=>'化学',
            'sw'=>'生物',
            'zz'=>'政治',
            'ls'=>'历史',
            'dl'=>'地理',
            'bzr'=>'班主任',
        ];
    }

}
