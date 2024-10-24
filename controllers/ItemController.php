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
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
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
        $itemModel = new Item;
        $searchModel = new ItemSearch();
        $dataProvider = $itemModel->getDashboard();

       // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataProvider,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetails($id_item){
        $itemModel = new ItemUnit;
        $searchModel = new UnitSearch();
        $dataProvider = $itemModel->getItemDetail($id_item);

       // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataProvider,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('detail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionWarehouse($id_item){
        $itemModel = new ItemUnit;
        $searchModel = new WarehouseSearch();
        $dataProvider = $itemModel->getWhDistribution($id_item);

       // Wrap the array result in ArrayDataProvider
        $dataProvider = new ArrayDataProvider([
            'allModels' => $dataProvider,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

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

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                 // Get the uploaded file instance
                
                
                // Check if SKU is empty
                if (empty($model->SKU)) {
                    $randomStr = Yii::$app->security->generateRandomString(4); // Generate random string
                    $model->SKU = $randomStr . "-" . rand(1, 100) . "-" . time(); // Create SKU with random string
                }
                //$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                //if (!$model->imageFile || !$model->imageFile->tempName) {
                //    // If imageFile is null or doesn't have a tempName, the file wasn't uploaded correctly
                //    Yii::error('File upload failed.');
                //    return false;
                //}
                
                //if ($model->upload()) {
                // Save the model and redirect if successful
                if ($model->save()) {
                    return $this->redirect(['view', 'id_item' => $model->id_item]);
                //}
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_item' => $model->id_item]);
        }

        return $this->render('update', [
            'model' => $model,
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
