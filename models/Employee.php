<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

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

    //get all employee list
    public function getEmpList(){
    $query = (new Query())
        ->select('*')  // Select all columns
        ->from('employee');  // From the employee table

    $command = $query->createCommand();
    $results = $command->queryAll();  // Fetch all rows
    return $results;
    }

    public function getEmpNameList(){
        $query = (new Query())
            ->select('emp_name')  // Select all columns
            ->from('employee');  // From the employee table
    
        $command = $query->createCommand();
        $results = $command->queryAll();  // Fetch all rows
        return $results;
    }

    public static function getEmployeeList()
    {
        return ArrayHelper::map(Employee::find()->select('emp_name')->asArray()->all(), 'emp_name', 'emp_name');// assuming 'id' and 'name' columns
    }
}
