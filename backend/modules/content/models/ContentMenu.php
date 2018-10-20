<?php

namespace backend\modules\content\models;

use Yii;

/**
 * This is the model class for table "content_menu".
 *
 * @property integer $id
 * @property integer $menuid
 * @property integer $articleid
 * @property integer $type
 * @property string $title
 * @property string $note
 * @property string $author
 * @property string $publish_date
 */
class ContentMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuid', 'articleid', 'type', 'title', 'author', 'publish_date'], 'required'],
            [['menuid', 'articleid'], 'integer'],
            [['title', 'note'], 'string', 'max' => 200],
            [['author', 'publish_date','type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menuid' => '所属菜单',
            'articleid' => '文章ID',
            'type' => '类型',
            'title' => '标题',
            'note' => '备注',
            'author' => '作者',
            'publish_date' => '发布日期',
        ];
    }

    public function getMenuname()
    {
        return $this->hasOne(Infoitem::className(),['itemid'=>'menuid']);
    }

    public function getVals($menuid,$articleid,$type,$title,$note,$author,$publisdate)
    {
        $this->menuid = $menuid;
        $this->articleid = $articleid;
        $this->type = $type;
        $this->title = $title;
        $this->note =$note;
        $this->author = $author;
        $this->publish_date = $publisdate;
    }
}
