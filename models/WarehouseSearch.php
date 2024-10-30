<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Warehouse;
use yii\data\ArrayDataProvider;
use yii\db\Query;
/**
 * WarehouseSearch represents the model behind the search form of `app\models\Warehouse`.
 */
class WarehouseSearch extends Warehouse
{
    
    public $wh_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_wh'], 'integer'],
            [['wh_name', 'wh_address'], 'safe'],
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
        $query = Warehouse::find();

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
            'id_wh' => $this->id_wh,
        ]);

        $query->andFilterWhere(['like', 'wh_name', $this->wh_name])
            ->andFilterWhere(['like', 'wh_address', $this->wh_address]);

        return $dataProvider;
    }

    public function searchWhDist($params, $id_item){

        // Construct the query as in getWhDistribution
        $query = (new Query())
            ->select([
                'warehouse' => 'COALESCE(warehouse.wh_name, "In-Repair")',
                'available' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "1" THEN 1 END)',
                'in_use' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "2" THEN 1 END)',
                'in_repair' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "3" THEN 1 END)',
                'lost' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "4" THEN 1 END)',
            ])
            ->from('item_unit')
            ->leftJoin('warehouse', 'warehouse.id_wh=item_unit.id_wh')
            ->where(['item_unit.id_item' => $id_item])
            ->groupBy('warehouse.id_wh');


        // Load the search parameters
        $this->load($params);
        // Apply filtering conditions
        //if (!$this->validate()) {
        //    // Return all records if validation fails
        //    $query->where('0=1');
        //}

        // Add conditions based on filters (optional)
        $query->andFilterWhere(['like', 'warehouse.wh_name', $this->wh_name]);


        // Execute the query and fetch the results
        $command = $query->createCommand();
        $results = $command->queryAll();


        // Create a data provider to return the data
        return new ArrayDataProvider([
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }
}
