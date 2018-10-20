<?php

namespace backend\modules\testService\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\testService\models\ScLike;

/**
 * SclikeSearch represents the model behind the search form of `backend\modules\testService\models\ScLike`.
 */
class SclikeSearch extends ScLike
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mc'], 'integer'],
            [['test_id', 'stu_id', 'stu_name', 'stu_class', 'stu_school', 'note'], 'safe'],
            [['yw', 'ds', 'yy', 'wl', 'hx', 'sw', 'zf'], 'number'],
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
    public function search($params,$school=null,$exam=null)
    {
        $query = ScLike::find()->where(['stu_school'=>$school,'test_id'=>$exam]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
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
            'yw' => $this->yw,
            'ds' => $this->ds,
            'yy' => $this->yy,
            'wl' => $this->wl,
            'hx' => $this->hx,
            'sw' => $this->sw,
            'zf' => $this->zf,
            'mc' => $this->mc,
        ]);

        $query->andFilterWhere(['like', 'test_id', $this->test_id])
            ->andFilterWhere(['like', 'stu_id', $this->stu_id])
            ->andFilterWhere(['like', 'stu_name', $this->stu_name])
            ->andFilterWhere(['like', 'stu_class', $this->stu_class])
            ->andFilterWhere(['like', 'stu_school', $this->stu_school])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
