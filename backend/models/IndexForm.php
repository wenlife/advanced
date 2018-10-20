<?php
namespace backend\models;

use common\models\Indexsetting;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class IndexForm extends Model
{
    public $oneleft;
    public $oneright;
    public $twoleft;
    public $tworight;
    public $threeleft;
    public $threeright;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['oneleft', 'required'],
            [['oneright', 'type'], 'integer'],
            [['twoleft', 'type'], 'integer'],
            [['tworight', 'type'], 'integer'],
            [['threeleft', 'type'], 'integer'],
            [['threeright', 'type'], 'integer'],
        ];
    }

}
