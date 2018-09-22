<?php

namespace frontend\controllers;

use common\models\query\ProjectQuery;
use Yii;
use common\models\ProjectModel;
use common\models\ProjectSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for ProjectModel model.
 */
class ProjectController extends Controller
{
    const RELATION_PROJECT_USERS = 'projectUsers';

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
                        //'actions' => ['logout', 'index', 'update', 'view', 'create', 'delete', 'my'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ProjectModel models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
    /*public function actionMy()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ProjectModel::find()->joinWith(ProjectModel::RELATION_PROJECT_USERS)->where(['user_id' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /* @var $query ProjectQuery */
        $query = $dataProvider->query;
        $query->byUser(Yii::$app->user->id);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectModel model.
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
     * Creates a new ProjectModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*public function actionCreate()
    {
        $model = new ProjectModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing ProjectModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing ProjectModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the ProjectModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
