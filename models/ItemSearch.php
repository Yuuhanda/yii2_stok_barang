<?php
namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class ItemSearch extends Model
{
    public $item_name;
    public $SKU;
    public $available;
    public $in_use;
    public $in_repair;
    public $lost;
    public $id_item;
    public $imagefile;

    /**
     * Rules for validation (optional, add any specific rules if necessary)
     */
    public function rules()
    {
        return [
            [['item_name', 'SKU', 'imagefile'], 'safe'],
            [['available', 'in_use', 'in_repair', 'lost', 'id_item'], 'integer'],
        ];
    }

    /**
     * Search function to apply filters and return data provider for the dashboard
     */
    public function search($params)
    {
        // Your custom query for the dashboard
        $query = (new Query())
            ->select([
                'item_name' => 'item.item_name',
                'SKU' => 'item.SKU',
                'available' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "1" AND item_unit.condition != 4 AND item_unit.condition != 5 THEN 1 END)',
                'in_use' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "2" THEN 1 END)',
                'in_repair' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "3" THEN 1 END)',
                'lost' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "4" THEN 1 END)',
                'id_item' => 'item.id_item',
                'imagefile' =>'item.imagefile',
            ])
            ->from('item')
            ->leftJoin('item_unit', 'item.id_item = item_unit.id_item')
            ->groupBy('item.id_item');

        // Load the search parameters
        $this->load($params);

        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }

        // Add conditions based on filters (optional)
        $query->andFilterWhere(['like', 'item.item_name', $this->item_name])
              ->andFilterWhere(['like', 'item.SKU', $this->SKU]);

        // Execute the query and return an ArrayDataProvider
        $command = $query->createCommand();
        $results = $command->queryAll();

        return new ArrayDataProvider([
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 20, // Adjust as needed
            ],
            'sort' => [
                'attributes' => [
                    'item_name',
                    'SKU',
                    'available',
                    'in_use',
                    'in_repair',
                    'lost',
                    'imagefile'
                ],
            ],
        ]);
    }

    public function searchWarehouse($params, $id_wh)
    {
        // Your custom query for the dashboard
        $query = (new Query())
            ->select([
                'item_name' => 'item.item_name',
                'SKU' => 'item.SKU',
                'available' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "1" AND item_unit.condition != 4 AND item_unit.condition != 5 THEN 1 END)',
                'in_use' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "2" THEN 1 END)',
                'in_repair' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "3" THEN 1 END)',
                'lost' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "4" THEN 1 END)',
                'id_item' => 'item.id_item',
                'imagefile' =>'item.imagefile',
            ])
            ->from('item')
            ->leftJoin('item_unit', 'item.id_item = item_unit.id_item')
            ->where(['item_unit.id_wh'=>$id_wh])
            ->groupBy('item.id_item');

        // Load the search parameters
        $this->load($params);

        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }

        // Add conditions based on filters (optional)
        $query->andFilterWhere(['like', 'item.item_name', $this->item_name])
              ->andFilterWhere(['like', 'item.SKU', $this->SKU]);

        // Execute the query and return an ArrayDataProvider
        $command = $query->createCommand();
        $results = $command->queryAll();

        return new ArrayDataProvider([
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 20, // Adjust as needed
            ],
            'sort' => [
                'attributes' => [
                    'item_name',
                    'SKU',
                    'available',
                    'in_use',
                    'in_repair',
                    'lost',
                    'imagefile',
                ],
            ],
        ]);
    }


}
