<?php

namespace backend\modules\content\models;

use Yii;

/**
 * This is the model class for table "content_infoitem".
 *
 * @property integer $itemid
 * @property integer $parentid
 * @property string $itemname
 * @property string $itemurl
 * @property integer $itemtype
 * @property string $itemdesc
 * @property integer $itemorder
 */
class Infoitem extends \yii\db\ActiveRecord
{
    /**
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
            [['parentid', 'itemname', 'itemtype', 'itemdesc', 'itemorder'], 'required'],
            [['parentid', 'itemtype', 'itemorder'], 'integer'],
            [['itemname', 'itemurl'], 'string', 'max' => 100],
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
            'itemurl' => 'Itemurl',
            'itemtype' => 'Itemtype',
            'itemdesc' => 'Itemdesc',
            'itemorder' => 'Itemorder',
        ];
    }
}
