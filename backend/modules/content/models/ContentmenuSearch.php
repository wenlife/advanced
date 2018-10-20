<?php

namespace backend\modules\content\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\ContentMenu;

/**
 * ContentmenuSearch represents the model behind the search form about `backend\modules\content\models\ContentMenu`.
 */
class ContentmenuSearch extends ContentMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'menuid', 'articleid'], 'integer'],
            [['type', 'title', 'note', 'author', 'publish_date'], 'safe'],
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
        $query = ContentMenu::find();

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
            'menuid' => $this->menuid,
            'articleid' => $this->articleid,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'publish_date', $this->publish_date]);

        return $dataProvider;
    }
}
