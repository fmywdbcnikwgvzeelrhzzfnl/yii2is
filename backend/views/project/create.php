<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectModel */

$this->title = 'Create Project Model';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-model-create">

    <h1><? //echo Html::encode($this->title); ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
