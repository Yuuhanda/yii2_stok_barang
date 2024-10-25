<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */
/** @var ActiveForm $form */
?>
<div class="finish-repair">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_item')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'condition')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'id_wh')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'condition')->dropDownList($condlist, ['prompt' => 'Select Unit Condition'])->label('Condition Name') ?>
        <!-- Dropdown for warehouses: visible wh_name but stores id_wh -->
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>
        <?= $form->field($model, 'comment') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- finish-repair -->
