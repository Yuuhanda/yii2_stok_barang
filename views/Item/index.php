<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Master Inventory';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="Master-Inventory-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add New Item', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Export Data to .xlsx', ['export/export-main'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'item_name',
            'SKU',
            'available',
            'in_use',
            'in_repair',
            'lost',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{viewImage} {whdist} {detail} {edit}',
                'header' => 'Action', 
                'buttons' => [
                    'viewImage' => function ($url, $model, $key) {
                        // Eye icon button to trigger the modal for image preview
                        return Html::a(
                            '<i class="fa fa-eye">Image</i>', 
                            '#',
                            [
                                'class' => 'btn btn-secondary',
                                'title' => 'View Image',
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#imageModal',
                                'data-id' => $model['id_item'],

                            ]
                        );
                    },
                    'whdist' => function ($url, $model, $key) {
                        return Html::a('Warehouse', ['item/warehouse', 'id_item' => $model['id_item']], ['class' => 'btn btn-primary']);
                    },
                    'detail' => function ($url, $model, $key) {
                        return Html::a('Detail', ['item/details', 'id_item' => $model['id_item']], ['class' => 'btn btn-info']);
                    },
                    'edit' => function ($url, $model, $key) {
                        return Html::a('Update', ['item/update', 'id_item' => $model['id_item']], ['class' => 'btn btn-info']);
                    },
                ],
            ],
        ],
    ]); ?>

    <!-- Modal for displaying the image -->
    <?php Modal::begin([
        'id' => 'imageModal',
        'title' => '<h5>Item Image</h5>',
        'size' => Modal::SIZE_LARGE,
        'footer' => Html::button('Close', ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']),
    ]); ?>
        <div id="modalContent">Loading...</div>
    <?php Modal::end(); ?>

</div>

<?php
$this->registerJs(<<<JS
// JavaScript to load image in the modal when the button is clicked
$(document).on('click', '[data-bs-target="#imageModal"]', function() {
    var itemId = $(this).data('id');
    $.get('view-image', { id: itemId }, function(data) {
        $('#imageModal #modalContent').html(data);
    });
});
JS
, View::POS_READY);
?>
