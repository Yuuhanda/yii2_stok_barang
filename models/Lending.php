<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\models\ItemUnit;

/**
 * This is the model class for table "lending".
 *
 * @property int $id_lending
 * @property int $id_unit
 * @property int $user_id
 * @property int $id_employee
 * @property int $type
 * @property string $date
 *
 * @property Employee $employee
 * @property LendingTypeLookup $type0
 * @property ItemUnit $unit
 * @property User $user
 */
class Lending extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lending';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'user_id', 'id_employee', 'type', 'date'], 'required'],
            [['id_unit', 'user_id', 'id_employee', 'type'], 'integer'],
            [['date'], 'safe'],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => ItemUnit::class, 'targetAttribute' => ['id_unit' => 'id_unit']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => LendingTypeLookup::class, 'targetAttribute' => ['type' => 'id_type']],
            [['id_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::class, 'targetAttribute' => ['id_employee' => 'id_employee']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_lending' => 'Id Lending',
            'id_unit' => 'Id Unit',
            'user_id' => 'User ID',
            'id_employee' => 'Id Employee',
            'type' => 'Type',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, ['id_employee' => 'id_employee']);
    }

    /**
     * Gets query for [[Type0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(LendingTypeLookup::class, ['id_type' => 'type']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(ItemUnit::class, ['id_unit' => 'id_unit']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getLendingList(){
    $query = (new Query())
        ->select([
            'item_unit.serial_number AS serial_number',
            'employee.emp_name AS employee',
            'user.username AS updated_by',
            'item_unit.comment AS comment',
            'lending.date AS date',
            'lending.id_unit AS id_unit',
            'lending.id_lending AS id_lending',
        ])
        ->from('lending')
        ->leftJoin('employee', 'employee.id_employee = lending.id_employee')
        ->leftJoin('item_unit', 'item_unit.id_unit = lending.id_unit')
        ->leftJoin('user', 'user.id = lending.user_id')
        ->where(['lending.type' => 1])
        ->all();

        return $query;
    }

    //for unit list and available unit in lending page
    public function getListAvailableLending(){
        $query = (new Query())
            ->select([
                'item_name'=>'item.item_name',
                'SKU'=>'item.SKU',
                'id_item'=>'item.id_item',
                'COUNT(CASE WHEN TRIM(item_unit.status) = "1" AND item_unit.condition != 4 AND item_unit.condition != 5 THEN 1 END) AS available_unit',
            ])
            ->from('item')
            ->leftJoin('item_unit', 'item_unit.id_item = item.id_item')
            ->groupBy('item.id_item');

        $command = $query->createCommand();
        $results = $command->queryAll();  // Fetch the results
        return $results;
    }

    public function getWarehouse()
    {
        return $this->hasOne(Warehouse::class, ['id_wh' => 'id_wh']); // Replace with correct field names
    }

    public function getItemStatus()
    {
        return $this->hasOne(ItemUnit::class, ['id_unit' => 'id_item']);
    }
}
