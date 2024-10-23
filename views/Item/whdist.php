<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Detail In Warehouse';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-whdist">

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
            
            'warehouse',
            'available',
            'in_use',
            'in_repair',
            'lost',
            
        ],
    ]); ?>



</div>
