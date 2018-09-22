<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\ProjectModel */
/* @var $role string */

?>Hello <?= Html::encode($user->username) ?>,
You are assigned as <?= $role ?> in project <?= $project->title ?>.
Good work.