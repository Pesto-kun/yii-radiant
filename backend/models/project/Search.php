<?php

namespace backend\models\project;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Project;

/**
 * Search represents the model behind the search form about `common\models\Project`.
 */
class Search extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'author_id', 'status', 'responsible_id'], 'safe'],
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
        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['author_id' => $this->author_id])
            ->andFilterWhere(['status' => $this->status])
            ->andFilterWhere(['responsible_id' => $this->responsible_id]);

        return $dataProvider;
    }
}
