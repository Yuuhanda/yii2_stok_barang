<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lending;

/**
 * LendingSearch represents the model behind the search form of `app\models\Lending`.
 */
class LendingSearch extends Lending
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lending', 'id_unit', 'user_id', 'id_employee', 'type'], 'integer'],
            [['date'], 'safe'],
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
        $query = Lending::find();

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
            'id_lending' => $this->id_lending,
            'id_unit' => $this->id_unit,
            'user_id' => $this->user_id,
            'id_employee' => $this->id_employee,
            'type' => $this->type,
            'date' => $this->date,
        ]);

        return $dataProvider;
    }
}
