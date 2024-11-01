<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "unit_log".
 *
 * @property int $id_log
 * @property int $id_unit
 * @property int $content
 * @property string $update_at
 */
class UnitLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'content', 'update_at'], 'required'],
            [['id_unit'], 'integer'],
            [['content'],'string'],
            [['update_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_log' => 'Id Log',
            'id_unit' => 'Id Unit',
            'content' => 'Content',
            'update_at' => 'Update At',
        ];
    }

    public function getLogUnit($id_unit){
        return self::findAll(['id_unit'=>$id_unit]);
    }

    public function getLogAll(){
        $query = (new Query())
        ->select([
            'item_unit.serial_number AS serial_number',
            'unit_log.content AS content',
            'unit_log.update_at AS log_date',
        ])
        ->from('unit_log')
        ->leftJoin('item_unit', 'unit_log.id_unit = item_unit.id_unit')
        ->all();

        return $query;
    }

    public function getLogSingle($serial_number){
        $query = (new Query())
        ->select([
            'item_unit.serial_number AS serial_number',
            'unit_log.content AS content',
            'unit_log.update_at AS log_date',
        ])
        ->from('unit_log')
        ->leftJoin('item_unit', 'unit_log.id_unit = item_unit.id_unit')
        ->where(['item_unit.serial_number'=>$serial_number])
        ->orderBy(['log_date'=> SORT_DESC])
        ->all();

        return $query;
    }
}
