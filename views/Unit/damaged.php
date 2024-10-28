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
            'condition',
            'serial_number',
            'status',
            'updated_by',
            'warehouse',
            'comment',
            // Custom action buttons
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{sendrepair}', // Specify the buttons
                'header' => 'Action', 
                'buttons' => [
                'sendrepair' => function ($url, $model, $key) {
                    // Ensure we are checking the correct value, like a numeric ID or a specific status name
                    if (isset($model['status']) && $model['status'] == 'Available in warehouse') { // Adjust 'Available' based on your actual status name for status = 1
                        return Html::a('Send Unit To Repair', ['unit/send-repair', 'id_unit' => $model['id_unit']], ['class' => 'btn btn-primary']);
                    }
                    // Return nothing if the status is not 'Available'
                    return '';
                    },
                ],
            ],
        ],
    ]); ?>



</div>
