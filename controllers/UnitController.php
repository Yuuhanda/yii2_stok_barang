<?php

namespace app\controllers;

use app\models\ItemUnit;
use app\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new UnitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
}
