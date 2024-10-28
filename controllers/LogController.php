<?php

namespace app\controllers;

use app\models\Employee;
use app\models\UnitLog;
use app\models\LogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ItemUnit;
use app\models\User;
use DateTime;
use Yii;
use yii\filters\AccessControl;

/**
 * LogController implements the CRUD actions for UnitLog model.
 */
class LogController extends Controller
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
                            'roles' => ['@'], // allow authenticated users (logged in)
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
     * Lists all UnitLog models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UnitLog model.
     * @param int $id_log Id Log
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_log)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_log),
        ]);
    }

    /**
     * Creates a new UnitLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UnitLog();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_log' => $model->id_log]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionLendingLog($id_unit, $id_employee)
    {
        $model = new UnitLog();
        
        // Get the serial number from the ItemUnit
        $unit = ItemUnit::findOne($id_unit);
        if (!$unit) {
            throw new \yii\web\NotFoundHttpException("Unit not found.");
        }
        $sn = $unit->serial_number;
    
        // Get the employee name
        $emp = Employee::findOne($id_employee);
        if (!$emp) {
            throw new \yii\web\NotFoundHttpException("Employee not found.");
        }
        $emp_name = $emp->emp_name;
    
        // Set log fields
        $model->id_unit = $id_unit;
        $model->content = "Unit $sn lent to $emp_name";
        $model->update_at = new \yii\db\Expression('NOW()'); // Correct this field if necessary
    
        // Try saving and check for errors
        if ($model->save()) {
            return true; // Save was successful
        } else {
            // Save failed, output validation errors
            Yii::error($model->getErrors(), __METHOD__);
            throw new \yii\web\ServerErrorHttpException("Failed to save log: " . json_encode($model->getErrors()));
        }
    }
    
    /**
     * Updates an existing UnitLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_log Id Log
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_log)
    {
        $model = $this->findModel($id_log);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_log' => $model->id_log]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UnitLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_log Id Log
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_log)
    {
        $this->findModel($id_log)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UnitLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_log Id Log
     * @return UnitLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_log)
    {
        if (($model = UnitLog::findOne(['id_log' => $id_log])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionViewLog($id_unit){
        $model = new UnitLog();
        $data = $model->getLogUnit($id_unit);
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionReturnLog($id_unit, $id_employee)
    {
        $model = new UnitLog();
        
        // Get the serial number from the ItemUnit
        $unit = ItemUnit::findOne($id_unit);
        if (!$unit) {
            throw new \yii\web\NotFoundHttpException("Unit not found.");
        }
        $sn = $unit->serial_number;
    
        // Get the employee name
        $emp = Employee::findOne($id_employee);
        if (!$emp) {
            throw new \yii\web\NotFoundHttpException("Employee not found.");
        }
        $emp_name = $emp->emp_name;
    
        // Set log fields
        $model->id_unit = $id_unit;
        $model->content = "Unit $sn returned by $emp_name";
        $model->update_at = new \yii\db\Expression('NOW()'); // Correct this field if necessary
    
        // Try saving and check for errors
        if ($model->save()) {
            return true; // Save was successful
        } else {
            // Save failed, output validation errors
            Yii::error($model->getErrors(), __METHOD__);
            throw new \yii\web\ServerErrorHttpException("Failed to save log: " . json_encode($model->getErrors()));
        }
    }

    public function actionRepairLog($id_unit, $user_id)
    {
        $model = new UnitLog();
        
        // Get the serial number from the ItemUnit
        $unit = ItemUnit::findOne($id_unit);
        if (!$unit) {
            throw new \yii\web\NotFoundHttpException("Unit not found.");
        }
        $sn = $unit->serial_number;
    
        // Get the employee name
        $emp = User::findOne($user_id);
        if (!$emp) {
            throw new \yii\web\NotFoundHttpException("Employee not found.");
        }
        $emp_name = $emp->username;
    
        // Set log fields
        $model->id_unit = $id_unit;
        $model->content = "Unit $sn sent for repair by $emp_name";
        $model->update_at = new \yii\db\Expression('NOW()'); // Correct this field if necessary
    
        // Try saving and check for errors
        if ($model->save()) {
            return true; // Save was successful
        } else {
            // Save failed, output validation errors
            Yii::error($model->getErrors(), __METHOD__);
            throw new \yii\web\ServerErrorHttpException("Failed to save log: " . json_encode($model->getErrors()));
        }
    }

    public function actionDoneRepairLog($id_unit, $user_id)
    {
        $model = new UnitLog();
        
        // Get the serial number from the ItemUnit
        $unit = ItemUnit::findOne($id_unit);
        if (!$unit) {
            throw new \yii\web\NotFoundHttpException("Unit not found.");
        }
        $sn = $unit->serial_number;
    
        // Get the employee name
        $emp = User::findOne($user_id);
        if (!$emp) {
            throw new \yii\web\NotFoundHttpException("Employee not found.");
        }
        $emp_name = $emp->username;
    
        // Set log fields
        $model->id_unit = $id_unit;
        $model->content = "Unit $sn repaired. Taken to warehouse by $emp_name";
        $model->update_at = new \yii\db\Expression('NOW()'); // Correct this field if necessary
    
        // Try saving and check for errors
        if ($model->save()) {
            return true; // Save was successful
        } else {
            // Save failed, output validation errors
            Yii::error($model->getErrors(), __METHOD__);
            throw new \yii\web\ServerErrorHttpException("Failed to save log: " . json_encode($model->getErrors()));
        }
    }
}
