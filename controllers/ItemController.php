<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\data\ArrayDataProvider;
use app\models\ItemUnit;
use app\models\UnitSearch;
use app\models\WarehouseSearch;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use app\models\UploadPicture;
use app\models\User;
use app\models\Employee;
use app\models\Warehouse;
use app\models\ConditionLookup;
use app\models\StatusLookup;
/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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
                            'roles' => ['Admin'], // allow authenticated users (logged in)
                        ],
                        [
                            'allow' => true,
                            'roles' => ['superadmin'], // allow authenticated users (logged in)
                        ],
                        [
                            'allow' => false,
                            'actions' =>['create','update'],
                            'roles' => ['maintenance'], // deny guests
                        ],
                        [
                            'allow' => true,
                            'roles' => ['maintenance'], // deny guests
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Item models.
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
    public function actionViewImage($id)
    {
        $model = $this->findModel($id);

        if ($model->imagefile) {
            return $this->renderAjax('view-image', ['model' => $model]);
        } else {
            return "Image not available.";
        }
    }

    public function actionDetails($id_item)
    {
        // Create the search model and load the request data
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id_item); // Raw data results
         // Retrieve lists for Select2 dropdowns
         $updatedByList = User::getUpdatedByList();
         $warehouseList = Warehouse::getWarehouseList();
         $employeeList = Employee::getEmployeeList();
         $statusList = StatusLookup::getStatusList();
         $conditionList = ConditionLookup::getConditionList();

        // Render the view with the search model and data provider
        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'updatedByList' => $updatedByList,
            'warehouseList' => $warehouseList,
            'employeeList' => $employeeList,
            'statusList' => $statusList,
            'conditionList' => $conditionList,
        ]);
    }

    public function actionWarehouse($id_item){
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->searchWhDist(Yii::$app->request->queryParams, $id_item);



        return $this->render('whdist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param int $id_item Id Item
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_item)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_item),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Item();
        $uploadModel = new UploadPicture();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');

            // Generate SKU if empty
            if (empty($model->SKU)) {
                $model->SKU = $this->generateSKU();
            }

            // Save the uploaded image
            if ($uploadModel->imageFile && $uploadModel->validate()) {
                $imageFileName = $uploadModel->upload();
                if ($imageFileName) {
                    $model->imagefile = $imageFileName; // assuming `image` is a field in Item table
                }
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Item Added successfully.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'uploadModel' => $uploadModel,
        ]);
    }

    
    public function actionPicUpload(){
        //code here
    }

    protected function generateSKU(){
        do {
            $randomStr = strtoupper(substr(preg_replace('/[^A-Z]/', '', Yii::$app->security->generateRandomString()), 0, 2));
            $randomStr2 = strtoupper(substr(preg_replace('/[^A-Z]/', '', Yii::$app->security->generateRandomString()), 0, 2));
            $autosku = $randomStr . random_int(0, 9) . random_int(0, 9) .'-' .  random_int(0, 9) . random_int(0, 9). $randomStr2;
        } while (Item::find()->where(['SKU' => $autosku])->exists());

        return $autosku;
    }


    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_item Id Item
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_item)
    {
        $model = $this->findModel($id_item);
        $uploadModel = new UploadPicture();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->load(Yii::$app->request->post());
            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');

            // Generate SKU if empty
            if (empty($model->SKU)) {
                $model->SKU = $this->generateSKU();
            }

            // Save the uploaded image
            if ($uploadModel->imageFile && $uploadModel->validate()) {
                $imageFileName = $uploadModel->upload();
                if ($imageFileName) {
                    $model->imagefile = $imageFileName; // assuming `image` is a field in Item table
                }
            }
            $model->save();
            Yii::$app->session->setFlash('success', $model->item_name. ' updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'uploadModel' => $uploadModel,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_item Id Item
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_item)
    {
        $this->findModel($id_item)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_item Id Item
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_item)
    {
        if (($model = Item::findOne(['id_item' => $id_item])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDashboardData()
    {
        $model = new Item();
        $data = $model->getDashboard();

        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }

    public function actionItemName()
    {
        $model = new Item();
        $data = $model->get();
    
        // Return the data as JSON for DataTables
        return $this->asJson([
            'data' => $data,
        ]);
    }



}
