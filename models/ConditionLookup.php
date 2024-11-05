<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "condition_lookup".
 *
 * @property int $id_condition
 * @property string $condition_name
 *
 * @property ItemUnit[] $itemUnits
 */
class ConditionLookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'condition_lookup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['condition_name'], 'required'],
            [['condition_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_condition' => 'Id Condition',
            'condition_name' => 'Condition Name',
        ];
    }

    /**
     * Gets query for [[ItemUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemUnits()
    {
        return $this->hasMany(ItemUnit::class, ['condition' => 'id_condition']);
    }

    public static function getConditionList()
    {
        return ArrayHelper::map(self::find()->all(), 'id_condition', 'condition_name'); // assuming 'id' and 'username' columns
    }
}
