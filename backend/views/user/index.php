<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profil';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <div class="container-fluid">
        <div class="row">
            <div class="col-3">

            </div>
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-info card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">

                            <?php if (!Yii::$app->user->identity->foto) { ?>

                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="profile-user-img img-fluid img-circle" alt="User Image">
                                <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                            <?php } else { ?>
                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="profile-user-img img-fluid img-circle" alt="User Image">

                            <?php } ?>

                        </div>

                        <h3 class="profile-username text-center"></h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <div class="text-center">
                                <li class="list-group-item ">
                                    <b class="float-left">Nama&emsp;&emsp;&emsp;:</b> <a><?= Yii::$app->user->identity->nama ?></a>
                                </li>

                                <li class="list-group-item">
                                    <b class="float-left">Jabatan&emsp;&emsp;:</b> <a><?= Yii::$app->user->identity->jabatan ?></a>
                                </li>
                                <div>
                        </ul>
                        <span class="float-right">
                            <?= Html::a('Oke', ['/'], ['class' => 'btn ', 'style' => "background-color: #0093dd;"]) ?>
                        </span>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>