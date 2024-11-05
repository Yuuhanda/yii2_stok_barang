<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "warehouse".
 *
 * @property int $id_wh
 * @property string $wh_name
 * @property string $wh_address
 *
 * @property ItemUnit[] $itemUnits
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wh_name', 'wh_address'], 'required'],
            [['wh_name', 'wh_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_wh' => 'Id Wh',
            'wh_name' => 'Wh Name',
            'wh_address' => 'Wh Address',
        ];
    }

    /**
     * Gets query for [[ItemUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemUnits()
    {
        return $this->hasMany(ItemUnit::class, ['id_wh' => 'id_wh']);
    }

    //get wh on a list
    public function getWhList(){
        $query = (new Query())
        ->select('*')  //select name
        ->from('warehouse');  //

    $command = $query->createCommand();
    $results = $command->queryAll();  // Fetch all rows
    return $results;
    }

    public function getWhName($id_wh){
        $query = (new Query())
        ->select('wh_name')
        ->from('warehouse')
        ->where(['id_wh'=>$id_wh]);

        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;
    }

    public function getExport($id_wh){
        $query = (new Query())
        ->select([
            'item_name' => 'item.item_name',
            'SKU' => 'item.SKU',
            'available' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "1" AND item_unit.condition != 4 AND item_unit.condition != 5 THEN 1 END)',
            'in_use' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "2" THEN 1 END)',
            'in_repair' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "3" THEN 1 END)',
            'lost' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "4" THEN 1 END)',
            'id_item' => 'item.id_item',
        ])
        ->from('item')
        ->leftJoin('item_unit', 'item.id_item = item_unit.id_item')
        ->where(['item_unit.id_wh'=>$id_wh])
        ->groupBy('item.id_item');
        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;

    }

    public static function getWarehouseList()
    {
        return ArrayHelper::map(self::find()->all(), 'id_wh', 'wh_name'); // assuming 'id' and 'name' columns
    }
}
