<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form \yii\bootstrap\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
        'options' => ['enctype' => 'multipart/form-data']]); ?>

    <? //echo $form->field($model, 'status')->textInput() ?>



    <?= $form->field($model, 'avatar')->fileInput(['accept' => 'image/*'])->label('Icon')
    //->label(Html::img($model->getThumbUploadUrl('avatar', User::AVATAR_ICO)))    ?>

    <?= Html::img($model->getThumbUploadUrl('avatar', User::AVATAR_ICO), ['class' => 'col-sm-offset-3']) ?>
    <br><br>

    <?= $form->field($model, 'email') ?>
    <? //echo $form->field($model, 'status')->dropDownList(User::STATUSES; //пользователь не может себя выключить ?>


    <div class="form-group">
        <div class="col-sm-offset-5">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
