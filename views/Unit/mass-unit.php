<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<h1>Upload Units in Bulk</h1>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
