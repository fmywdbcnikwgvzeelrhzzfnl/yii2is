<?php

use common\models\ProjectUserModel;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="task-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'project_id',
                'filter' => Yii::$app->taskService->getProjects(Yii::$app->user->identity),
                'value' => function (\common\models\TaskModel $model) {
                    return Html::a($model->project->title, ['project/view', 'id' => $model->project->id]);
                    //return $model->project->title;
                },
                'label' => 'Project title',
                'format' => 'html',
            ],
            ['attribute' => 'title', 'label' => 'Task title'],
            'description:ntext',
            //'estimation',
            //['attribute' => 'executor.username', 'label' => 'Executor'],
            [
                'attribute' => 'executor_id',
                'filter' => User::find()->byTasks(Yii::$app->user->identity,\common\models\TaskModel::ROLE_EXECUTOR),
                'value' => function (\common\models\TaskModel $model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html',
                'label' => 'Executor',
            ],
            'started_at:datetime',
            'completed_at:datetime',
            [
                'attribute' => 'created_by',
                'filter' => User::find()->byTasks(Yii::$app->user->identity,\common\models\TaskModel::ROLE_CREATOR),
                'value' => function (\common\models\TaskModel $model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html',
                'label' => 'Creator',
            ],
            [
                'attribute' => 'updated_by',
                'filter' => User::find()->byTasks(Yii::$app->user->identity,\common\models\TaskModel::ROLE_UPDATER),
                'value' => function (\common\models\TaskModel $model) {
                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                },
                'format' => 'html',
                'label' => 'Updator',
            ],
            'created_at:datetime',
            'updated_at:datetime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {start} {finish}',
                'buttons' => [
                    'start' => function ($url, \common\models\TaskModel $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('play'); //иконка с сайта https://getbootstrap.com/docs/3.3/components/
                        return Html::a($icon, ['task/start', 'id' => $model->id],
                            [
                                'data' =>
                                    [
                                        'confirm' => 'Are you sure to take task in work?',
                                        'method' => 'post',
                                    ]
                            ]); //текстовая кнопка
                    },
                    'finish' => function ($url, \common\models\TaskModel $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('stop'); //иконка с сайта https://getbootstrap.com/docs/3.3/components/
                        return Html::a($icon, ['task/finish', 'id' => $model->id],
                            [
                                'data' =>
                                    [
                                        'confirm' => 'Are you sure to take task in work?',
                                        'method' => 'post',
                                    ]
                            ]); //текстовая кнопка
                    }
                ],
                'visibleButtons' => [
                    //кнопка update видна только для задач по проектам, где пользователь - менеджер
                    'update' => function (\common\models\TaskModel $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    //кнопка delete видна только для задач по проектам, где пользователь - менеджер
                    'delete' => function (\common\models\TaskModel $model, $key, $index) {
                        return Yii::$app->taskService->canManage($model->project, Yii::$app->user->identity);
                    },
                    //кнопка старта задачи
                    'start' => function (\common\models\TaskModel $model, $key, $index) {
                        return Yii::$app->taskService->canTake($model, Yii::$app->user->identity);
                    },
                    //кнопка выполнения задачи
                    'finish' => function (\common\models\TaskModel $model, $key, $index) {
                        return Yii::$app->taskService->canCompele($model, Yii::$app->user->identity);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
