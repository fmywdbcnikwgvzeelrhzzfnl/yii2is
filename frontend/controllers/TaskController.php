<?php

namespace frontend\controllers;

use common\models\query\TaskQuery;
use Yii;
use common\models\TaskModel;
use common\models\TaskSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for TaskModel model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        //'actions' => ['logout', 'index', 'update', 'view','create', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all TaskModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /* @var $query TaskQuery */
        $query = $dataProvider->query;
        $query->byUser(Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaskModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaskModel();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Task created');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaskModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Task updated');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionStart($id)
    {
        /*$model = $this->findModel($id);
        $model->executor_id = Yii::$app->user->id;
        $model->started_at = time();

        if ($model->save()) {
            Yii::$app->session->setFlash('success','Task started');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->redirect(['index', 'id' => $model->id]);*/

        $model = $this->findModel($id);

        if (Yii::$app->taskService->takeTask($model, Yii::$app->user->identity)) {
            Yii::$app->session->setFlash('success', 'Task started');
            return $this->redirect(['index', 'id' => $model->id]);//решил перенаправить на список задач, это удобнее, чем перенаправление на страницу задачи
        }

        return $this->redirect(['index', 'id' => $model->id]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionFinish($id)
    {
        /*$model = $this->findModel($id);
        //$model->executor_id = Yii::$app->user->id;
        $model->completed_at = time();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Task finished');
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->redirect(['index', 'id' => $model->id]);*/

        $model = $this->findModel($id);

        if (Yii::$app->taskService->completeTask($model, Yii::$app->user->identity)) {
            Yii::$app->session->setFlash('success', 'Task completed');
            return $this->redirect(['index', 'id' => $model->id]);//решил перенаправить на список задач, это удобнее, чем перенаправление на страницу задачи
        }

        return $this->redirect(['index', 'id' => $model->id]);

    }

    /**
     * Deletes an existing TaskModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Task deleted');
        return $this->redirect(['index']);
    }

    /**
     * Finds the TaskModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
