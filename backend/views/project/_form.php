<?php
use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */

$users = \yii\helpers\ArrayHelper::map(User::find()->where(['status' => User::STATUS_ACTIVE])->asArray()->all(), 'id', 'username');
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-12">
        <?= $form->field($model, 'title') ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'status')->dropDownList(\common\models\Project::getStatusOptions()) ?>
    </div>

    <div class="col-sm-6">
        <?= $form->field($model, 'responsible_id')->dropDownList($users, [
            'prompt' => '- Укажите ответсвенного -'
        ]) ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'description')->textarea() ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'participants')->checkboxList($users) ?>
    </div>

    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
