<?php

namespace app\models;

use Yii;
use yii\db\Query;
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
}
