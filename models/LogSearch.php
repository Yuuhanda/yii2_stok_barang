<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class LogSearch extends Model
{
    public $serial_number;
    public $content;
    public $log_date_start;
    public $log_date_end;

    /**
     * Rules for validation
     */
    public function rules()
    {
        return [
            [['serial_number', 'content'], 'safe'],
            [['log_date_start', 'log_date_end'], 'date', 'format' => 'php:Y-m-d'],
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
            ->leftJoin('item_unit', 'unit_log.id_unit = item_unit.id_unit')
            ->orderBy(['log_date' => SORT_DESC]);
            
        // Load the search parameters
        $this->load($params);
            
        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }
    
        // Add conditions based on filters
        $query->andFilterWhere(['like', 'item_unit.serial_number', $this->serial_number])
              ->andFilterWhere(['like', 'unit_log.content', $this->content]);
    
        // Apply date range filtering
        if ($this->log_date_start) {
            $query->andFilterWhere(['>=', 'unit_log.update_at', $this->log_date_start . ' 00:00:00']);
        }
        if ($this->log_date_end) {
            // Set the end date to the last second of the selected day
            $query->andFilterWhere(['<=', 'unit_log.update_at', $this->log_date_end . ' 23:59:59']);
        }
    
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
