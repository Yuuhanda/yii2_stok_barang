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
                'buttons' => [
                    'returnunit' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Return Unit', ['lending/return-unit', 'id_lending' => $model['id_lending']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>



</div>
