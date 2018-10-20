<?php
namespace backend\modules\test\models;

use Yii;
use backend\modules\test\models\TestPaper;

/**
 * This is the model class for table "test_score".
 *
 * @property integer $id
 * @property string $userid
 * @property integer $testid
 * @property string $answer
 * @property integer $score
 * @property string $date
 * @property string $backup
 */
class TestScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'testid', 'answer', 'score', 'date'], 'required'],
            [['testid', 'score'], 'integer'],
            [['answer'], 'string'],
            [['userid'], 'string', 'max' => 255],
          //  [['date'], 'string', 'max' => 20],
            [['backup'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */

    public function getTest()
    {
        return $this->hasOne(TestPaper::className(),['id'=>'testid']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'testid' => 'Testid',
            'answer' => 'Answer',
            'score' => 'Score',
            'date' => 'Date',
            'backup' => 'Backup',
        ];
    }
}
