<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $project common\models\ProjectModel */
/* @var $role string */

?>
<div>
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>You are assigned as <?= $role ?> in project <?= $project->title ?> </p>
</div>
