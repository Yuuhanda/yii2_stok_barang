<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "item".
 *
 * @property int $id_item
 * @property string $item_name
 * @property string $SKU
 *
 * @property ItemUnit[] $itemUnits
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name'], 'required'],
            [['item_name'], 'string', 'max' => 60],
            [['SKU'], 'string', 'max' => 50],
            [['SKU'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_item' => 'Id Item',
            'item_name' => 'Item Name',
            'SKU' => 'Sku',
        ];
    }

    /**
     * Gets query for [[ItemUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemUnits()
    {
        return $this->hasMany(ItemUnit::class, ['id_item' => 'id_item']);
    }

    //get item name for item
    public function getItemName($id_item){
        $query = (new Query())
            ->select('item_name')  //select name
            ->from('item')
            ->where("id_item = $id_item");  //
    
        $command = $query->createCommand();
        $results = $command->queryAll();  // Fetch all rows
        return $results;
    }

        //Data for dashboard. Summary for items for each status
        public function getDashboard(){
            $query = (new Query())
                ->select([
                    'item_name'=>'item.item_name',
                    'SKU'=>'item.SKU',
                    'available' => 'COUNT(CASE WHEN TRIM(status) = "1" THEN 1 END)',
                    'in_use' => 'COUNT(CASE WHEN TRIM(status) = "2" THEN 1 END)',
                    'in_repair' => 'COUNT(CASE WHEN TRIM(status) = "3" THEN 1 END)',
                    'lost' => 'COUNT(CASE WHEN TRIM(status) = "4" THEN 1 END)',
                    'id_item'=>'item.id_item',
                ])
                ->from('item_unit')
                ->leftJoin('item', 'item.id_item = item_unit.id_item')
                ->groupBy("item_unit.id_item"); // Group by id_item to get counts for each item
        
            $command = $query->createCommand();
            $results = $command->queryAll();
            return $results;
            }
}