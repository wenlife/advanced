<?php

namespace backend\modules\testService\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\testService\models\Taskline;

/**
 * TasklineSearch represents the model behind the search form about `backend\modules\testService\models\Taskline`.
 */
class TasklineSearch extends Taskline
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'banji', 'line1', 'line2', 'line3', 'line4'], 'integer'],
            [['grade', 'note'], 'safe'],
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
    public function search($params)
    {
        $query = Taskline::find();

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
            'banji' => $this->banji,
            'line1' => $this->line1,
            'line2' => $this->line2,
            'line3' => $this->line3,
            'line4' => $this->line4,
        ]);

        $query->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
