<?php

use app\models\Lending;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LendingSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lendings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lending-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lending', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_lending',
            'id_unit',
            'user_id',
            'id_employee',
            'type',
            //'date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lending $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_lending' => $model->id_lending]);
                 }
            ],
        ],
    ]); ?>


</div>
