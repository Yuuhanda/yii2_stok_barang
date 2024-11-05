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
use yii\filters\AccessControl;

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
                            'roles' => ['maintenance'], // deny guests
                        ],
                        [
                            'allow' => true,
                            'roles' => ['Admin'], // deny guests
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
     * Lists all Lending models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Create the search model and load the request data
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Render the view with the search model and data provider
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
        // Create the search model and load the request data
        $searchModel = new LendingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Render the view with the search model and data provider
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
            $user = Yii::$app->user->identity;
            $model->user_id = $user->id;
            if ($model->load($this->request->post()) && $model->save()) {
                // Update the item_unit status where id_unit matches the one in the Lending model
                $itemUnit = ItemUnit::findOne($model->id_unit); // Assuming you have id_unit in the Lending model
                if ($itemUnit !== null) {
                    $user = Yii::$app->user->identity;
                    $itemUnit->updated_by = $user->id;
                    $itemUnit->status = 2; // Update the status
                    $itemUnit->save(); // Save the changes
                }
                $logController = new LogController('log', Yii::$app); // Pass the required parameters to the controller
                $logController->actionLendingLog($model->id_unit, $model->id_employee); // Call with correct parameters
                Yii::$app->session->setFlash('success', 'Unit'. $itemUnit->serial_number .'loaned.');
                return $this->redirect(['index']);
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
