<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Unit in Bulk';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="add-unit">
<h1><?= Html::encode($this->title) ?></h1>

<!-- Download Template Button -->
<p>
    <?= Html::a('Download Template', Yii::getAlias('@web') . '/templates/add-unit-template.xlsx', [
        'class' => 'btn btn-primary',
        'target' => '_blank', // Opens in a new tab
        'download' => 'add-unit-template.xlsx', // Initiates download
    ]) ?>
</p>

<!-- Upload Form -->
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

<?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
</div>