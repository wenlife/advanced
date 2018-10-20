<?php

namespace backend\modules\test\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\test\models\TestScore;

/**
 * TestscoreSearch represents the model behind the search form about `backend\modules\test\models\TestScore`.
 */
class TestscoreSearch extends TestScore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'testid', 'score'], 'integer'],
            [['userid', 'answer', 'date', 'backup'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params,$testid=1)
    {
        $query = TestScore::find()->where(['testid'=>$testid]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'testid' => $this->testid,
            'score' => $this->score,
        ]);

        $query->andFilterWhere(['like', 'userid', $this->userid])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'backup', $this->backup]);

        return $dataProvider;
    }
}
