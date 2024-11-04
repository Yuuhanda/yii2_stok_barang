<?php

namespace app\controllers;

use app\models\DocUploaded;
use app\models\DocSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentController implements the CRUD actions for DocUploaded model.
 */
class DocumentController extends Controller
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
     * Lists all DocUploaded models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocUploaded model.
     * @param int $id_doc Id Doc
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_doc)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_doc),
        ]);
    }

    /**
     * Creates a new DocUploaded model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new DocUploaded();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_doc' => $model->id_doc]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DocUploaded model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_doc Id Doc
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_doc)
    {
        $model = $this->findModel($id_doc);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_doc' => $model->id_doc]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DocUploaded model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_doc Id Doc
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_doc)
    {
        $this->findModel($id_doc)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DocUploaded model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_doc Id Doc
     * @return DocUploaded the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_doc)
    {
        if (($model = DocUploaded::findOne(['id_doc' => $id_doc])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
