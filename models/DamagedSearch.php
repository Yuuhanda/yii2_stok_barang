<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class DamagedSearch extends Model
{
    public $condition;
    public $serial_number;
    public $id_unit;
    public $status;
    public $updated_by;
    public $warehouse;
    public $comment;

    public function rules()
    {
        return [
            [['condition', 'serial_number', 'id_unit', 'status', 'updated_by', 'warehouse', 'comment'], 'safe'],
        ];
    }

    public function search($params, $data)
    {
        // Load the search parameters
        $this->load($params);

        // Create an ArrayDataProvider with all data
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // If validation fails, return unfiltered data
        if (!$this->validate()) {
            return $dataProvider;
        }

        // Filter data
        $filteredData = array_filter($data, function ($item) {
            return (
                (empty($this->condition) || stripos($item['condition'], $this->condition) !== false) &&
                (empty($this->serial_number) || stripos($item['serial_number'], $this->serial_number) !== false) &&
                (empty($this->status) || stripos($item['status'], $this->status) !== false) &&
                (empty($this->updated_by) || stripos($item['updated_by'], $this->updated_by) !== false) &&
                (empty($this->warehouse) || stripos($item['warehouse'], $this->warehouse) !== false) &&
                (empty($this->comment) || stripos($item['comment'], $this->comment) !== false)
            );
        });

        // Update the data provider with filtered data
        $dataProvider->allModels = $filteredData;

        return $dataProvider;
    }

    public function searchRepair($params)
    {
        $query = (new Query())
            ->select([
                'condition_lookup.condition_name AS condition',
                'item_unit.serial_number AS serial_number',
                'item_unit.id_unit AS id_unit',
                'status_lookup.status_name AS status',
                'user.username AS updated_by',
                'item_unit.comment AS comment',
            ])
            ->from('item_unit')
            ->leftJoin('status_lookup', 'item_unit.status = status_lookup.id_status')
            ->leftJoin('condition_lookup', 'item_unit.condition = condition_lookup.id_condition')
            ->leftJoin('user', 'user.id = item_unit.updated_by')
            ->where(['item_unit.status' => 3])  // Filter for status = 3
            ->groupBy('item_unit.id_unit');
        
        // Apply filters from query params
        $this->load($params);

        if (!$this->validate()) {
            // If validation fails, return the query without filters
            return new ArrayDataProvider([
                'allModels' => [],
            ]);
        }

        if ($this->condition) {
            $query->andWhere(['like', 'condition_lookup.condition_name', $this->condition]);
        }
        if ($this->serial_number) {
            $query->andWhere(['like', 'item_unit.serial_number', $this->serial_number]);
        }
        if ($this->id_unit) {
            $query->andWhere(['item_unit.id_unit' => $this->id_unit]);
        }
        if ($this->updated_by) {
            $query->andWhere(['like', 'user.username', $this->updated_by]);
        }
        if ($this->comment) {
            $query->andWhere(['like', 'item_unit.comment', $this->comment]);
        }

        $command = $query->createCommand();
        $results = $command->queryAll();

        return new ArrayDataProvider([
            'allModels' => $results,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }
}
