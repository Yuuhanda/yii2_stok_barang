<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LendingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lending-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_lending') ?>

    <?= $form->field($model, 'id_unit') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'id_employee') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
