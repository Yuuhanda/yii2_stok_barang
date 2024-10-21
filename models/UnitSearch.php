<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItemUnit;

/**
 * UnitSearch represents the model behind the search form of `app\models\ItemUnit`.
 */
class UnitSearch extends ItemUnit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_item', 'status', 'id_wh', 'condition', 'updated_by'], 'integer'],
            [['comment', 'serial_number'], 'safe'],
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
        $query = ItemUnit::find();

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
            'id_unit' => $this->id_unit,
            'id_item' => $this->id_item,
            'status' => $this->status,
            'id_wh' => $this->id_wh,
            'condition' => $this->condition,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        return $dataProvider;
    }
}
