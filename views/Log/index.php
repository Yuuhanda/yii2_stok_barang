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

$this->title = 'Unit Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Search By Serial Number To Export', ['search-log'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export All Log Data to .xlsx', ['export/export-log'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- Search Form -->
    <div class="search-form">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'], // Adjust the action to where you handle the search
        ]); ?>

        <div class="row">
        <div class="col-md-6">    
            <?= $form->field($searchModel, 'serial_number')->textInput(['placeholder' => 'Enter serial number'])->label(false) ?></div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'content')->textInput(['placeholder' => 'Enter log content'])->label(false) ?></div>
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
