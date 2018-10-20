<?php

namespace common\models\content;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'note' => 'Note',
            'cid' => 'Cid',
            'iscollection' => 'Iscollection',
            'keywords' => 'Keywords',
            'date' => 'Date',
            'author' => 'Author',
        ];
    }
}
