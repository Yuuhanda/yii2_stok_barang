<?php

use app\models\UnitLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Unit In-Repair';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-repair-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
            'condition',
            'serial_number',
            'status',
            'updated_by',
            'comment',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action', 
                'template' => '{repairdone}', // Specify the buttons
                'buttons' => [
                    'repairdone' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Finish Repair', ['unit/finish-repair', 'id_unit' => $model['id_unit']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php $exportForm = ActiveForm::begin([
        'id' => 'export-form',
        'method' => 'post',
        'action' => ['export/export-repair'],
    ]); ?>

        <?= Html::hiddenInput('DamagedSearch[condition]', $searchModel->condition) ?>
        <?= Html::hiddenInput('DamagedSearch[serial_number]', $searchModel->serial_number) ?>
        <?= Html::hiddenInput('DamagedSearch[status]', $searchModel->status) ?>
        <?= Html::hiddenInput('DamagedSearch[updated_by]', $searchModel->updated_by) ?>
        <?= Html::hiddenInput('DamagedSearch[comment]', $searchModel->comment) ?>

    <?php ActiveForm::end(); ?>


</div>
