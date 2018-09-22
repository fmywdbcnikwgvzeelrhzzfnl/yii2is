<?php

use common\models\ProjectUserModel;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaskModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <? if (Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity)) { ?>
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <? } ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            ['attribute' => 'project.title', 'label' => 'Project title'],
            ['attribute' => 'title', 'label' => 'Task title'],
            'description:ntext',
            'estimation',
            'executor_id',
            'started_at:datetime',
            'completed_at:datetime',
            ['attribute' => 'createdBy.username', 'label' => 'Creator'],
            ['attribute' => 'updatedBy.username', 'label' => 'Updater'],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
        'model' => $model,
    ]); ?>

</div>
