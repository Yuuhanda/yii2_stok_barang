<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DocUploaded $model */

$this->title = 'Create Doc Uploaded';
$this->params['breadcrumbs'][] = ['label' => 'Doc Uploadeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-uploaded-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
