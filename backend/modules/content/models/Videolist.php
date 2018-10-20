<?php

namespace backend\modules\content\models;

use Yii;
use backend\modules\content\models\ContentMenu;
/**
 * This is the model class for table "content_videolist".
 *
 * @property integer $id
 * @property string $title
 * @property string $note
 * @property integer $cid
 * @property integer $iscollection
 * @property string $keywords
 * @property string $date
 * @property string $author
 */
class Videolist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_videolist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cid', 'date', 'author'], 'required'],
            [['cid', 'iscollection'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['note', 'keywords'], 'string', 'max' => 500],
            [['date', 'author'], 'string', 'max' => 100]
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
        $contentMenu->getVals($this->cid,$this->id,'video',$this->title,$this->note,$this->author,$this->date);
        if ($contentMenu->save()) {
            return true;
        }else{
            exit('contentmenu in videolist:'.var_export($contentMenu->getErrors()));
            return false;
        }
        return false;
    }
    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
           // $contentMenu = ContentMenu::findOne(['articleid'=>$this->id])->delete();
            // if ($contentMenu) {
            //     $contentMenu->delete();
            // }
            return ContentMenu::findOne(['articleid'=>$this->id])->delete();
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
            'id' => '编号',
            'title' => '标题',
            'note' => '备注',
            'cid' => '所属菜单',
            'iscollection' => '是否合集',
            'keywords' => '关键词',
            'date' => '创建日期',
            'author' => '作者',
        ];
    }
}
