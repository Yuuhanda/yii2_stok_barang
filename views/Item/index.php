<?php
namespace app\models;

use app\models\Item;
use app\controllers\ItemController;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\jui\JuiAsset;
use yii\db\ActiveRecord;
use yii\web\View;
use yii\web\JqueryAsset;

/** @var yii\web\View $this */
/** @var app\models\ItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
JuiAsset::register($this);
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    $this->registerCssFile('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
    $this->registerJsFile('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', ['depends' => [JqueryAsset::class]]);

    ?>

<!-- HTML Table -->
<table id="item-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>SKU</th>
            <th>Available</th>
            <th>In Use</th>
            <th>In Repair</th>
            <th>Lost</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<?php
// JavaScript for initializing DataTables
$this->registerJs(<<<JS
    $(document).ready(function() {
        $('#item-table').DataTable({
            'processing': true,  // Show a processing indicator
            'serverSide': false, // Since we are returning all data at once, set this to false
            'ajax': {
                'url': '/item/dashboard-data', // URL of the controller action
                'type': 'GET',
                'dataSrc': 'data', // DataTables expects data in 'data' key of the response
            },
            'columns': [
                { 'data': 'item_name' },
                { 'data': 'SKU' },
                { 'data': 'available' },
                { 'data': 'in_use' },
                { 'data': 'in_repair' },
                { 'data': 'lost' },
                {
                    "data": null, // This column does not need data from the model
                    "title": "Actions",
                    "render": function (data, type, row) {
                        // Assuming you want to use row ID for each button
                        return '<button class="btn btn-info btn-sm" onclick="viewDetails(' + row.id_item + ')">Details</button>'
                             + '<button class="btn btn-warning btn-sm" style="margin-left: 5px;" onclick="viewWarehouse(' + row.id_item + ')">See Items In Warehouse</button>';
                    }
                }
            ]
        });
    });
JS
, View::POS_READY);
?>

</div>
