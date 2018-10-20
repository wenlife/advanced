<?php

namespace common\models\test;

use Yii;

/**
 * This is the model class for table "test_item".
 *
 * @property integer $id
 * @property integer $alone
 * @property integer $type
 * @property string $content
 * @property string $options
 * @property string $answer
 * @property string $note
 * @property integer $chapter
 * @property integer $sum
 * @property integer $wrong
 * @property double $level
 * @property string $source
 * @property string $date
 */
class TestItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alone', 'type', 'chapter', 'sum', 'wrong'], 'integer'],
            [['type', 'content'], 'required'],
            [['level'], 'number'],
            [['date'], 'safe'],
            [['content', 'options', 'note'], 'string', 'max' => 500],
            [['answer'], 'string', 'max' => 200],
            [['source'], 'string', 'max' => 100]
        ];
    }

    public function findAllItem()
    {
        $items = static::find()->where(['alone'=>1])->all();
        foreach ($items as $key => $item) {
            if ($item->type==4) {
                if (!is_null($item->options)) {
                    $string = 'id in (';
                    $options = unserialize($item->options);
                    foreach ($options as $key => $value) {
                        if ($key != 0) {
                           $string.=',';
                        }
                        $string.= $value;
                    }
                    $string.=')';
                    $subItem = static::find()->where($string)->all();
                    $item->answer = $subItem;
                }
                # code...
            }
        }

        return $items;
    }

    public static function findItem($id)
    {
        $item = static::findOne($id);
        if ($item->type==4) {
            if (!is_null($item->options)) {
                $string = 'id in (';
                $options = unserialize($item->options);
                foreach ($options as $key => $value) {
                    if ($key != 0) {
                       $string.=',';
                    }
                    $string.= $value;
                }
                $string.=')';
                $subItem = static::find()->where($string)->all();
                $item->answer = $subItem;
            }
        }

        return $item;
    }


    public function getViewName()
    {
        switch($this->type) {
            case '1':
                $view  = 'singlechoice';
                break;
            case '2':
                $view = 'multichoice';
                 break;
            case '3':
                $view = 'jugg';
                 break;
            case '4':
                $view = 'mmo';
                break;
            
            default:
               exit('model itemlist return :undefined item type!');
               break;
        }
        return $view;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alone' => 'Alone',
            'type' => 'Type',
            'content' => 'Content',
            'options' => 'Options',
            'answer' => 'Answer',
            'note' => 'Note',
            'chapter' => 'Chapter',
            'sum' => 'Sum',
            'wrong' => 'Wrong',
            'level' => 'Level',
            'source' => 'Source',
            'date' => 'Date',
        ];
    }
}
