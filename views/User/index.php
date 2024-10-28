<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'confirmation_token',
            'status',
            'superadmin',
            //'created_at',
            //'updated_at',
            //'registration_ip',
            //'bind_to_ip',
            //'email:email',
            //'email_confirmed:email',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {toggle-status}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-eye"></i> View', $url, [
                            'title' => Yii::t('app', 'View'),
                            'class' => 'btn btn-primary btn-sm', // Add btn-sm for smaller buttons
                            'aria-label' => Yii::t('app', 'View'),
                            'data-pjax' => '0', // Disable Pjax if necessary
                        ]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<i class="fas fa-edit"></i> Edit', $url, [
                            'title' => Yii::t('app', 'Edit'),
                            'class' => 'btn btn-warning btn-sm', // Add btn-sm for smaller buttons
                            'aria-label' => Yii::t('app', 'Edit'),
                            'data-pjax' => '0', // Disable Pjax if necessary
                        ]);
                    },
                    'toggle-status' => function ($url, $model, $key) {
                        if ($model->status == 0) {
                            return Html::a('<i class="fas fa-check"></i> Activate', $url, [
                                'title' => Yii::t('app', 'Activate'),
                                'class' => 'btn btn-success btn-sm',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to activate this user?'),
                                'data-method' => 'post',
                            ]);
                        } elseif ($model->status == 1) {
                            return Html::a('<i class="fas fa-ban"></i> Deactivate', $url, [
                                'title' => Yii::t('app', 'Deactivate'),
                                'class' => 'btn btn-danger btn-sm',
                                'data-confirm' => Yii::t('app', 'Are you sure you want to deactivate this user?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    if ($action === 'toggle-status') {
                        return Url::toRoute(['toggle-status', 'id' => $model->id]);
                    }
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
            
            
        ],
    ]); ?>


</div>
