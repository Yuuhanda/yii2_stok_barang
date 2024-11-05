<?php

use yii\db\Migration;

/**
 * Class m241105_035953_create_rbac_roles
 */
class m241105_035953_create_rbac_roles extends Migration
{
    public function safeUp()
    {
        // Get the Auth Manager
        $auth = Yii::$app->authManager;

        if ($auth === null) {
            throw new \Exception('AuthManager component is not configured.');
        }

        // Add 'maintenance and repair officer' role
        $repairOfficer = $auth->createRole('maintenance');
        $auth->add($repairOfficer);
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        if ($auth === null) {
            throw new \Exception('AuthManager component is not configured.');
        }

        $auth->remove('maintenance');
    }
}
