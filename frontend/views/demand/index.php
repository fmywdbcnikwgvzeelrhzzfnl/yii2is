<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DemandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */
/* @var $model common\models\Demand */

$this->title = 'Требования';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php $form = ActiveForm::begin(); ?>

        <?= Html::dropDownList('sdf', 'null', ['1' => 'v.11', '2' => 'v.213']) ?>

        <?php ActiveForm::end(); ?>
    </p>

    <p>
        <?= Html::a('Create Demand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'uid',
            [
                'attribute' => 'name',
                'contentOptions' => ['style' => 'white-space: normal;'],
            ],
            [
                'attribute' => 'comment',
                'headerOptions' => ['style' => 'width:300px; max-width:300px;'],
                'contentOptions' => ['style' => 'white-space: normal;'],
            ],
            //'ord',
            //'level',
            //'fk_version',
            //'fk_language',
            'fk_document',
            //'is_complex',
            //'fk_parent',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
