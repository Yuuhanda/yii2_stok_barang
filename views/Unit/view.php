<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */

$this->title = $model->id_unit;
$this->params['breadcrumbs'][] = ['label' => 'Item Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="item-unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_unit' => $model->id_unit], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_unit' => $model->id_unit], [
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
            'id_unit',
            'id_item',
            'status',
            'id_wh',
            'comment',
            'serial_number',
            'condition',
            'updated_by',
        ],
    ]) ?>

</div>
