<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class LendingSearch extends Model
{
    public $serial_number;
    public $employee;
    public $updated_by;
    public $comment;
    public $date;
    public $id_unit;
    public $id_lending;

    /**
     * Rules for validation (optional)
     */
    public function rules()
    {
        return [
            [['serial_number', 'employee', 'updated_by', 'comment'], 'safe'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['id_unit', 'id_lending'], 'integer'],
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
                'employee' => 'employee.emp_name',
                'updated_by' => 'user.username',
                'comment' => 'item_unit.comment',
                'date' => 'lending.date',
                'id_unit' => 'lending.id_unit',
                'id_lending' => 'lending.id_lending',
            ])
            ->from('lending')
            ->leftJoin('employee', 'employee.id_employee = lending.id_employee')
            ->leftJoin('item_unit', 'item_unit.id_unit = lending.id_unit')
            ->leftJoin('user', 'user.id = lending.user_id')
            ->where(['lending.type' => 1]);

        // Load the search parameters
        $this->load($params);

        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }

        // Add conditions based on filters
        $query->andFilterWhere(['like', 'item_unit.serial_number', $this->serial_number])
              ->andFilterWhere(['like', 'employee.emp_name', $this->employee])
              ->andFilterWhere(['like', 'user.username', $this->updated_by])
              ->andFilterWhere(['like', 'item_unit.comment', $this->comment])
              ->andFilterWhere(['=', 'lending.date', $this->date]);

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
                    'employee',
                    'updated_by',
                    'comment',
                    'date',
                ],
            ],
        ]);
    }
}
