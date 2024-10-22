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
            [['id_unit', 'content'], 'integer'],
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
}
