<?php

use app\models\UnitLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Unit In-Repair';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-repair-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?=  Html::a('Export Unit In-repair Data to XLSX', ['export/export-repair'], [
    'class' => 'btn btn-success',
    'target' => '_blank',  // Opens in a new tab, optional
    'data-method' => 'post',  // Send as POST request, optional for security reasons
    ]);?>
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



</div>
