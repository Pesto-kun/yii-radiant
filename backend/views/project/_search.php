<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\project\Search */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'author_id') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'responsible_id') ?>

    <?php // echo $form->field($model, 'participants') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
