<?php

namespace backend\modules\content\models;

use Yii;
use backend\modules\content\models\ContentMenu;
/**
 * This is the model class for table "content_picturelist".
 *
 * @property string $id
 * @property string $title
 * @property string $note
 * @property integer $cid
 * @property integer $is_collection
 * @property string $kewords
 * @property string $date
 * @property string $author
 * @property string $cover
 */
class Picturelist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_picturelist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cid'], 'required'],
            [['cid', 'is_collection'], 'integer'],
            [['title', 'cover'], 'string', 'max' => 200],
            [['note'], 'string', 'max' => 400],
            [['kewords', 'date', 'author'], 'string', 'max' => 100]
        ];
    }
    
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        $contentMenu = new ContentMenu();
        if (!$insert) {
            $contentMenu = ContentMenu::find()->where(['articleid'=>$this->id])->one();
            if (!$contentMenu) {
               $contentMenu = new ContentMenu(); 
            }
         }
        $contentMenu->getVals($this->cid,$this->id,'picture',$this->title,$this->note,$this->author,$this->date);
        if ($contentMenu->save()) {
            return true;
        }else{
            exit(var_export($contentMenu->getErrors()));
            return false;
        }
        return false;
    }
     public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $contentMenu = ContentMenu::find()->where(['articleid'=>$this->id])->one();
            if ($contentMenu) {
                $contentMenu->delete();
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function getMenuname()
    {
        return $this->hasOne(Infoitem::className(),['itemid'=>'cid']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'note' => '备注',
            'cid' => '菜单',
            'is_collection' => '是否合集',
            'kewords' => '关键词',
            'date' => '上传日期',
            'author' => '作者',
            'cover' => '封面',
        ];
    }
}
