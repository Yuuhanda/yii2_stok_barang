<?php

namespace app\models;

use Yii;
use yii\db\Query;
use app\models\ItemUnit;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
    public $imageFile;
    
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
            ['imageFile', 'string', 'max' => 255],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $uploadPath = 'uploads/';
            
            // Check if directory exists, if not create it
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true); // Create the directory with permissions
            }
        
            // Save the uploaded file using $this->imageFile
            $this->imageFile->saveAs($uploadPath . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        }
        return false;
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
                'available' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "1" AND item_unit.condition != 4 AND item_unit.condition != 5 THEN 1 END)',
                'in_use' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "2" THEN 1 END)',
                'in_repair' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "3" THEN 1 END)',
                'lost' => 'COUNT(CASE WHEN TRIM(item_unit.status) = "4" THEN 1 END)',
                'id_item'=>'item.id_item',
            ])
            ->from('item')
            ->leftJoin('item_unit', 'item.id_item = item_unit.id_item')
            ->groupBy("item.id_item"); // Group by id_item to get counts for each item
    
        $command = $query->createCommand();
        $results = $command->queryAll();
        return $results;
    }

    
    public static function getUpdatedByOptions()
    {
        return \yii\helpers\ArrayHelper::map(User::find()->all(), 'id', 'username'); // Adjust fields as needed
    }

    public static function getWarehouseOptions()
    {
        return ArrayHelper::map(Warehouse::find()->all(), 'id_wh', 'wh_name');
    }

    public static function getEmployeeOptions()
    {
        return ArrayHelper::map(Employee::find()->all(), 'id_employee', 'emp_name');
    }
            
}
