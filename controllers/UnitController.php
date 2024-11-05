<?php

namespace app\controllers;

use app\models\ItemUnit;
use app\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use app\models\Item;
use yii\data\ArrayDataProvider;
use app\models\ItemSearch;
use app\models\Warehouse;
use app\models\Lending;
use yii\web\HttpException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\DamagedSearch;
use app\models\UploadForm;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\web\UploadedFile;
use app\models\DocUploaded;
/**
 * UnitController implements the CRUD actions for ItemUnit model.
 */
class UnitController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['*'], // restrict access to all actions
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['superadmin'], // allow authenticated users (logged in)
                        ],
                        [
                            'allow' => false,
                            'actions' => ['repair', 'unit-repair', 'finish-repair', 'get-broken-unit'],
                            'roles' => ['Admin'], // deny guests
                        ],
                        [
                            'allow' => true,
                            'roles' => ['Admin'], // deny guests
                        ],
                        [
                            'allow' => true,
                            'actions' => ['repair', 'damaged', 'send-repair', 'unit-repair', 'finish-repair', 'get-broken-unit'],
                            'roles' => ['maintenance'], // deny guests
                        ],
                        [
                            'allow' => false,
                            'roles' => ['?'], // deny guests
                        ],
                    ],
                ],
            ]
        );
    }


    /**
     * Lists all ItemUnit models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemUnit model.
     * @param int $id_unit Id Unit
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_unit)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_unit),
        ]);
    }

    	   /**
    * Creates a new ItemUnit model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return string|\yii\web\Response
    */
   public function actionCreate()
   {
       $model = new ItemUnit();
       if ($this->request->isPost) {
           if ($model->load($this->request->post()) && $model->save()) {
               return $this->redirect(['view', 'id_unit' => $model->id_unit]);
           }
       } else {
           $model->loadDefaultValues();
       }
       return $this->render('create', [
           'model' => $model,
       ]);
   }

   public function actionDamaged()
   {
       $unitModel = new ItemUnit();
       $damagedlist = $unitModel->getBrokenUnit();
   
       // Initialize search model
       $searchModel = new DamagedSearch();
   
       // Filter the data based on search input
       $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $damagedlist);
   
       return $this->render('damaged', [
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider,
       ]);
   }
   

   public function actionRepair(){
        $searchModel = new DamagedSearch();
        
        // Load the query parameters and filter accordingly
        $dataProvider = $searchModel->searchRepair(Yii::$app->request->queryParams);
    
        return $this->render('repair', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAddUnit($id_item)
    {
        $model = new \app\models\ItemUnit();
        
        // Set the $id_item in the model
        $model->id_item = $id_item;
        $model->condition = 1;  // Default value for 'condition'
        $model->status = 1;     // Default value for 'status'

        $warehouses = Warehouse::find()->all();

        // Prepare warehouse data as [id_wh => wh_name] for the dropdown
        $whList = \yii\helpers\ArrayHelper::map($warehouses, 'id_wh', 'wh_name');
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->serial_number == NULL) {
                    $item = Item::findOne($model->id_item);
                    if ($model->id_wh == NULL) {
                        Yii::$app->session->setFlash('error', 'Warehouse not allowed to be null for new unit.');
                        return $this->redirect("add-unit?id_item=$id_item");
                    }
                    if ($model->comment==NULL){
                        $model->comment = 'New Unit';
                    }
                    if ($item !== null && !empty($item->SKU)) {
                        // Get the first 3 characters of the SKU
                        $skuPrefix = substr($item->SKU, 0, 4);
                        
                        // Combine the SKU prefix and the random number to create the serial number
                        $model->serial_number = $row['B'] ?? $this->generateUniqueSerialNumber($skuPrefix);
                    } else {
                        throw new \yii\web\NotFoundHttpException("Item not found or SKU is empty.");
                    }
                }
                $user = Yii::$app->user->identity;
                $model->updated_by = $user->id;
            if ($model->save()){
                Yii::$app->session->setFlash('success', 'Unit Added successfully.');
                return $this->redirect(['index']);
            }
            }
        }
    
        return $this->render('add-unit', [
            'model' => $model,
            'whList' => $whList,
        ]);
    }
    

    public function actionReturnUnit($id_unit)  
    {
        $model = $this->findModel($id_unit);
        if (!$model) {
            throw new NotFoundHttpException('The requested ItemUnit does not exist.');
        }

        $warehouses = Warehouse::find()->all();
        $whList = \yii\helpers\ArrayHelper::map($warehouses, 'id_wh', 'wh_name');

        // Condition lookup
        $condition = \app\models\ConditionLookup::find()->all();
        $condlist = \yii\helpers\ArrayHelper::map($condition, 'id_condition', 'condition_name');

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // Set the status based on the condition value from the POST request
                if ($model->condition == 5) {
                    $model->status = 4;
                } elseif ($model->condition == 4) {
                    $model->status = 4;
                } else {
                    $model->status = 1;
                }
                $user = Yii::$app->user->identity;
                $user_id = $user->id;
                $model->updated_by = $user_id;
                // Save the ItemUnit model after setting the status
                if ($model->save(false)) {
                    // Find the latest Lending record for this unit
                    $lending = Lending::find()->where(['id_unit' => $model->id_unit])
                        ->orderBy(['id_lending' => SORT_DESC]) // Get the latest entry
                        ->one();

                    if ($lending) {
                        $date = date('Y-m-d');
                        // Update the Lending record
                        $lending->type = 2; // Set type to 2 for return
                        $lending->date = $date; // Update the date
                        $lending->save(false); // Save the changes without validation
                    
                    }
                    $logController = new LogController('log', Yii::$app); // Pass the required parameters to the controller
                    $logController->actionReturnLog($model->id_unit, $lending->id_employee);
                    Yii::$app->session->setFlash('success', 'Unit Returned successfully.');
                    return $this->redirect(['lending/list']);
                }
            }
        }

        return $this->render('return-unit', [
            'model' => $model,
            'whList' => $whList,
            'condlist' => $condlist,
        ]);
    }

    

    /**
     * Updates an existing ItemUnit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_unit Id Unit
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_unit)
    {
        $model = $this->findModel($id_unit);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Unit Updated successfully.');
            return $this->redirect(['view', 'id_unit' => $model->id_unit]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItemUnit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_unit Id Unit
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_unit)
    {
        $this->findModel($id_unit)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemUnit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_unit Id Unit
     * @return ItemUnit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_unit)
    {
        if (($model = ItemUnit::findOne(['id_unit' => $id_unit])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionWarehouseDistribution($id_item){
        $model = new ItemUnit();
        $data = $model->getWhDistribution($id_item);
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionItemDetail($id_item){
        $model = new ItemUnit();
        $data = $model->getItemDetail($id_item);
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }


    public function actionAvailableUnit($id_item){
        $model = new ItemUnit();
        $data = $model->getAvailableUnit($id_item);
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    
    public function actionAvailableLending(){
        $model = new ItemUnit();
        $data = $model->getListAvailableLending();
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionUnitRepair(){
        $model = new ItemUnit();
        $data = $model->getUnitRepair();
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionBrokenUnit(){
        $model = new ItemUnit();
        $data = $model->getBrokenUnit();
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionCorrectionSearch()
    {
        $model = new \app\models\ItemUnit();
    
        if ($model->load(Yii::$app->request->post())) {
            if ($model->serial_number !== null) {
                $serial_number = $model->serial_number;
                // Call actionCorrectionUnit with the serial number
                return $this->redirect(['correction-unit', 'serial_number' => $serial_number]);
            } else {
                // Handle the case when serial_number is not provided
                Yii::$app->session->setFlash('error', 'Serial number cannot be null.');
            }
        }
    
        return $this->render('correction-search', [
            'model' => $model,
        ]);
    }
    
    
    public function actionCorrectionUnit($serial_number)
    {
        // Find the item unit by serial number (ensure that serial_number is a valid column)
        $model = ItemUnit::find()->where(['serial_number' => $serial_number])->one();
        
        //Warehouse name lookup
        $warehouses = Warehouse::find()->all();
        $whList = \yii\helpers\ArrayHelper::map($warehouses, 'id_wh', 'wh_name');

        // Condition lookup
        $condition = \app\models\ConditionLookup::find()->all();
        $condlist = \yii\helpers\ArrayHelper::map($condition, 'id_condition', 'condition_name');

        //status lookup
        $stats = \app\models\StatusLookup::find()->all();
        $statslist = \yii\helpers\ArrayHelper::map($stats, 'id_status', 'status_name');

        // Check if the model was found
        if ($model === null) {
            Yii::$app->session->setFlash('error', 'Serial number cannot be found. Check if you mistyped it.');
            return $this->redirect(['correction-search']);
        }
    
        // If model is found, load and validate the form data
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = Yii::$app->user->identity;
            $model->updated_by = $user->id;
            $model->save();
            $logController = new LogController('log', Yii::$app); // Pass the required parameters to the controller
            $logController->actionEditLog($serial_number);
            Yii::$app->session->setFlash('success', 'Unit saved successfully.');
            return $this->refresh(); // Prevents form resubmission
        }
    
        return $this->render('correction-unit', [
            'model' => $model,
            'whList' => $whList,
            'condlist' => $condlist,
            'statslist' => $statslist,//not showing status name
        ]);
    }
    
    

    public function actionSendRepair($id_unit)
    {
        $unit = \app\models\ItemUnit::findOne(['id_unit'=>$id_unit]);
        $model = $this->findModel($id_unit);
        if (!$unit) {
            throw new NotFoundHttpException('The requested ItemUnit does not exist.');
        }
        $user = Yii::$app->user->identity;
        $model->id_unit = $id_unit;
        $model->status = 3;
        $model->id_item = $unit->id_item;
        $model->condition = $unit->condition;
        $model->id_wh = NULL;
        $model->updated_by = $user->id;
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    $logController = new LogController('log', Yii::$app); // Pass the required parameters to the controller
                    $logController->actionRepairLog($model->id_unit);
                    Yii::$app->session->setFlash('success', 'Unit sent to repair successfully.');
                    return $this->redirect(['damaged']);
                }
                return;
            }
        }

        return $this->render('send-repair', [
            'model' => $model,
        ]);
    }

    public function actionFinishRepair($id_unit)
    {
        $unit = \app\models\ItemUnit::findOne(['id_unit'=>$id_unit]);
        $model = $this->findModel($id_unit);

        //wh list
        $warehouses = Warehouse::find()->all();
        $whList = \yii\helpers\ArrayHelper::map($warehouses, 'id_wh', 'wh_name');
        // Condition lookup
        $condition = \app\models\ConditionLookup::find()->all();
        $condlist = \yii\helpers\ArrayHelper::map($condition, 'id_condition', 'condition_name');
        if (!$unit) {
            throw new NotFoundHttpException('The requested ItemUnit does not exist.');
        }
        $user = Yii::$app->user->identity;
        $model->id_unit = $id_unit;
        $model->status = 1;
        $model->id_item = $unit->id_item;
        $model->condition = $unit->condition;
        $model->id_wh = NULL;
        $model->updated_by = $user->id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
                    $logController = new LogController('log', Yii::$app); // Pass the required parameters to the controller
                    $logController->actionDoneRepairLog($model->id_unit);
                    Yii::$app->session->setFlash('success', 'Unit repaired and updated.');
                    return $this->redirect(['repair']);
                }
                return;
            }
        }

        return $this->render('finish-repair', [
            'model' => $model,
            'condlist' => $condlist,
            'whList' => $whList,
        ]);
    }

    public function actionBulkAdd($id_item)
    {
        $model = new UploadForm();
        $session = Yii::$app->session;
        $filemod = new DocUploaded();
    
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
    
            if ($model->file && $model->validate()) {
                // Define the file path where the file should be saved
                $filename = $model->upload();
                $filePath = $filename['filePath'];
                $fileName = $filename['fileName'];
    
                // Save the uploaded file
                if (isset($filePath)) {
                    // Store uploaded file record in DB
                    $filemod->file_name = $fileName;
                    $filemod->user_id = Yii::$app->user->id;
                    $filemod->datetime = new \yii\db\Expression('NOW()');
                    $filemod->save();
    
                    // Load the spreadsheet from the saved file path
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
    
                    // Retrieve the item and SKU prefix
                    $item = Item::findOne($id_item);
                    $skuPrefix = substr($item->SKU, 0, 4);
    
                    $unitData = [];
                    foreach ($sheet->toArray(null, true, true, true) as $rowIndex => $row) {
                        if ($rowIndex == 1) continue; // Skip header
    
                        do {
                            $serialNumber = $row['B'] ?? $this->generateUniqueSerialNumber($skuPrefix);
                        } while (ItemUnit::find()->where(['serial_number' => $serialNumber])->exists());
    
                        // Prepare unit data and overwrite the spreadsheet row with updated data
                        $unitData[] = [
                            'id_item' => $id_item,
                            'status' => 1,
                            'id_wh' => $row['A'] ?? null,
                            'condition' => 1,
                            'serial_number' => $serialNumber,
                            'comment' => $row['C'] ?? 'New Unit',
                            'updated_by' => Yii::$app->user->id,
                        ];
    
                        // Update the row in the spreadsheet with new values
                        $sheet->setCellValue("A$rowIndex", $row['A'] ?? null); // Warehouse ID
                        $sheet->setCellValue("B$rowIndex", $serialNumber);      // Serial Number
                        $sheet->setCellValue("C$rowIndex", $row['C'] ?? 'New Unit'); // Comment
                    }
    
                    // Save the updated spreadsheet to overwrite the original uploaded file
                    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                    $writer->save($filePath);
    
                    // Store unit data in session for preview
                    $session->set('unitData', $unitData);
                    $session->set('uploadedFileName', $fileName);
    
                    // Redirect to a preview page
                    return $this->redirect(['bulk-add-preview']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save uploaded file.');
                    return $this->redirect(['index']);
                }
            }
        }
    
        return $this->render('mass-unit', ['model' => $model]);
    }
    
    
    
    public function actionBulkAddPreview()
    {
        $session = Yii::$app->session;
        $unitData = $session->get('unitData', []);
    
        if (Yii::$app->request->isPost) {
            foreach ($unitData as $data) {
                $unit = new ItemUnit($data);
                $unit->save(false); // Save without validation
            }
    
            $session->remove('unitData'); // Clear session data
            Yii::$app->session->setFlash('success', 'Data saved successfully.');
            return $this->redirect(['index']);
        }
    
        return $this->render('bulk-add-preview', ['unitData' => $unitData]);
    }
    
    

    protected function generateUniqueSerialNumber($skuPrefix)
    {
        do {
            $randomStr = strtoupper(substr(preg_replace('/[^A-Z]/', '', Yii::$app->security->generateRandomString()), 0, 2));
            $randomStr2 = strtoupper(substr(preg_replace('/[^A-Z]/', '', Yii::$app->security->generateRandomString()), 0, 2));
            $serialNumber = $skuPrefix . '-' . random_int(0, 9). random_int(0, 9). random_int(0, 9). random_int(0, 9). $randomStr.'-'.$randomStr2;
        } while (ItemUnit::find()->where(['serial_number' => $serialNumber])->exists());

        return $serialNumber;
    }
    
}
