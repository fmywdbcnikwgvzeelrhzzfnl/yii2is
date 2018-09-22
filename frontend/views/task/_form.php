<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaskModel */
/* @var $form yii\widgets\ActiveForm */

$projects = \common\models\ProjectModel::find()
    ->byUser(Yii::$app->user->identity, \common\models\ProjectUserModel::ROLE_MANAGER)//задачи можно прикрепить только к проектам, где пользователь - менеджер
    ->select('title')
    ->indexBy('id')
    ->column();
?>

<div class="task-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects)->label('Project title') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Task title') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estimation')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
