<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */
/** @var ActiveForm $form */
?>
<div class="loan-unit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_unit') ?>
        <?= $form->field($model, 'user_id') ?>
        <?= $form->field($model, 'id_employee') ?>
        <?= $form->field($model, 'type') ?>
        <?= $form->field($model, 'date') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- loan-unit -->
