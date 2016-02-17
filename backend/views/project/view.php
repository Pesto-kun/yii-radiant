<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проекты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить проект?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'title',
            'description',
            'author.username',
            'created:datetime',
            'updated:datetime',
            [
                'attribute' => 'status',
                'value' => \common\models\Project::getStatusName($model->status)
            ],
            'responsible.username',
        ],
    ]) ?>

</div>
