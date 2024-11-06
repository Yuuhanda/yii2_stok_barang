<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-detail">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            // Button to trigger hidden export form
            echo Html::button('Export Data to .xlsx', [
                'class' => 'btn btn-success',
                'onclick' => "$('#export-form').submit();"
            ]);
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'condition',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'condition',
                    'data' => $conditionList, 
                    'options' => ['placeholder' => 'Select Unit Condition'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            'serial_number',
            'id_unit',

            [
            'attribute' => 'status',
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'status',
                'data' => $statusList, 
                'options' => ['placeholder' => 'Select Status'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],
    

            // Updated by field with Select2
        [
            'attribute' => 'updated_by',
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'updated_by',
                'data' => $updatedByList, // Assume $updatedByList contains a list of users
                'options' => ['placeholder' => 'Select Updated By'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],

        // Warehouse field with Select2
        [
            'attribute' => 'warehouse',
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'warehouse',
                'data' => $warehouseList, // Assume $warehouseList contains a list of warehouses
                'options' => ['placeholder' => 'Select Warehouse'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],

        // Employee field with Select2
        [
            'attribute' => 'employee',
            'filter' => Select2::widget([
                'model' => $searchModel,
                'attribute' => 'employee',
                'data' => $employeeList, // Assume $employeeList contains a list of employees
                'options' => ['placeholder' => 'Select Employee'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]),
        ],

            'comment',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Edit',
                'format' => 'raw',
                'value' => function ($model) {
                    // Check if the user is logged in and has superadmin role of 0 or 1
                    if (!Yii::$app->user->isGuest && 
                        (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)) {
                        
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                        </svg>', 
                                        ['unit/correction-unit', 'serial_number' => $model['serial_number']], [
                                        'class' => 'btn btn-success',
                                        'style' => 'margin-top: 2px; margin-bottom: 2px;'
                                    ]);
                    }
                    return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>'); 
                },
            ],
            
        ],
    ]); ?>

    <?php $exportForm = ActiveForm::begin([
        'id' => 'export-form',
        'method' => 'post',
        'action' => ['export/item-detail', 'id_item' => Yii::$app->request->get('id_item')],
    ]); ?>

        <?= Html::hiddenInput('UnitSearch[condition]', $searchModel->condition) ?>
        <?= Html::hiddenInput('UnitSearch[serial_number]', $searchModel->serial_number) ?>
        <?= Html::hiddenInput('UnitSearch[status]', $searchModel->status) ?>
        <?= Html::hiddenInput('UnitSearch[updated_by]', $searchModel->updated_by) ?>
        <?= Html::hiddenInput('UnitSearch[warehouse]', $searchModel->warehouse) ?>
        <?= Html::hiddenInput('UnitSearch[employee]', $searchModel->employee) ?>
        <?= Html::hiddenInput('UnitSearch[comment]', $searchModel->comment) ?>

    <?php ActiveForm::end(); ?>
</div>
