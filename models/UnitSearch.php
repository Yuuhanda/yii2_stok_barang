<?php
namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\db\Query;

class UnitSearch extends Model
{
    public $serial_number;
    public $condition;
    public $status;
    public $updated_by;
    public $warehouse;
    public $employee;
    public $comment;

    /**
     * Rules for validation (optional)
     */
    public function rules()
    {
        return [
            [['serial_number', 'condition', 'status', 'updated_by', 'warehouse', 'employee', 'comment'], 'safe'],
        ];
    }

    /**
     * Search function to apply filters and return data provider
     */
    public function search($params, $id_item)
    {
        // Your custom query for item detail
        $query = (new Query())
            ->select([
                'condition' => 'condition_lookup.condition_name',
                'serial_number' => 'item_unit.serial_number',
                'id_unit' => 'item_unit.id_unit',
                'status' => 'status_lookup.status_name',
                'updated_by' => 'user.username',

                // Show warehouse only when status is not 2
                new \yii\db\Expression('CASE 
                    WHEN item_unit.status != 2 THEN warehouse.wh_name 
                    ELSE NULL 
                END AS warehouse'),

                // Show employee name only when status is 2, from the latest lending record
                new \yii\db\Expression('CASE 
                    WHEN item_unit.status = 2 THEN (
                        SELECT employee.emp_name
                        FROM lending
                        LEFT JOIN employee ON lending.id_employee = employee.id_employee
                        WHERE lending.id_unit = item_unit.id_unit
                        ORDER BY lending.id_lending DESC
                        LIMIT 1
                    )
                    ELSE NULL
                END AS employee'),

                'comment' => 'item_unit.comment',
            ])
            ->from('item_unit')
            ->leftJoin('lending', 'item_unit.id_unit = lending.id_unit')
            ->leftJoin('warehouse', 'warehouse.id_wh = item_unit.id_wh')
            ->leftJoin('employee', 'lending.id_employee = employee.id_employee')
            ->leftJoin('item', 'item.id_item = item_unit.id_item')
            ->leftJoin('user', 'user.id = item_unit.updated_by')
            ->leftJoin('status_lookup', 'item_unit.status = status_lookup.id_status')
            ->leftJoin('condition_lookup', 'item_unit.condition = condition_lookup.id_condition')
            ->where(['item_unit.id_item' => $id_item])
            ->groupBy('item_unit.id_unit');

        // Load the search parameters
        $this->load($params);

        // Apply filtering conditions
        if (!$this->validate()) {
            // Return all records if validation fails
            $query->where('0=1');
        }

        // Add conditions based on filters
        $query->andFilterWhere(['item_unit.serial_number' => $this->serial_number])
            ->andFilterWhere(['item_unit.condition' => $this->condition])
            ->andFilterWhere(['item_unit.status' => $this->status])
            ->andFilterWhere(['item_unit.updated_by' => $this->updated_by])
            ->andFilterWhere(['item_unit.id_wh' => $this->warehouse])
            ->andFilterHaving(['like', 'employee', $this->employee])
            ->andFilterWhere(['item_unit.comment' => $this->comment]);

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
                    'condition',
                    'status',
                    'updated_by',
                    'warehouse',
                    'employee',
                    'comment',
                ],
            ],
        ]);
    }


}
