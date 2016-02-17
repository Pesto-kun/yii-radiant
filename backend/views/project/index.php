<?php
use common\models\Project;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\project\Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать проект', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            [
                'attribute' => 'status',
                'format'=>'raw',
                'value' => function ($data) {
                    return Project::getStatusName($data->status);
                },
                'filter' => Project::getStatusOptions()
            ],
            'created',
            'updated',
            [
                'attribute' => 'responsible_id',
                'value' => 'responsible.username',
                'filter' => ArrayHelper::map(User::find()->where(['status' => User::STATUS_ACTIVE])->asArray()->all(), 'id', 'username')
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
