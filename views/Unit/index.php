<?php

use app\models\ItemUnit;
use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\controllers\UnitController;

/** @var yii\web\View $this */
/** @var app\models\Itemearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-unit-index">

    <h1><?= Html::encode($this->title) ?></h1>


    
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
                'header' => 'Action', 
                'template' => '{addunit}', // Specify the buttons
                'buttons' => [
                    'addunit' => function ($url, $model, $key) {
                        // Create the "See Detail In Warehouse" button
                        return Html::a('Add New Unit', ['unit/add-unit', 'id_item' => $model['id_item']], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
