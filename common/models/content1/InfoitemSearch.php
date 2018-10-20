<?php

namespace common\models\content;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\content\Infoitem;

/**
 * InfoitemSearch represents the model behind the search form about `common\models\content\Infoitem`.
 */
class InfoitemSearch extends Infoitem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemid', 'parentid', 'itemorder'], 'integer'],
            [['itemname', 'itemdesc'], 'safe'],
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
        $query = Infoitem::find();

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
            'itemorder' => $this->itemorder,
        ]);

        $query->andFilterWhere(['like', 'itemname', $this->itemname])
            ->andFilterWhere(['like', 'itemdesc', $this->itemdesc]);

        return $dataProvider;
    }
}
