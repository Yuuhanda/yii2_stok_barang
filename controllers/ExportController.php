<?php

namespace app\controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\models\Item;
use app\models\ItemUnit;
use app\models\Lending;
use app\models\UnitLog;
use Yii;
use app\models\ItemSearch;
use app\models\Warehouse;
use app\models\LogSearch;
use app\models\UnitSearch;
use app\models\LendingSearch;
use app\models\DamagedSearch;
class ExportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionExportXlsx()
    {
        // Fetch data (for example, from a model)
        $items = Item::find()->all();  // Adjust as per your model

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Status');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->name);
            $sheet->setCellValue('C' . $row, $item->status);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }

    public function actionExportLending()
    {
        $searchModel = new LendingSearch();

        //filter params
        $params = Yii::$app->request->post();

        // Load parameters directly into the search model to ensure they apply
        if (!$searchModel->load($params) || !$searchModel->validate()) {
            // If params do not load or validate, handle it (e.g., return all data or show an error)
            Yii::$app->session->setFlash('error', 'Invalid search parameters for export.');
            return $this->redirect(['lending/list']);
        }
        //echo var_dump($params);
        //exit();
        // Get the data provider with params applied
        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination = false; // Disable pagination for export

        $items = $dataProvider->getModels(); // Retrieve data with filters applied
        
        // Fetch data (for example, from a model)
        //$lendingmodel = new Lending();
        //$items = $lendingmodel->getLendingList();  // change it to calling getLendingList in Lending model

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'serial_number');
        $sheet->setCellValue('B1', 'employee');
        $sheet->setCellValue('C1', 'updated_by');
        $sheet->setCellValue('D1', 'comment');
        $sheet->setCellValue('E1', 'date');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['serial_number']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['employee']);
            $sheet->setCellValue('C' . $row, $item['updated_by']);
            $sheet->setCellValue('D' . $row, $item['comment']);
            $sheet->setCellValue('E' . $row, $item['date']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_lending_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }

    public function actionExportDamaged()
    {
        $unitModel = new ItemUnit();
        $damagedlist = $unitModel->getBrokenUnit();

        //filter params
         $params = Yii::$app->request->post();   
        // Initialize search model

        $searchModel = new DamagedSearch();
        
        // Load parameters directly into the search model to ensure they apply
        if (!$searchModel->load($params) || !$searchModel->validate()) {
            // If params do not load or validate, handle it (e.g., return all data or show an error)
            Yii::$app->session->setFlash('error', 'Invalid search parameters for export.');
            return $this->redirect(['unit/damaged']);
        }
        // Filter the data based on search input
        $dataProvider = $searchModel->search($params, $damagedlist);
        $dataProvider->pagination = false; // Disable pagination for export

        $items =  $dataProvider->getModels(); // Retrieve data with filters applied

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'condition');
        $sheet->setCellValue('B1', 'serial_number');
        $sheet->setCellValue('C1', 'status');
        $sheet->setCellValue('D1', 'warehouse');
        $sheet->setCellValue('E1', 'comment');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['condition']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['serial_number']);
            $sheet->setCellValue('C' . $row, $item['status']);
            $sheet->setCellValue('D' . $row, $item['warehouse']);
            $sheet->setCellValue('E' . $row, $item['comment']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_damaged_unit_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
            
    }

    public function actionExportRepair()
    {
        $searchModel = new DamagedSearch();
        
        $params = Yii::$app->request->post();

        // Load parameters directly into the search model to ensure they apply
        if (!$searchModel->load($params) || !$searchModel->validate()) {
            // If params do not load or validate, handle it (e.g., return all data or show an error)
            Yii::$app->session->setFlash('error', 'Invalid search parameters for export.');
            return $this->redirect(['unit/repair']);
        }
        //echo var_dump($params);
        //exit();
        // Get the data provider with params applied
        $dataProvider = $searchModel->searchRepair($params);
        $dataProvider->pagination = false; // Disable pagination for export

        $items = $dataProvider->getModels(); 

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'condition');
        $sheet->setCellValue('B1', 'serial_number');
        $sheet->setCellValue('C1', 'status');
        $sheet->setCellValue('D1', 'updated_by');
        $sheet->setCellValue('E1', 'comment');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['condition']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['serial_number']);
            $sheet->setCellValue('C' . $row, $item['status']);
            $sheet->setCellValue('D' . $row, $item['updated_by']);
            $sheet->setCellValue('E' . $row, $item['comment']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_unit_inrepair_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }

    public function actionExportLog()
    {
        $searchModel = new LogSearch();
        
        // Load parameters from POST
        $params = Yii::$app->request->post();
    
        // Load parameters directly into the search model to ensure they apply
        if (!$searchModel->load($params) || !$searchModel->validate()) {
            // If params do not load or validate, handle it (e.g., return all data or show an error)
            Yii::$app->session->setFlash('error', 'Invalid search parameters for export.');
            return $this->redirect(['log/index']);
        }
    
        // Get the data provider with params applied
        $dataProvider = $searchModel->search($params);
        $dataProvider->pagination = false; // Disable pagination for export
    
        $items = $dataProvider->getModels(); // Retrieve data with filters applied
    
        // Create Spreadsheet object and export logic (same as before)
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set headers
        $sheet->setCellValue('A1', 'serial_number');
        $sheet->setCellValue('B1', 'content');
        $sheet->setCellValue('C1', 'log_date');
    
        // Populate data
        $row = 2;
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['serial_number']);
            $sheet->setCellValue('B' . $row, $item['content']);
            $sheet->setCellValue('C' . $row, $item['log_date']);
            $row++;
        }
    
        // Set filename and export
        $filename = 'exported_log_all_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }
    
    

    public function actionExportLogSingle($serial_number)
    {
        $itemmodel = new UnitLog();
        $items = $itemmodel->getLogSingle($serial_number); 

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'serial_number');
        $sheet->setCellValue('B1', 'content');
        $sheet->setCellValue('C1', 'log_date');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['serial_number']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['content']);
            $sheet->setCellValue('C' . $row, $item['log_date']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_log'.$serial_number.'_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }

    public function actionExportMain(){
        $itemmodel = new Item();
        $items = $itemmodel->getDashboard(); 

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'item_name');
        $sheet->setCellValue('B1', 'SKU');
        $sheet->setCellValue('C1', 'available');
        $sheet->setCellValue('D1', 'in_use');
        $sheet->setCellValue('E1', 'in_repair');
        $sheet->setCellValue('F1', 'lost');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['item_name']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['SKU']);
            $sheet->setCellValue('C' . $row, $item['available']);
            $sheet->setCellValue('D' . $row, $item['in_use']);
            $sheet->setCellValue('E' . $row, $item['in_repair']);
            $sheet->setCellValue('F' . $row, $item['lost']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_master_inventory_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }

    public function actionItemDetail($id_item){
        $searchModel = new UnitSearch();

        //params filter
        $params = Yii::$app->request->post();

        // Load parameters directly into the search model to ensure they apply
        //if (!$searchModel->load($params) || !$searchModel->validate()) {
        //    // If params do not load or validate, handle it (e.g., return all data or show an error)
        //    Yii::$app->session->setFlash('error', 'Invalid search parameters for export.');
        //    return $this->redirect(['item/details?id_item='.$id_item]);
        //}

        
        // Get the data provider with params applied
        $dataProvider = $searchModel->search($params, $id_item);
        $dataProvider->pagination = false; // Disable pagination for export

        $items = $dataProvider->getModels(); 

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'condition');
        $sheet->setCellValue('B1', 'serial_number');
        $sheet->setCellValue('C1', 'id_unit');
        $sheet->setCellValue('D1', 'status');
        $sheet->setCellValue('E1', 'updated_by');
        $sheet->setCellValue('F1', 'warehouse');
        $sheet->setCellValue('G1', 'employee');
        $sheet->setCellValue('H1', 'comment');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['condition']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['serial_number']);
            $sheet->setCellValue('C' . $row, $item['id_unit']);
            $sheet->setCellValue('D' . $row, $item['status']);
            $sheet->setCellValue('E' . $row, $item['updated_by']);
            $sheet->setCellValue('F' . $row, $item['warehouse']);
            $sheet->setCellValue('G' . $row, $item['employee']);
            $sheet->setCellValue('H' . $row, $item['comment']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_master_inventory_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }


    public function actionWarehouse($id_wh){
        $model = new Warehouse();
        $items = $model->getExport($id_wh);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'item_name');
        $sheet->setCellValue('B1', 'SKU');
        $sheet->setCellValue('C1', 'available');
        $sheet->setCellValue('D1', 'in_use');
        $sheet->setCellValue('E1', 'in_repair');
        $sheet->setCellValue('F1', 'lost');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['item_name']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['SKU']);
            $sheet->setCellValue('C' . $row, $item['available']);
            $sheet->setCellValue('D' . $row, $item['in_use']);
            $sheet->setCellValue('E' . $row, $item['in_repair']);
            $sheet->setCellValue('F' . $row, $item['lost']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_warehouse_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }
    
    //item detail in warehouse export
    public function actionWhDist($id_item){
        $model = new ItemUnit();
        $items = $model->getWhDistribution($id_item);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'warehouse');
        $sheet->setCellValue('B1', 'available');
        $sheet->setCellValue('C1', 'in_use');
        $sheet->setCellValue('D1', 'in_repair');
        $sheet->setCellValue('E1', 'lost');

        // Populate data
        $row = 2;  // Row starts after the headers
        foreach ($items as $item) {
            $sheet->setCellValue('A' . $row, $item['warehouse']);  // Access array keys instead of object properties
            $sheet->setCellValue('B' . $row, $item['available']);
            $sheet->setCellValue('C' . $row, $item['in_use']);
            $sheet->setCellValue('D' . $row, $item['in_repair']);
            $sheet->setCellValue('E' . $row, $item['lost']);
            $row++;
        }

        // Set filename and export
        $filename = 'exported_item_in_warehouses_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }
}
