<?php

use backend\models\Tujuansurat;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchTujuansurat */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tujuansurats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tujuansurat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tujuansurat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_informasi_surat',
            'id_user',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tujuansurat $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
