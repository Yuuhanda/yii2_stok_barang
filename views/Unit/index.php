<?php

use app\models\ItemUnit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Units';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-unit-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item Unit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_unit',
            'id_item',
            'status',
            'id_wh',
            'comment',
            //'serial_number',
            //'condition',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ItemUnit $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_unit' => $model->id_unit]);
                 }
            ],
        ],
    ]); ?>


</div>
