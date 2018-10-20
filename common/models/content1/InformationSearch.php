<?php

namespace common\models\content;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\content\Information;

/**
 * InformationSearch represents the model behind the search form about `common\models\content\Information`.
 */
class InformationSearch extends Information
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['infoid', 'infoitem', 'iscomment', 'isdelete'], 'integer'],
            [['headline', 'subhead', 'author', 'publish_date', 'content', 'keywords', 'abstract', 'ishow', 'level', 'releaser', 'release_date', 'headcolor', 'subhcolor', 'deletedate'], 'safe'],
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
        $query = Information::find();

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
            'infoid' => $this->infoid,
            'infoitem' => $this->infoitem,
            'publish_date' => $this->publish_date,
            'release_date' => $this->release_date,
            'iscomment' => $this->iscomment,
            'isdelete' => $this->isdelete,
            'deletedate' => $this->deletedate,
        ]);

        $query->andFilterWhere(['like', 'headline', $this->headline])
            ->andFilterWhere(['like', 'subhead', $this->subhead])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'abstract', $this->abstract])
            ->andFilterWhere(['like', 'ishow', $this->ishow])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'releaser', $this->releaser])
            ->andFilterWhere(['like', 'headcolor', $this->headcolor])
            ->andFilterWhere(['like', 'subhcolor', $this->subhcolor]);

        return $dataProvider;
    }
}
