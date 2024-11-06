<?php

use app\models\Lending;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LendigSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Loaning List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-loan-list">

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
            'serial_number',
            'employee',
            'updated_by',
            'comment',
            [
                'attribute' => 'date',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd', // Adjust to your preferred format
                    ],
                ]),
                'format' => 'date', // Format the date in the grid
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{returnunit}',
                'header' => 'Action',
                'buttons' => [
                    'returnunit' => function ($url, $model, $key) {
                        return Html::a('Return', ['unit/return-unit', 'id_unit' => $model['id_unit']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>

    <?php $exportForm = ActiveForm::begin([
        'id' => 'export-form',
        'method' => 'post',
        'action' => ['export/export-lending'],
    ]); ?>

        <?= Html::hiddenInput('LendingSearch[serial_number]', $searchModel->serial_number) ?>
        <?= Html::hiddenInput('LendingSearch[updated_by]', $searchModel->updated_by) ?>
        <?= Html::hiddenInput('LendingSearch[employee]', $searchModel->employee) ?>
        <?= Html::hiddenInput('LendingSearch[comment]', $searchModel->comment) ?>
        <?= Html::hiddenInput('LendingSearch[date]', $searchModel->date) ?>

    <?php ActiveForm::end(); ?>

</div>
