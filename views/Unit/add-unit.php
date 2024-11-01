<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ItemUnit $model */
/** @var ActiveForm $form */
$this->title = 'Add New Unit of Item';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="add-unit">
<h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Add Unit in Bulk', ['unit/bulk-add', 'id_item' =>Yii::$app->request->get('id_item')], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'id_item')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'condition')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <!-- Dropdown for warehouses: visible wh_name but stores id_wh -->
        <?= $form->field($model, 'id_wh')->dropDownList($whList, ['prompt' => 'Select Warehouse'])->label('Warehouse Name') ?>

        <?= $form->field($model, 'comment') ?>
        <?= $form->field($model, 'serial_number') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- add-unit -->
