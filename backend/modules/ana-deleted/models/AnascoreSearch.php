<?php

namespace backend\modules\ana\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\ana\models\AnaScore;

/**
 * AnascoreSearch represents the model behind the search form about `backend\modules\ana\models\AnaScore`.
 */
class AnascoreSearch extends AnaScore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stu_id', 'exam_id', 'yw', 'ds', 'yy', 'wl', 'hx', 'sw', 'zz', 'ls', 'dl'], 'integer'],
            [['name'], 'safe'],
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
        $query = AnaScore::find();

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
            'stu_id' => $this->stu_id,
            'exam_id' => $this->exam_id,
            'yw' => $this->yw,
            'ds' => $this->ds,
            'yy' => $this->yy,
            'wl' => $this->wl,
            'hx' => $this->hx,
            'sw' => $this->sw,
            'zz' => $this->zz,
            'ls' => $this->ls,
            'dl' => $this->dl,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
