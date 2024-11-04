<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DocUploaded $model */

$this->title = $model->id_doc;
$this->params['breadcrumbs'][] = ['label' => 'Doc Uploadeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="doc-uploaded-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_doc' => $model->id_doc], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_doc' => $model->id_doc], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_doc',
            'file_name',
            'datetime',
            'user_id',
        ],
    ]) ?>

</div>
