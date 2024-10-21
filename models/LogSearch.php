<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnitLog;

/**
 * LogSearch represents the model behind the search form of `app\models\UnitLog`.
 */
class LogSearch extends UnitLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_log', 'id_unit', 'content'], 'integer'],
            [['update_at'], 'safe'],
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
    public function search($params)
    {
        $query = UnitLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_log' => $this->id_log,
            'id_unit' => $this->id_unit,
            'content' => $this->content,
            'update_at' => $this->update_at,
        ]);

        return $dataProvider;
    }
}
