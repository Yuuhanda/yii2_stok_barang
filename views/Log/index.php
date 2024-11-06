<?php

use app\models\UnitLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Unit Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php 
            // Button to trigger hidden export form
            echo Html::button('Export Log Data to .xlsx', [
                'class' => 'btn btn-success',
                'onclick' => "$('#export-form').submit();"
            ]);
        ?>
    </p>

    <!-- Search Form -->
    <div class="search-form">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]); ?>

        <div class="row">
            <div class="col-md-6">    
                <?= $form->field($searchModel, 'serial_number')->textInput(['placeholder' => 'Enter serial number'])->label(false) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'content')->textInput(['placeholder' => 'Enter log content'])->label(false) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($searchModel, 'log_date_start')->input('date')->label('Log Date Start') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'log_date_end')->input('date')->label('Log Date End') ?>
            </div>
        </div>

        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <!-- Export Form with Hidden Fields -->
    <?php $exportForm = ActiveForm::begin([
        'id' => 'export-form',
        'method' => 'post',
        'action' => ['export/export-log'],
    ]); ?>

        <?= Html::hiddenInput('LogSearch[serial_number]', $searchModel->serial_number) ?>
        <?= Html::hiddenInput('LogSearch[content]', $searchModel->content) ?>
        <?= Html::hiddenInput('LogSearch[log_date_start]', $searchModel->log_date_start) ?>
        <?= Html::hiddenInput('LogSearch[log_date_end]', $searchModel->log_date_end) ?>

    <?php ActiveForm::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'serial_number',
            'content',
            [
                'attribute' => 'log_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]); ?>
</div>
