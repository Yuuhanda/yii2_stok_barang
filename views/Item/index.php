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
        <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)) { 
            echo Html::a('Add New Item', ['create'], ['class' => 'btn btn-success']); }?>
        <?php echo Html::a('Export Data to .xlsx', ['export/export-main'], ['class' => 'btn btn-success']);?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'item_name',
            'SKU',
            [
                'attribute' => 'available',
                'contentOptions' => ['style' => 'width: 80px; text-align: right;'], // Adjust width as needed
                'filter' => false, // Disable filter for this column
            ],
            [
                'attribute' => 'in_use',
                'contentOptions' => ['style' => 'width: 80px; text-align: right;'], // Adjust width as needed
                'filter' => false, // Disable filter for this column
            ],
            [
                'attribute' => 'in_repair',
                'contentOptions' => ['style' => 'width: 80px; text-align: right;'], // Adjust width as needed
                'filter' => false, // Disable filter for this column
            ],
            [
                'attribute' => 'lost',
                'contentOptions' => ['style' => 'width: 80px; text-align: right;'], // Adjust width as needed
                'filter' => false, // Disable filter for this column
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{viewImage} {whdist} {detail} {edit}',
                'header' => 'Action', 
                'buttons' => [
                    'viewImage' => function ($url, $model, $key) {
                        return Html::a(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                            </svg>', 
                            '#',
                            [
                                'class' => 'btn btn-secondary',
                                'title' => 'View Image',
                                'data-bs-toggle' => 'modal',
                                'data-bs-target' => '#imageModal',
                                'data-id' => $model['id_item'],
                                'style' => 'margin-top: 2px; margin-bottom: 2px;'
                            ]
                        );
                    },
                    'whdist' => function ($url, $model, $key) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                              <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"/>
                              <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z"/>
                            </svg>'
                        , ['item/warehouse', 'id_item' => $model['id_item']], [
                            'class' => 'btn btn-primary',
                            'style' => 'margin-top: 2px; margin-bottom: 2px;'
                        ]);
                    },
                    'detail' => function ($url, $model, $key) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>', 
                        ['item/details', 'id_item' => $model['id_item']], [
                            'class' => 'btn btn-info',
                            'style' => 'margin-top: 2px; margin-bottom: 2px;'
                        ]);
                    },
                    'edit' => function ($url, $model, $key) {
                        // Check if the current user is logged in and has a superadmin role of 0 or 1
                        if (!Yii::$app->user->isGuest && 
                            (Yii::$app->user->identity->superadmin == 1 || Yii::$app->user->identity->superadmin == 0)) {
                            
                            return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                </svg>', 
                                                ['item/update', 'id_item' => $model['id_item']], [
                                                'class' => 'btn btn-success',
                                                'style' => 'margin-top: 2px; margin-bottom: 2px;'
                                            ]);
                        }
                        return ''; // Return an empty string if the condition is not met
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
