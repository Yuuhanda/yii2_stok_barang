<?php

use app\models\UnitLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Loaning List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-loan-list">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'item_name',
            'SKU',
            'available_unit',
            // Custom action buttons
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{loanunit}', // Specify the buttons
                'header' => 'Action', 
                'buttons' => [
                    'loanunit' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Loan A Unit', ['lending/loan-unit', 'id_item' => $model['id_item']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>



</div>
