<?php

use app\models\Lending;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LendigSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Loaning List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-loan-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=  Html::a('Export Lending Data to XLSX', ['export/export-lending'], [
    'class' => 'btn btn-success',
    'target' => '_blank',  // Opens in a new tab, optional
    'data-method' => 'post',  // Send as POST request, optional for security reasons
    ]);?>
    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'serial_number',
            'employee',
            'updated_by',
            'comment',
            'date',
            // Custom action buttons
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{returnunit}', // Specify the buttons
                'header' => 'Action', 
                'buttons' => [
                    'returnunit' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Return', ['unit/return-unit', 'id_unit' => $model['id_unit']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>



</div>
