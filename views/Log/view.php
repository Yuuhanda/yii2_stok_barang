<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\UnitLog $model */

$this->title = $model->id_log;
$this->params['breadcrumbs'][] = ['label' => 'Unit Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="unit-log-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_log' => $model->id_log], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_log' => $model->id_log], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_log',
            'id_unit',
            'content',
            'update_at',
        ],
    ]) ?>

</div>
