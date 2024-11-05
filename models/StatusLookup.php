<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status_lookup".
 *
 * @property int $id_status
 * @property string $status_name
 *
 * @property ItemUnit[] $itemUnits
 */
class StatusLookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_lookup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_status' => 'Id Status',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * Gets query for [[ItemUnits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemUnits()
    {
        return $this->hasMany(ItemUnit::class, ['status' => 'id_status']);
    }

    public static function getStatusList()
    {
        return ArrayHelper::map(self::find()->all(), 'id_status', 'status_name'); // assuming 'id' and 'username' columns
    }
}
