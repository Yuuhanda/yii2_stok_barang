<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "item_unit".
 *
 * @property int $id_unit
 * @property int $id_item
 * @property int $status
 * @property int|null $id_wh
 * @property string|null $comment
 * @property string $serial_number
 * @property int $condition
 *
 * @property ConditionLookup $condition0
 * @property Item $item
 * @property Lending[] $lendings
 * @property StatusLookup $status0
 * @property Warehouse $wh
 */
class ItemUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_item', 'condition'], 'required'],
            [['id_item', 'status', 'id_wh', 'condition'], 'integer'],
            [['comment', 'serial_number'], 'string', 'max' => 60],
            [['serial_number'], 'unique'],
            [['comment'], 'default', 'value' => 'New Unit'],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusLookup::class, 'targetAttribute' => ['status' => 'id_status']],
            [['condition'], 'exist', 'skipOnError' => true, 'targetClass' => ConditionLookup::class, 'targetAttribute' => ['condition' => 'id_condition']],
            [['id_item'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['id_item' => 'id_item']],
            [['id_wh'], 'exist', 'skipOnError' => true, 'targetClass' => Warehouse::class, 'targetAttribute' => ['id_wh' => 'id_wh']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_unit' => 'Id Unit',
            'id_item' => 'Id Item',
            'status' => 'Status',
            'id_wh' => 'Id Wh',
            'comment' => 'Comment',
            'serial_number' => 'Serial Number',
            'condition' => 'Condition',
        ];
    }

    /**
     * Gets query for [[Condition0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCondition0()
    {
        return $this->hasOne(ConditionLookup::class, ['id_condition' => 'condition']);
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id_item' => 'id_item']);
    }

    /**
     * Gets query for [[Lendings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::class, ['id_unit' => 'id_unit']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(StatusLookup::class, ['id_status' => 'status']);
    }

    /**
     * Gets query for [[Wh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWh()
    {
        return $this->hasOne(Warehouse::class, ['id_wh' => 'id_wh']);
    }



    //Data for item detail
    public function getItemDetail($id_item){
        $query = (new Query())
            ->select([
                'condition_lookup.condition_name AS condition',
                'item_unit.serial_number AS serial_number',
                'item_unit.id_unit AS id_unit',
                'status_lookup.status_name AS status',
                'user.username AS updated_by',

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
            
                'item_unit.comment AS comment',
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
        $command = $query->createCommand();
        $results = $command->queryAll();

        return $results;
    }

    //Get item distribution on each warehouse
    public function getWhDistribution($id_item){
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
            ->where(['item_unit.id_item'=>$id_item])
            ->groupBy('warehouse.id_wh'); // Group by warehouse id

        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;
    }


    //get unit available to be lent
    public function getAvailableUnit($id_item){
        $query = (new Query())
        ->select('serial_number, condition_lookup.condition_name, id_unit')
        ->from('item_unit')
        ->leftJoin('condition_lookup', 'item_unit.condition = condition_lookup.id_condition')
        ->where("item_unit.status = 1 AND item_unit.condition != 4 AND item_unit.condition != 5 AND item_unit.id_item = $id_item")
        ->groupBy('item_unit.serial_number');
        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;
    }



    //get unit in repair list
    public function getUnitRepair(){
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
            ->leftJoin('lending', 'item_unit.id_unit = lending.id_unit')
            ->leftJoin('warehouse', 'warehouse.id_wh = item_unit.id_wh')
            ->leftJoin('item', 'item.id_item = item_unit.id_item')
            ->leftJoin('user', 'user.id = item_unit.updated_by')
            ->leftJoin('status_lookup', 'item_unit.status = status_lookup.id_status')
            ->leftJoin('condition_lookup', 'item_unit.condition = condition_lookup.id_condition')
            ->where(['item_unit.status' => 3])  // Only where status = 3
            ->groupBy('item_unit.id_unit');     // Group by id_unit

        $command = $query->createCommand();
        $results = $command->queryAll();  // Fetch all results
        return $results;
    }

    public function getBrokenUnit()
    {
        $query = (new Query())
            ->select([
                'condition_lookup.condition_name AS condition',
                'item_unit.serial_number AS serial_number',
                'item_unit.id_unit AS id_unit',
                'status_lookup.status_name AS status',
                'user.username AS updated_by',
                'warehouse.wh_name AS warehouse',
                'item_unit.comment AS comment',
            ])
            ->from('item_unit')
            ->leftJoin('lending', 'item_unit.id_unit = lending.id_unit')
            ->leftJoin('warehouse', 'warehouse.id_wh = item_unit.id_wh')
            ->leftJoin('item', 'item.id_item = item_unit.id_item')
            ->leftJoin('user', 'user.id = item_unit.updated_by')
            ->leftJoin('status_lookup', 'item_unit.status = status_lookup.id_status')
            ->leftJoin('condition_lookup', 'item_unit.condition = condition_lookup.id_condition')
            ->where(['!=', 'item_unit.condition', 1])  // Filter for condition != 1
            ->groupBy('item_unit.id_unit');  // Group by id_unit
            
        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;
    }
    
}
