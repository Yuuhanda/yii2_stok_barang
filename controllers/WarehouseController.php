<?php

namespace app\controllers;

use app\models\Warehouse;
use app\models\WarehouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
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
     * Lists all Warehouse models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Warehouse model.
     * @param int $id_wh Id Wh
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_wh)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_wh),
        ]);
    }

    /**
     * Creates a new Warehouse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Warehouse();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_wh' => $model->id_wh]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Warehouse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_wh Id Wh
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_wh)
    {
        $model = $this->findModel($id_wh);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_wh' => $model->id_wh]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Warehouse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_wh Id Wh
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_wh)
    {
        $this->findModel($id_wh)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Warehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_wh Id Wh
     * @return Warehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_wh)
    {
        if (($model = Warehouse::findOne(['id_wh' => $id_wh])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
