<?php

namespace app\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        // Create permissions
        $manageItems = $auth->createPermission('manageItems');
        $manageItems->description = 'Manage items';
        $auth->add($manageItems);

        $viewItems = $auth->createPermission('viewItems');
        $viewItems->description = 'View items';
        $auth->add($viewItems);

        // Create roles
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewItems);

        $superadmin = $auth->createRole('superadmin');
        $auth->add($superadmin);
        $auth->addChild($superadmin, $manageItems);
        $auth->addChild($superadmin, $user);

        // Assign the superadmin role to a specific user (e.g., user with ID 1)
        $auth->assign($superadmin, 1);

        echo "RBAC successfully initialized!";
    }
}
