<?php

namespace frontend\modules\api\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends ActiveController
{
    public $modelClass="frontend\modules\api\models\user";
}
