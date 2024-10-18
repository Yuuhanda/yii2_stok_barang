<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id_employee
 * @property string $emp_name
 * @property string $phone
 * @property string $email
 * @property string $address
 *
 * @property Lending[] $lendings
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_name', 'phone', 'email', 'address'], 'required'],
            [['emp_name', 'email'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_employee' => 'Id Employee',
            'emp_name' => 'Emp Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Lendings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::class, ['id_employee' => 'id_employee']);
    }
}
