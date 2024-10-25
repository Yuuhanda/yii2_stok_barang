<?php

use app\models\UnitLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Damaged Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-log-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'serial_number',
            'status',
            'updated_by',
            'warehouse',
            'comment',
            // Custom action buttons
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{sendrepair}', // Specify the buttons
                'buttons' => [
                    'sendrepair' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Send Unit To Repair', ['unit/send-repair', 'id_unit' => $model['id_unit']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>



</div>
