<?php

namespace backend\modules\test\models;


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
            [['content', 'options', 'note'], 'string', 'max' => 1500],
            [['answer'], 'string', 'max' => 1000],
            [['source'], 'string', 'max' => 100]
        ];
    }

    public function findAllItem()
    {
        $items = static::find()->where(['alone'=>0])->all();
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
    

    //验证答案，同时统计正确率
    public function checkAnswer($id,$answer,$score)
    {

        $item = static::findOne($id);

        if($item){
            if (!is_array($score)) {
                exit('传入了非数组的分值数组');
                if (!array_key_exists($item->type,$score)) {
                   exit('分值数组未包含所id'.$id.'的类型');
                }
            }
            $corAnswer = $item->answer;
            $item->sum += 1;
            if ($item->type==2) {//多选题判定，答对一半给一半分数
                $corAnswer = unserialize($corAnswer);
                $c = array_diff($corAnswer,$answer);
                $d = array_diff($answer,$corAnswer);
                if (empty($c)&&empty($d)) {
                     $item->save();
                    return $score[$item->type];
                }
            }elseif($item->alone!=0){//如果是材料题的附带，则查找同题下的小题数，平均分配分数
                $count=1;
                $count = $this->find()->where(['alone'=>$item->alone])->count();
                if ($corAnswer==$answer) {
                     $item->save();
                   return round($score[4]/4);//临时修改================
                }
            }else{
                if ($corAnswer == $answer) {
                     $item->save();
                    return $score[$item->type];
                }
            }
            $item->wrong +=1; 
            $item->save();
        }

        
        return 0;
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
