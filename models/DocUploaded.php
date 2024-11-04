<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "doc_uploaded".
 *
 * @property int $id_doc
 * @property string $file_name
 * @property string $datetime
 * @property int $user_id
 *
 * @property User $user
 */
class DocUploaded extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_uploaded';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'datetime', 'user_id'], 'required'],
            [['datetime'], 'safe'],
            [['user_id'], 'integer'],
            [['file_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_doc' => 'Id Doc',
            'file_name' => 'File Name',
            'datetime' => 'Datetime',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
