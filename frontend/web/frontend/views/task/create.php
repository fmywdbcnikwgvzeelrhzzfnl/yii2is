<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaskModel */

$this->title = 'Create Task Model';
$this->params['breadcrumbs'][] = ['label' => 'Task Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
