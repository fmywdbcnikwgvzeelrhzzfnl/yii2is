<?php

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

    <h1><? //echo Html::encode($this->title); ?></h1>
    <?php Pjax::begin(/*['enablePushState' => false]*/); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'active',
                'filter' => ProjectModel::STATUSES,
                'value' => function (ProjectModel $model) {
                    return ProjectModel::STATUSES[$model->active];
                    //return 'no';
                }
            ],
            ['attribute' => 'createdBy.username', 'label' => 'Creator',], //обращаемся к результату выполнения  метода getCreatedBy(), но через точку
            ['attribute' => 'updatedBy.username', 'label' => 'Updater',],

            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
