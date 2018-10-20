<?php

namespace backend\modules\testService\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\testService\models\Exam;

/**
 * ExamSearch represents the model behind the search form of `backend\modules\testService\models\Exam`.
 */
class ExamSearch extends Exam
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['id', 'type', 'compare'], 'integer'],
            [['title', 'stu_grade', 'date', 'note'], 'safe'],
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
        $query = Exam::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'stu_grade', $this->stu_grade])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}