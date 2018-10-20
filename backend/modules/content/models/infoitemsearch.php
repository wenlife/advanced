<?php

namespace backend\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\infoitem;

/**
 * infoitemsearch represents the model behind the search form about `backend\modules\content\models\infoitem`.
 */
class infoitemsearch extends infoitem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemid', 'parentid', 'itemtype', 'itemorder'], 'integer'],
            [['itemname', 'itemurl', 'itemdesc'], 'safe'],
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
        $query = infoitem::find();

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
            'itemid' => $this->itemid,
            'parentid' => $this->parentid,
            'itemtype' => $this->itemtype,
            'itemorder' => $this->itemorder,
        ]);

        $query->andFilterWhere(['like', 'itemname', $this->itemname])
            ->andFilterWhere(['like', 'itemurl', $this->itemurl])
            ->andFilterWhere(['like', 'itemdesc', $this->itemdesc]);

        return $dataProvider;
    }
}
