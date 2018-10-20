<?php

namespace common\models\content;

use Yii;

/**
 * This is the model class for table "content_attachments".
 *
 * @property integer $attachid
 * @property integer $infoid
 * @property integer $gbid
 * @property string $attachdesc
 * @property integer $showorder
 * @property string $size
 * @property string $filename
 * @property string $expand_name
 * @property string $url
 * @property string $keywords
 * @property integer $level
 * @property integer $filestatus
 * @property integer $isdl
 * @property string $releaser
 * @property string $release_date
 * @property string $deletedate
 */
class Attachments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_attachments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attachid', 'infoid', 'gbid', 'attachdesc', 'showorder', 'size', 'filename', 'expand_name', 'url', 'keywords', 'level', 'filestatus', 'isdl', 'releaser', 'release_date', 'deletedate'], 'required'],
            [['attachid', 'infoid', 'gbid', 'showorder', 'size', 'level', 'filestatus', 'isdl'], 'integer'],
            [['release_date', 'deletedate'], 'safe'],
            [['attachdesc'], 'string', 'max' => 400],
            [['filename'], 'string', 'max' => 200],
            [['expand_name', 'url', 'keywords'], 'string', 'max' => 100],
            [['releaser'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attachid' => 'Attachid',
            'infoid' => 'Infoid',
            'gbid' => 'Gbid',
            'attachdesc' => 'Attachdesc',
            'showorder' => 'Showorder',
            'size' => 'Size',
            'filename' => 'Filename',
            'expand_name' => 'Expand Name',
            'url' => 'Url',
            'keywords' => 'Keywords',
            'level' => 'Level',
            'filestatus' => 'Filestatus',
            'isdl' => 'Isdl',
            'releaser' => 'Releaser',
            'release_date' => 'Release Date',
            'deletedate' => 'Deletedate',
        ];
    }
}
