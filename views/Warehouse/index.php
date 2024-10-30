<?php

use app\models\Warehouse;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\WarehouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Warehouses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Warehouse', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_wh',
            'wh_name',
            'wh_address',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {item-in-warehouse}', // Add custom button here
                'buttons' => [
                    'item-in-warehouse' => function ($url, $model, $key) {
                        return Html::a(
                            'Item In Warehouse',
                            ['warehouse/item', 'id_wh' => $model->id_wh], // Redirect to the warehouse/item action
                            ['class' => 'btn btn-info btn-sm'] // Optional: CSS classes for styling
                        );
                    },
                ],
                'urlCreator' => function ($action, Warehouse $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_wh' => $model->id_wh]);
                },
            ],
        ],
    ]); ?>


</div>
