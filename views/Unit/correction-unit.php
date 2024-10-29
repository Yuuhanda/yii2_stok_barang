<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */
/** @var ActiveForm $form */
$this->title = 'Edit Unit Data';
$this->params['breadcrumbs'][] = ['label' => 'Item Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correction-unit">
<h1><?= Html::encode($this->title) ?></h1>
<p>Serial Number: <?= $model->serial_number ?></p>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id_item')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'status')->dropDownList($statslist, ['prompt' => 'Select Unit Status'])->label('Status') ?>
        <?= $form->field($model, 'condition')->dropDownList($condlist, ['prompt' => 'Select Unit Condition'])->label('Condition Name') ?>
        <!-- Dropdown for warehouses: visible wh_name but stores id_wh -->
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>
        <?= $form->field($model, 'comment') ?>
        <?= $form->field($model, 'serial_number')->hiddenInput()->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- correction-unit -->
