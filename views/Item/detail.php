<?php

use app\models\Item;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\UnitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Item Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-detail">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Export to .xlsx', ['export/item-detail', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'condition',
                'filter' => Html::beginTag('div', ['class' => 'dropdown']) .
                            Html::button('Select condition', [
                                'class' => 'btn btn-secondary dropdown-toggle',
                                'type' => 'button',
                                'id' => 'dropdownCondition',
                                'data-bs-toggle' => 'dropdown',
                                'aria-expanded' => 'false',
                            ]) .
                            Html::beginTag('ul', ['class' => 'dropdown-menu', 'aria-labelledby' => 'dropdownCondition']) .
                                Html::tag('li', Html::a('OK', ['details', 'UnitSearch[condition]' => 'OK', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('Lightly damaged', ['details', 'UnitSearch[condition]' => 'Lightly damaged', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('Moderately damaged', ['details', 'UnitSearch[condition]' => 'Moderately damaged', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('Major damage', ['details', 'UnitSearch[condition]' => 'Major damage', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('Total loss', ['details', 'UnitSearch[condition]' => 'Total loss', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                            Html::endTag('ul') .
                            Html::endTag('div'),
            ],
            'serial_number',
            'id_unit',

            [
                'attribute' => 'status',
                'filter' => Html::beginTag('div', ['class' => 'dropdown']) .
                            Html::button('Select status', [
                                'class' => 'btn btn-secondary dropdown-toggle',
                                'type' => 'button',
                                'id' => 'dropdownStatus',
                                'data-bs-toggle' => 'dropdown',
                                'aria-expanded' => 'false',
                            ]) .
                            Html::beginTag('ul', ['class' => 'dropdown-menu', 'aria-labelledby' => 'dropdownStatus']) .
                                Html::tag('li', Html::a('Available in warehouse', ['details', 'UnitSearch[status]' => 'Available in warehouse', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('Borrowed/lent', ['details', 'UnitSearch[status]' => 'Borrowed/lent', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('in-repair', ['details', 'UnitSearch[status]' => 'in-repair', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                                Html::tag('li', Html::a('totalled or lost', ['details', 'UnitSearch[status]' => 'totalled or lost', 'id_item' => Yii::$app->request->get('id_item')], ['class' => 'dropdown-item'])) .
                            Html::endTag('ul') .
                            Html::endTag('div'),
            ],
    

            'updated_by',
            'warehouse',
            'employee',

            'comment',
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Edit',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                          <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                        </svg>', 
                        ['unit/correction-unit', 'serial_number' => $model['serial_number']], [
                        'class' => 'btn btn-success',
                        'style' => 'margin-top: 2px; margin-bottom: 2px;'
                    ]);
                },
            ],
        ],
    ]); ?>
</div>
