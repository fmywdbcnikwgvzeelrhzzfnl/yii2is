<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use common\models\ProjectModel;
use common\models\ProjectSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for ProjectModel model.
 */
class ProjectController extends Controller
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
                        'actions' => ['logout', 'index', 'update', 'view', 'create', 'delete'],
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
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 10; //пагинация по 10 записей на странице

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
    public function actionCreate()
    {
        $model = new ProjectModel();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Project created');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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
        if ($this->loadModel($model)) {
            //var_dump($model);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $projectUsers = $model->getUsersData();

        if ($this->loadModel($model) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Project updated');
            if ($diffRoles = array_diff_assoc($model->getUsersData(), $projectUsers)) {
                //получаем массив с отличиями между тем, что было в базе и тем, что пользователь поменял в интерфейсе
                foreach ($diffRoles as $userId => $diffRole) {
                    Yii::$app->projectService->assignRole($model, User::findOne($userId), $diffRole);//вызов сервиса
                }
            }


            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function loadModel(ProjectModel $model)
    {
        $data = Yii::$app->request->post($model->formName());
        $projectUsers = $data[ProjectModel::RELATION_PROJECT_USERS] ?? null;
        if ($projectUsers !== null) {
            //работает с использованием расширения https://github.com/la-haute-societe/yii2-save-relations-behavior
            $model->projectUsers = $projectUsers === '' ? [] : $projectUsers;
        }
        return $model->load(Yii::$app->request->post());
    }

    /**
     * Deletes an existing ProjectModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Project deleted');
        return $this->redirect(['index']);
    }

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
