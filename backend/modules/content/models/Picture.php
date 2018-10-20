<?php

namespace backend\modules\content\models;

use Yii;

/**
 * This is the model class for table "content_picture".
 *
 * @property integer $id
 * @property integer $picitem
 * @property integer $infoid
 * @property integer $gbid
 * @property string $headline
 * @property string $headcolor
 * @property string $describes
 * @property integer $showorder
 * @property string $size
 * @property string $filename
 * @property string $expand_name
 * @property string $url
 * @property string $keywords
 * @property integer $level
 * @property integer $filestatus
 * @property string $releaser
 * @property string $release_date
 * @property integer $deletedate
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_picture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['infoid', 'headline', 'describes', 'url'], 'required'],
            [['id', 'picitem', 'infoid', 'gbid', 'showorder', 'size', 'level', 'filestatus', 'deletedate'], 'integer'],
            [['release_date'], 'safe'],
            [['headline', 'filename'], 'string', 'max' => 200],
            [['headcolor'], 'string', 'max' => 6],
            [['describes'], 'string', 'max' => 400],
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
            'id' => 'id',
            'picitem' => 'Picitem',
            'infoid' => 'Infoid',
            'gbid' => 'Gbid',
            'headline' => 'Headline',
            'headcolor' => 'Headcolor',
            'describes' => 'Describes',
            'showorder' => 'Showorder',
            'size' => 'Size',
            'filename' => 'Filename',
            'expand_name' => 'Expand Name',
            'url' => 'Url',
            'keywords' => 'Keywords',
            'level' => 'Level',
            'filestatus' => 'Filestatus',
            'releaser' => 'Releaser',
            'release_date' => 'Release Date',
            'deletedate' => 'Deletedate',
        ];
    }
}
