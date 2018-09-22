<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><? //echo Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'avatar',
            [
                'attribute' => 'Icon',
                //'filter' => User::STATUSES,
                'value' => function (User $model){
                    return '<img src="'.$model->getThumbUploadUrl('avatar', User::AVATAR_ICO_MIN).'">';
                },
                'format' => 'html',
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => User::STATUSES,
                'value' => function (User $model){
                    return User::STATUSES[$model->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            /*[
                'attribute' => 'avatar',
                'value' => function (User $model) {
                    //return '<img src="'.$model->getThumbUploadUrl('avatar', User::AVATAR_ICO).'">';
                    //return Html::img($model->getThumbUploadUrl('avatar', User::AVATAR_ICO), ['class' => 'col-sm-offset-3']);
                    //return 'no';
                }
            ],*/

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
