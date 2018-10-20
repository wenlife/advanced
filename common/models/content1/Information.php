<?php

namespace common\models\content;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'infoid' => 'Infoid',
            'infoitem' => 'Infoitem',
            'headline' => 'Headline',
            'subhead' => 'Subhead',
            'author' => 'Author',
            'publish_date' => 'Publish Date',
            'content' => 'Content',
            'keywords' => 'Keywords',
            'abstract' => 'Abstract',
            'ishow' => 'Ishow',
            'level' => 'Level',
            'releaser' => 'Releaser',
            'release_date' => 'Release Date',
            'headcolor' => 'Headcolor',
            'subhcolor' => 'Subhcolor',
            'iscomment' => 'Iscomment',
            'isdelete' => 'Isdelete',
            'deletedate' => 'Deletedate',
        ];
    }
}
