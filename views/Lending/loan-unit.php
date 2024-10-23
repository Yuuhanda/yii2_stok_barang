<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */
/** @var ActiveForm $form */
/** @var array $emplist */
/** @var array $avalunit */

?>

<div class="loan-unit">

    <?php $form = ActiveForm::begin(['action' => ['lending/create']]); ?>

    <!-- Dropdown for available units -->
    <?= $form->field($model, 'id_unit')->dropDownList(
        \yii\helpers\ArrayHelper::map($avalunit, 'id_unit', function($unit) {
            return $unit['serial_number'] . ' (' . $unit['condition_name'] . ')';
        }), 
        ['prompt' => 'Select Available Unit']
    )->label('Available Unit') ?>

    <!-- Hidden field for type -->
    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>

    <!-- Dropdown for employee list -->
    <?= $form->field($model, 'id_employee')->dropDownList($emplist, ['prompt' => 'Select Employee'])->label('Employee') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- loan-unit -->
