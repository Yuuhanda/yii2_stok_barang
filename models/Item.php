<?php

namespace app\models;

use Yii;

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
            [['item_name', 'SKU'], 'required'],
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
}
