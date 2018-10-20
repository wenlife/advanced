<?php

namespace backend\modules\test\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\test\models\TestItem;

/**
 * TestitemSearch represents the model behind the search form about `backend\modules\test\models\TestItem`.
 */
class TestitemSearch extends TestItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'alone', 'type', 'chapter', 'sum', 'wrong'], 'integer'],
            [['content', 'options', 'answer', 'note', 'source', 'date'], 'safe'],
            [['level'], 'number'],
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
        $query = TestItem::find()->where(['=','alone','0']);

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
            'alone' => $this->alone,
            'type' => $this->type,
            'chapter' => $this->chapter,
            'sum' => $this->sum,
            'wrong' => $this->wrong,
            'level' => $this->level,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'source', $this->source]);

        return $dataProvider;
    }
}
