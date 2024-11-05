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
        <?= Html::a('Export Log to .xlsx', ['export/export-log-single', 'serial_number' =>Yii::$app->request->get('serial_number')], ['class' => 'btn btn-success']) ?>
    </p>
        <!-- Search Form -->
        <div class="search-form">
        <?php //$form = ActiveForm::begin(['method' => 'get', 'action' => ['index'], ]); ?>
  
            <?php // echo $form->field($searchModel, 'serial_number')->textInput(['placeholder' => 'Enter serial number'])->label(false)->hiddenInput() ?>
        <div class="row">
            <div class="col-md-6">
                <?php // echo $form->field($searchModel, 'log_date_start')->input('date')->label('Log Date Start') ?>
            </div>
            <div class="col-md-6">
                <?php // echo $form->field($searchModel, 'log_date_end')->input('date')->label('Log Date End') ?>
            </div>
        </div>


        <?php // echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

        <?php // echo ActiveForm::end(); ?>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
