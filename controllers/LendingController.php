<?php

namespace app\controllers;

use app\models\ItemSearch;
use app\models\ItemUnit;
use app\models\Employee;
use app\models\User;
use app\models\Lending;
use app\models\LendingSearch;
use app\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use Yii;
use app\models\Warehouse;

/**
 * LendingController implements the CRUD actions for Lending model.
 */
class LendingController extends Controller
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
     * Lists all Lending models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UnitSearch();
        $lendingModel = new Lending();
        $lendingList = $lendingModel->getListAvailableLending();
    
        // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $lendingList,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLoanUnit($id_item)
    {
        $model = new \app\models\Lending();
        $employee = \app\models\Employee::find()->all();
        //$user = new \app\models\User();
        $unitmodel = new \app\models\ItemUnit();
        $avalunit = $unitmodel->getAvailableUnit($id_item);

        $model->type = 1;
        
        $emplist = \yii\helpers\ArrayHelper::map($employee, 'id_employee', 'emp_name');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Save the model here or handle it as needed
            return;
        }

        return $this->render('loan-unit', [
            'model' => $model,
            'avalunit' => $avalunit,
            'emplist' => $emplist,
        ]);
    }

    public function actionList()
    {
        $searchModel = new UnitSearch();
        $lendingModel = new Lending();
        $lendingList = $lendingModel->getLendingList();
    
        // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $lendingList,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    
        return $this->render('lending-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Lending model.
     * @param int $id_lending Id Lending
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_lending)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_lending),
        ]);
    }

    public function actionReturnUnit($id_lending){
        $warehouses = \app\models\Warehouse::find()->all();
        // Prepare warehouse data as [id_wh => wh_name] for the dropdown
        $whList = \yii\helpers\ArrayHelper::map(Warehouse::find()->all(), 'id_wh', 'wh_name');

        $model = new \app\models\Lending();
        $lentunit = \app\models\Lending::findOne($id_lending);
        $model->type = 2;
        $model->id_lending = $id_lending;
        $model->id_employee = $lentunit->id_employee;
        $model->user_id = 1;
        $model->id_unit = $lentunit->id_unit;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('return-unit', [
            'model' => $model,
            'whList' => $whList,
    ]);
    }
    /**
     * Creates a new Lending model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lending();
    
        if ($this->request->isPost) {
            $model->date = date('Y-m-d');
            $model->user_id = 1;
            if ($model->load($this->request->post()) && $model->save()) {
                // Update the item_unit status where id_unit matches the one in the Lending model
                $itemUnit = ItemUnit::findOne($model->id_unit); // Assuming you have id_unit in the Lending model
                if ($itemUnit !== null) {
                    $itemUnit->status = 2; // Update the status
                    $itemUnit->save(); // Save the changes
                }
    
                return $this->redirect(['view', 'id_lending' => $model->id_lending]);
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Lending model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_lending Id Lending
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_lending)
    {
        $model = $this->findModel($id_lending);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_lending' => $model->id_lending]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lending model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_lending Id Lending
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_lending)
    {
        $this->findModel($id_lending)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Lending model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_lending Id Lending
     * @return Lending the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_lending)
    {
        if (($model = Lending::findOne(['id_lending' => $id_lending])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLendingList(){
        $model = new Lending();
        $data = $model->getLendingList();
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }
}
