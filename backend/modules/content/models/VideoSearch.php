<?php

namespace backend\modules\content\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\content\models\Video;

/**
 * VideoSearch represents the model behind the search form about `common\models\content\Video`.
 */
class VideoSearch extends Video
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'infoid', 'gbid', 'showorder', 'size', 'level', 'filestatus', 'play'], 'integer'],
            [['attachdesc', 'filename', 'expand_name', 'url', 'keywords', 'releaser', 'release_date', 'deletedate'], 'safe'],
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
        $query = Video::find();

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
            'infoid' => $this->infoid,
            'gbid' => $this->gbid,
            'showorder' => $this->showorder,
            'size' => $this->size,
            'level' => $this->level,
            'filestatus' => $this->filestatus,
            'play' => $this->play,
            'release_date' => $this->release_date,
            'deletedate' => $this->deletedate,
        ]);

        $query->andFilterWhere(['like', 'attachdesc', $this->attachdesc])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'expand_name', $this->expand_name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'releaser', $this->releaser]);

        return $dataProvider;
    }
}
