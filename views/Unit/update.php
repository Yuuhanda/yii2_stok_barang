<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */

$this->title = 'Update Item Unit: ' . $model->id_unit;
$this->params['breadcrumbs'][] = ['label' => 'Item Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_unit, 'url' => ['view', 'id_unit' => $model->id_unit]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
