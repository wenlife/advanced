<?php
namespace backend\modules\content\models;

use Yii;

/**
 * This is the model class for table "content_video".
 *
 * @property integer $id
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
 * @property integer $play
 * @property string $releaser
 * @property string $release_date
 * @property string $deletedate
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['infoid','attachdesc'], 'required'],
            [['id', 'infoid', 'gbid', 'showorder', 'size', 'level', 'filestatus', 'play'], 'integer'],
            [['release_date'], 'safe'],
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
            'id' => 'ID',
            'infoid' => '栏目',
            'gbid' => '分类号',
            'attachdesc' => '附件描述',
            'showorder' => '排序',
            'size' => '大小',
            'filename' => '文件名',
            'expand_name' => '扩展名',
            'url' => 'URL',
            'keywords' => '关键词',
            'level' => '级别',
            'filestatus' => 'Filestatus',
            'play' => '播放数',
            'releaser' => '发布者',
            'release_date' => '发布日期',
            'deletedate' => '自动删除日期',
        ];
    }
}
