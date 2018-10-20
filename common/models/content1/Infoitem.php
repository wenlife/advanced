<?php

namespace common\models\content;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "content_infoitem".
 *
 * @property integer $itemid
 * @property integer $parentid
 * @property string $itemname
 * @property string $itemdesc
 * @property integer $itemorder
 */
class Infoitem extends \yii\db\ActiveRecord
{
    /**111
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_infoitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'itemname','itemtype', 'itemdesc', 'itemorder'], 'required'],
            [['itemid', 'parentid', 'itemorder'], 'integer'],
            [['itemname'], 'string', 'max' => 100],
            [['itemdesc'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemid' => 'Itemid',
            'parentid' => 'Parentid',
            'itemname' => 'Itemname',
            'itemdesc' => 'Itemdesc',
            'itemorder' => 'Itemorder',
        ];
    }

    public function getParentList()
    {
        return ArrayHelper::map($this->find(['itemid','itemname'])->all(),'itemid','itemname');
    }
}
