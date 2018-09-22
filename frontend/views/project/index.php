<?php

//use Yii;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\ProjectModel;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <? //echo Html::a('Create Project Model', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'title',
                'value' => function (\common\models\ProjectModel $model) {
                    return Html::a($model->title, ['project/view', 'id' => $model->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => \common\models\ProjectModel::RELATION_PROJECT_USERS . '.role',
                'filter' => \common\models\ProjectUserModel::ROLES,
                'value' => function (\common\models\ProjectModel $model) {
                    //return join(', ', $model->getProjectUsers()->select('role')->where(['user_id' => Yii::$app->user->id])->column());
                    return join(', ', Yii::$app->projectService->getRoles($model, Yii::$app->user->identity));
                },
                'format' => 'html',
            ],
            'description:ntext',
            [
                'attribute' => 'created_by',
                'value' => function (\common\models\ProjectModel $model) {
                    return Html::a($model->createdBy->username, ['user/view', 'id' => $model->createdBy->id]);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'updated_by',
                'value' => function (\common\models\ProjectModel $model) {
                    return Html::a($model->updatedBy->username, ['user/view', 'id' => $model->updatedBy->id]);
                },
                'format' => 'html',
            ],
            'created_at:datetime',
            'updated_at:datetime',
            //пользователи фронтэнда не могут править проекты
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
