<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */

$this->title = 'Update Lending: ' . $model->id_lending;
$this->params['breadcrumbs'][] = ['label' => 'Lendings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_lending, 'url' => ['view', 'id_lending' => $model->id_lending]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lending-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
