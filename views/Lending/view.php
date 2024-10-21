<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */

$this->title = $model->id_lending;
$this->params['breadcrumbs'][] = ['label' => 'Lendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lending-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_lending' => $model->id_lending], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_lending' => $model->id_lending], [
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
            'id_lending',
            'id_unit',
            'user_id',
            'id_employee',
            'type',
            'date',
        ],
    ]) ?>

</div>
