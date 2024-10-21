<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UnitLog $model */

$this->title = 'Create Unit Log';
$this->params['breadcrumbs'][] = ['label' => 'Unit Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
