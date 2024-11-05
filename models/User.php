<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;


class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'superadmin'], 'integer'],
            [['created_at', 'updated_at'], 'safe'], 
            [['username', 'password_hash',], 'string', 'max' => 255],
            [['registration_ip'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
            'superadmin' => 'Superadmin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'registration_ip' => 'Registration Ip',
            'email' => 'Email',
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsSuperAdmin()
    {
        return $this->superadmin == 1; // Returns true if the user is a superadmin
    }
    
    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ItemNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Lendings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLendings()
    {
        return $this->hasMany(Lending::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserVisitLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitLogs()
    {
        return $this->hasMany(UserVisitLog::class, ['user_id' => 'id']);
    }

    public function validatePassword($password)
    {
        // Compare the provided password with the hashed password
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public function userList()
    {
    $query = (new Query())
        ->select('username, status, superadmin, id')  // Select all columns
        ->from('user');  // From the employee table

    $command = $query->createCommand();
    $results = $command->queryAll();  // Fetch all rows
    return $results;  
    }



    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token'=>$token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */


    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public static function getUpdatedByList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'username'); // assuming 'id' and 'username' columns
    }
}


