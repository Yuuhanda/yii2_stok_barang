<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DocUploaded $model */

$this->title = 'Update Doc Uploaded: ' . $model->id_doc;
$this->params['breadcrumbs'][] = ['label' => 'Doc Uploadeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_doc, 'url' => ['view', 'id_doc' => $model->id_doc]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doc-uploaded-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
