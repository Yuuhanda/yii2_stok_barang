<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Lending $model */
/** @var ActiveForm $form */
/** @var array $emplist */
/** @var array $avalunit */
$this->title = 'Loan A Unit';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="loan-unit">
<h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['action' => ['lending/create']]); ?>


    
    <!-- Dropdown for available units -->
    <?= $form->field($model, 'id_unit')->widget(Select2::class, [
        'data' => ArrayHelper::map($avalunit, 'id_unit', function($unit) {
            return $unit['serial_number'] . ' (' . $unit['condition_name'] . ')';
        }),
        'options' => [
            'placeholder' => 'Select Available Unit',
            'id' => 'unit-dropdown',
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
        'bsVersion' => '5', // Set Bootstrap version to 5
    ]);  ?>

    <!-- Hidden field for type -->
    <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>

    <!-- Dropdown for employee list -->
    <?= $form->field($model, 'id_employee')->widget(Select2::class, [
        'data' => $emplist,
        'options' => ['placeholder' => 'Select Employee'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Employee') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div><!-- loan-unit -->

