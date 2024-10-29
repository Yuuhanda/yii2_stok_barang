<?php

namespace app\controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use app\models\Item;
use app\models\ItemUnit;
use app\models\Lending;
use app\models\UnitLog;

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
        // Fetch data (for example, from a model)
        $lendingmodel = new Lending();
        $items = $lendingmodel->getLendingList();  // change it to calling getLendingList in Lending model

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
        // Fetch data 
        $itemmodel = new ItemUnit();
        $items = $itemmodel->getBrokenUnit(); 

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
        $itemmodel = new ItemUnit();
        $items = $itemmodel->getUnitRepair(); 

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
        $itemmodel = new UnitLog();
        $items = $itemmodel->getLogAll(); 

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
        $filename = 'exported_unit_inrepair_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
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
        $filename = 'exported_unit_inrepair_data_' . date('Y-m-d_H-i-s') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Send file as response for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit();
    }
}
