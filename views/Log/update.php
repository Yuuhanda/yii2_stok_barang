<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UnitLog $model */

$this->title = 'Update Unit Log: ' . $model->id_log;
$this->params['breadcrumbs'][] = ['label' => 'Unit Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_log, 'url' => ['view', 'id_log' => $model->id_log]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
