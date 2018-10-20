<?php

namespace backend\modules\content\models;

use Yii;
use backend\modules\content\models\ContentMenu;

/**
 * This is the model class for table "content_information".
 *
 * @property integer $infoid
 * @property integer $infoitem
 * @property string $headline
 * @property string $subhead
 * @property string $author
 * @property string $publish_date
 * @property string $content
 * @property string $keywords
 * @property string $abstract
 * @property string $ishow
 * @property string $level
 * @property string $releaser
 * @property string $release_date
 * @property string $headcolor
 * @property string $subhcolor
 * @property integer $iscomment
 * @property integer $isdelete
 * @property string $deletedate
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['infoitem', 'headline', 'author', 'publish_date', 'content', 'keywords','level','releaser','release_date'],'required'],
            [['infoitem', 'iscomment', 'isdelete'], 'integer'],
            [['publish_date', 'release_date', 'deletedate'], 'safe'],
            [['content'], 'string'],
            [['headline'], 'string', 'max' => 200],
            [['subhead', 'keywords'], 'string', 'max' => 100],
            [['author', 'releaser'], 'string', 'max' => 40],
            [['abstract'], 'string', 'max' => 500],
            [['ishow', 'level'], 'string', 'max' => 2],
            [['headcolor', 'subhcolor'], 'string', 'max' => 6]
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->abstract = mb_substr(preg_replace('/\s/','',strip_tags($this->content)), 0,100);
            return true;
        }else{
            return false;
        }
    }

    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        $contentMenu = new ContentMenu();
        if (!$insert) {
            $contentMenu = ContentMenu::find()->where(['articleid'=>$this->infoid])->one();
            if (!$contentMenu) {
               $contentMenu = new ContentMenu(); 
            }
         }
        $contentMenu->getVals($this->infoitem,$this->infoid,'information',$this->headline,$this->abstract,$this->releaser,$this->release_date);
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
            $contentMenu = ContentMenu::find()->where(['articleid'=>$this->infoid])->one();
            if ($contentMenu) {
                $contentMenu->delete();
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'infoid' => '文章ID',
            'infoitem' => '所属栏目',
            'headline' => '标题',
            'subhead' => '副标题',
            'author' => '作者',
            'publish_date' => '写作日期',
            'content' => '内容',
            'keywords' => '关键词',
            'abstract' => '摘要',
            'ishow' => '是否显示',
            'level' => '类型',
            'releaser' => '发布者',
            'release_date' => '发布日期',
            'headcolor' => '标题颜色',
            'subhcolor' => '副标题颜色',
            'iscomment' => '是否评论',
            'isdelete' => '是否自动删除',
            'deletedate' => '自动删除日期',
        ];
    }

}
