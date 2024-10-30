<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "Item In Warehouse $warehouse_name";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Master-Inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p><?= Html::a('Export Data to .xlsx', ['export/warehouse' ,'id_wh' =>Yii::$app->request->get('id_wh')], ['class' => 'btn btn-info']) ?></p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'item_name',
            'SKU',
            'available',
            'in_use',
            'in_repair',
            'lost',
            

        ],
    ]); ?>



</div>
