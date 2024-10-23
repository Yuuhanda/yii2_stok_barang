<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */
/** @var app\models\Warehouse $warehouse */
/** @var ActiveForm $form */
?>
<div class="return-unit">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_unit')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'id_employee')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'date') ?>
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- return-unit -->
