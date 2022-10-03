<?php

/** @var yii\web\View $this */

use backend\models\Pembuatsurat;
use backend\models\Tujuansurat;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'MAN2 ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index content">


    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">

                    <div class="small-box " style="background-color: #0093dd;">
                        <div class="inner">
                            <h3><?php echo $count ?></h3>
                            <h4>Surat Masuk</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="<?= Url::toRoute(['suratmasuk/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                
                            <?php if( $modelpembuat || Yii::$app->user->identity->role == "admin" || $modeltanda){ ?>
                            <h3><?php echo $count2 ?></h3>
                            <?php  }else { ?>
                                <h3>0</h3>
                                <?php }?>
                            <h4>Surat Baru</h4>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="<?= Url::toRoute(['informasisurat/index']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                    <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $count1 ?></h3>
                                <h4>Surat Masuk Terkirim</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="<?= Url::toRoute(['suratmasuk/smterkirim']) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    <?php } ?>
                    </div>
            </div>

        </div>

    </section>

</div>