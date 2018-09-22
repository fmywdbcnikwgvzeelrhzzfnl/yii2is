<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectModel */

$this->title = 'Update Project: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-model-update">

    <h1><? //echo Html::encode($this->title); ?></h1>

    <? //var_dump($model); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
