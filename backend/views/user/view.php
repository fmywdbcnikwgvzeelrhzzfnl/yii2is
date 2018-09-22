<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'User: '.$model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><? //echo Html::encode($this->title); ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'attribute' => 'status',
                'filter' => User::STATUSES,
                'value' => function (User $model) {
                    return User::STATUSES[$model->status];
                }
            ],
            'avatar',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',

            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
        'model' => $model,
    ]); ?>

</div>
