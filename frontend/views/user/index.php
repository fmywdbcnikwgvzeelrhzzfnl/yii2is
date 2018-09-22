<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            [
                'attribute' => 'status',
                'filter' => User::STATUSES,
                'value' => function (User $model){
                    return User::STATUSES[$model->status];
                    //return 'no';
                }
            ],
            'avatar',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'status',
            //'created_at:datetime',
            //'updated_at:datetime',
            //'avatar',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
