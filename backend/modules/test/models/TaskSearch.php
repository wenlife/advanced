<?php

namespace backend\modules\test\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\test\models\Task;

/**
 * TaskSearch represents the model behind the search form about `backend\modules\test\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test', 'state'], 'integer'],
            [['title', 'content', 'feedback', 'enddate', 'createdate', 'creator'], 'safe'],
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
    public function search($params,$userid=null)
    {
        $query = Task::find();
        if ($userid) {
           $query = Task::find()->where(['creator'=>$userid]);
        }

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
            'test' => $this->test,
            'state' => $this->state,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'feedback', $this->feedback])
            ->andFilterWhere(['like', 'enddate', $this->enddate])
            ->andFilterWhere(['like', 'createdate', $this->createdate])
            ->andFilterWhere(['like', 'creator', $this->creator]);

        return $dataProvider;
    }
}
