<?php

namespace backend\modules\school\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\school\models\UserBanji;

/**
 * UserbanjiSearch represents the model behind the search form about `common\models\UserBanji`.
 */
class UserbanjiSearch extends UserBanji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'serial', 'type'], 'integer'],
            [['grade', 'title', 'monitor', 'yw', 'ds', 'yy', 'zz', 'ls', 'dl', 'wl', 'hx', 'sw', 'xx', 'note'], 'safe'],
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
        $query = UserBanji::find();

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
            'serial' => $this->serial,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'grade', $this->grade])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'monitor', $this->monitor])
            ->andFilterWhere(['like', 'yw', $this->yw])
            ->andFilterWhere(['like', 'ds', $this->ds])
            ->andFilterWhere(['like', 'yy', $this->yy])
            ->andFilterWhere(['like', 'zz', $this->zz])
            ->andFilterWhere(['like', 'ls', $this->ls])
            ->andFilterWhere(['like', 'dl', $this->dl])
            ->andFilterWhere(['like', 'wl', $this->wl])
            ->andFilterWhere(['like', 'hx', $this->hx])
            ->andFilterWhere(['like', 'sw', $this->sw])
            ->andFilterWhere(['like', 'xx', $this->xx])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
