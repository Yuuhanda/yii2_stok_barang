<?php

use app\models\DocUploaded;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\DocSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Documents Uploaded';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-uploaded-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_doc',
            'file_name',
            'datetime',
            'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DocUploaded $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_doc' => $model->id_doc]);
                 }
            ],
        ],
    ]); ?>


</div>
