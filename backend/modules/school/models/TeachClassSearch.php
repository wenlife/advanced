<?php

namespace backend\modules\school\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\TeachClass;

/**
 * TeachClassSearch represents the model behind the search form of `backend\modules\guest\models\TeachClass`.
 */
class TeachClassSearch extends TeachClass
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'serial'], 'integer'],
            [['title', 'grade', 'type', 'school', 'note'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TeachClass::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'serial' => $this->serial,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
