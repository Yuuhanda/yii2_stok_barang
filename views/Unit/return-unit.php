<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */
/** @var ActiveForm $form */

$this->title = 'Return Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="return-unit">
<h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['action' => ['unit/update-return','id_unit'=>$model->id_unit]]); ?>
        <?= $form->field($model, 'id_unit')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'id_item')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'condition')->dropDownList($condlist, ['prompt' => 'Select Unit Condition'])->label('Condition Name') ?>

        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <!-- Dropdown for warehouses: visible wh_name but stores id_wh -->
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>

        <?= $form->field($model, 'comment') ?>
        <?= $form->field($model, 'serial_number')->hiddenInput()->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- return-unit -->
