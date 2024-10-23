<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Master Inventory';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Master-Inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add New Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'item_name',
            'SKU',
            'available',
            
            // Custom action buttons
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{whdist} {detail}', // Specify the buttons
                'buttons' => [
                    'whdist' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('See Detail In Warehouse', ['item/warehouse', 'id_item' => $model['id_item']], ['class' => 'btn btn-primary']);
                    },
                    'detail' => function ($url, $model, $key) {
                        // Create the "See Item Detail" button
                        return Html::a('See Item Detail', ['item/details', 'id_item' => $model['id_item']], ['class' => 'btn btn-info']);
                    },
                ],
            ],
        ],
    ]); ?>



</div>
