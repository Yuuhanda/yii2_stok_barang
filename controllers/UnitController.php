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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
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
        $itemModel = new Item;
        $searchModel = new ItemSearch();
        $dataProvider = $itemModel->getDashboard();

       // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataProvider,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

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

    public function actionDamaged(){
        $unitModel = new ItemUnit();
        $searchModel = new UnitSearch();
        $damagedlist = $unitModel->getBrokenUnit();
    
        // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $damagedlist,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    
        return $this->render('damaged', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRepair(){
        $unitModel = new ItemUnit();
        $searchModel = new UnitSearch();
        $damagedlist = $unitModel->getUnitRepair();
    
        // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $damagedlist,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    
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
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('add-unit', [
            'model' => $model,
            'whList' => $whList,
        ]);
    }
    

    public function actionReturnUnit($id_unit)  
    {
        
        $unit = \app\models\ItemUnit::findOne(['id_unit'=>$id_unit]);
        $model = new \app\models\ItemUnit();
        if (!$unit) {
            throw new NotFoundHttpException('The requested ItemUnit does not exist.');
        }
        $model->id_unit = $id_unit;
        $model->status = 1;
        $model->id_item = $unit->id_item;
        $model->serial_number = $unit->serial_number;
        
        $warehouses = Warehouse::find()->all();
        $whList = \yii\helpers\ArrayHelper::map($warehouses, 'id_wh', 'wh_name');

        // Condition lookup
        $condition = \app\models\ConditionLookup::find()->all();
        $condlist = \yii\helpers\ArrayHelper::map($condition, 'id_condition', 'condition_name');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('return-unit', [
            'model' => $model,
            'whList' => $whList,
            'condlist' => $condlist,
        ]);
    }


    public function actionUpdateReturn($id_unit)
    {
        // Check if 'id_unit' is posted
        $id_unit = $id_unit;
        
        // Debugging: Check if id_unit is being passed
        

        // Load the ItemUnit model using id_unit
        $unit = ItemUnit::findOne($id_unit);
        $model = new ItemUnit();
        // Check if model is found
        if (!$unit) {
            throw new NotFoundHttpException("The requested ItemUnit with id_unit = {$id_unit} does not exist.");
        }
    
        if ($this->request->isPost) {
            // Update the current ItemUnit record
            $date = date('Y-m-d');
            $model->status = 1;
            if ($model->load($this->request->post()) && $model->save()) {
                // Find the newest lending row related to this unit
                $lending = Lending::find()->where(['id_unit' => $model->id_unit])
                ->orderBy(['id_lending' => SORT_DESC]) // Get the latest entry
                ->one();
            
                if ($lending) {
                    // Update the existing Lending record
                    $lending->type = 2; // Set type to 2 for return
                    $lending->date = $date; // Update the date if needed
                    $lending->save(false); // Save the changes without validation
                }
            
            }
        }
    
        return $this->redirect(['index']); // Redirect to index after processing
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
            if ($model->load($this->request->post())) {
    
                // Check if 'serial_number' is empty
                if (empty($model->serial_number)) {
                    // Find the related Item model
                    $item = Item::findOne($model->id_item);
                    if ($item !== null) {
                        // Generate serial number using first 4 characters of SKU
                        $serial_numberprefix = substr($item->SKU, 0, 4);
                        $model->serial_number = $serial_numberprefix . "-" . rand(10, 1000) ; // Example serial number format
                    }
                }
    
                // Save the model and redirect if successful
                if ($model->save()) {
                    return $this->redirect(['view', 'id_unit' => $model->id_unit]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
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
}
