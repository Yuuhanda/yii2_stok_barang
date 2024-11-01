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
    <p>
    <?php //echo Html::a('Return Unit in Bulk', ['unit/bulk-return', 'id_item' =>Yii::$app->request->get('id_item')], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'id_unit')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'id_item')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'condition')->dropDownList($condlist, ['prompt' => 'Select Unit Condition'])->label('Condition Name') ?>
        <!-- Dropdown for warehouses: visible wh_name but stores id_wh -->
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>

        <?= $form->field($model, 'comment') ?>
        <?= $form->field($model, 'serial_number')->hiddenInput()->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Return Unit To Warehouse', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- return-unit -->
