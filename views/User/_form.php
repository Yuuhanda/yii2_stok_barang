<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <!-- Password Field -->
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true])->label('Password') ?>

    <!-- Admin Level Dropdown -->
    <?= $form->field($model, 'superadmin')->dropDownList(
        [0 => 'Admin', 1 => 'Super Admin', 2=>'Maintenance & Repair Officer'],  // Dropdown options
        ['prompt' => 'Select Admin Level']   // Optional prompt
    )->label('Admin Level') ?>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
