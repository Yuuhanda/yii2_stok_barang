<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lending_type_lookup".
 *
 * @property int $id_type
 * @property string $type_name
 *
 * @property Lending[] $lendings
 */
class LendingTypeLookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lending_type_lookup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name'], 'required'],
            [['type_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_type' => 'Id Type',
            'type_name' => 'Type Name',
        ];
    }

    /**
     * Gets query for [[Lendings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::class, ['type' => 'id_type']);
    }
}
