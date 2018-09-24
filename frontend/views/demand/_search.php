<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DemandSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="demand-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'ord') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'fk_version') ?>

    <?php // echo $form->field($model, 'fk_language') ?>

    <?php // echo $form->field($model, 'fk_document') ?>

    <?php // echo $form->field($model, 'is_complex') ?>

    <?php // echo $form->field($model, 'fk_parent') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
