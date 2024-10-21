<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Warehouse $model */

$this->title = 'Update Warehouse: ' . $model->id_wh;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_wh, 'url' => ['view', 'id_wh' => $model->id_wh]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
