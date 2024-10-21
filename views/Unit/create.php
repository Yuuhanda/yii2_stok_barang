<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */

$this->title = 'Create Item Unit';
$this->params['breadcrumbs'][] = ['label' => 'Item Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
