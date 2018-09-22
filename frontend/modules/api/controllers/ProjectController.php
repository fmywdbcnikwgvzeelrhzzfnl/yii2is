<?php

namespace frontend\modules\api\controllers;

use Yii;
use frontend\modules\api\models\User;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class ProjectController extends Controller
{
    //public $modelClass = "frontend\modules\api\models\project";

    //GET http://localhost/api/projects?page=1
    //http://localhost/api/users/1?expand=projects
    public function actionIndex()
    {
        $dp = new ActiveDataProvider(['query' => User::find()]);
        $dp->pagination->pageSize = 2;
        return $dp;
    }

    public function actionView($id)
    {
        return User::findOne($id);
    }
}
