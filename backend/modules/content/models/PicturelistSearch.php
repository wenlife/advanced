<?php

namespace backend\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\Picturelist;

/**
 * PicturelistSearch represents the model behind the search form about `backend\modules\content\models\Picturelist`.
 */
class PicturelistSearch extends Picturelist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid', 'is_collection'], 'integer'],
            [['title', 'note', 'kewords', 'date', 'author', 'cover'], 'safe'],
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
        $query = Picturelist::find();

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
            'cid' => $this->cid,
            'is_collection' => $this->is_collection,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'kewords', $this->kewords])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'cover', $this->cover]);

        return $dataProvider;
    }
}
