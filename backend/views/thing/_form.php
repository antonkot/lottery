<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Thing */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'lottery_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
