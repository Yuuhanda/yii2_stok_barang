<?php

namespace app\controllers;

use app\models\Lending;
use app\models\LendingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new LendingSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
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
            if ($model->load($this->request->post()) && $model->save()) {
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
}
