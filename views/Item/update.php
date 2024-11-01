<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Item $model */

$this->title = 'Update Item: ' . $model->id_item;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_item, 'url' => ['view', 'id_item' => $model->id_item]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadModel' => $uploadModel,
    ]) ?>

</div>
