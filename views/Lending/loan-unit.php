<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <!-- Search input for available units -->
    <div class="form-group">
        <?= Html::label('Search Available Unit', 'search-unit', ['class' => 'control-label']) ?>
        <?= Html::textInput('search-unit', '', ['id' => 'search-unit', 'class' => 'form-control', 'placeholder' => 'Search available unit...']) ?>
    </div>
    
    <!-- Dropdown for available units -->
    <?= $form->field($model, 'id_unit')->dropDownList(
        \yii\helpers\ArrayHelper::map($avalunit, 'id_unit', function($unit) {
            return $unit['serial_number'] . ' (' . $unit['condition_name'] . ')';
        }), 
        ['prompt' => 'Select Available Unit', 'id' => 'unit-dropdown']
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
<?php
$script = <<< JS
    $('#search-unit').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();
        $('#unit-dropdown option').each(function() {
            var optionText = $(this).text().toLowerCase();
            if (optionText.indexOf(searchValue) > -1 || searchValue == '') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
JS;
$this->registerJs($script);
?>
