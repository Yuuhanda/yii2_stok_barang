<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class LogSearch extends Model
{
    public $serial_number;
    public $content;
    public $log_date;

    /**
     * Rules for validation (optional)
     */
    public function rules()
    {
        return [
            [['serial_number', 'content'], 'safe'],
            [['log_date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * Search function to apply filters and return data provider
     */
    public function search($params)
    {
        // Your custom query
        $query = (new Query())
            ->select([
                'serial_number' => 'item_unit.serial_number',
                'content' => 'unit_log.content',
                'log_date' => 'unit_log.update_at',
            ])
            ->from('unit_log')
            ->leftJoin('item_unit', 'unit_log.id_unit = item_unit.id_unit');

        // Load the search parameters
        $this->load($params);

        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }

        // Add conditions based on filters
        $query->andFilterWhere(['like', 'item_unit.serial_number', $this->serial_number])
              ->andFilterWhere(['like', 'unit_log.content', $this->content])
              ->andFilterWhere(['=', 'unit_log.update_at', $this->log_date]);

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
                    'serial_number',
                    'content',
                    'log_date',
                ],
            ],
        ]);
    }
}
