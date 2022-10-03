<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use backend\models\Isisurat;
use backend\models\Notif;
use backend\models\Notif1;
use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use backend\models\User;
use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\data\Pagination;
use yii\helpers\Url;

AppAsset::register($this);
$notif3 = Notif1::find()->where(['tujuan' => Yii::$app->user->identity->id]);
//$notif2 = Notif1::find();
$notif1 = Notif1::find()->where(['tujuan' => Yii::$app->user->identity->id])->count();
$c = "dibaca";
$tanda = Tandatangan::find()->where(['id_user' => Yii::$app->user->identity->id, 'statusnotif' => $c])->count();
$tujuan = Tujuansurat::find()->where(['id_user' => Yii::$app->user->identity->id, 'status' => $c])->count();
$status = Smpenerima::find()->where(['id_penerima' => Yii::$app->user->identity->id, 'status' => $c])->count();
$a =   $notif1 - $status - $tanda - $tujuan;


$pages = new Pagination([
    "totalCount" => $notif1 //$notif2
]);
$pages->pageSize = 5;
$notif =  $notif3->limit($pages->limit)->orderBy('id DESC')->all();


?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= Yii::$app->getHomeUrl(); ?>plugins/summernote/summernote-bs4.min.css">

</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed ">
    <?php $this->beginBody() ?>
    <div class=" wrapper ">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= Yii::$app->getHomeUrl(); ?>dist/img/350-MAN_2_PADANG.png" alt="MAN2" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= Url::toRoute(['/']) ?>" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!--Notifikasi Menu -->
                <li class="dropdown messages-menu">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="  far fa-bell"></i>
                        <span class=" badge badge-danger navbar-badge"><?php echo $a ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                        <?php $tanda = Tandatangan::find()->where(['id_user' =>  Yii::$app->user->identity->id])->one(); ?>
                        <?php $tujuan = Tujuansurat::find()->where(['id_user' =>  Yii::$app->user->identity->id])->one(); ?>

                        <?php foreach ($notif as $value) : ?>
                            <?php $isi = Isisurat::find()->where(['id_informasi' => $value['id_sk']])->one(); ?>
                            <?php $tanda1 = Tandatangan::find()->where(['id_informasi' => $value['id_sk']])->one(); ?>
                            <?php if ($value['id_sk'] != "0") { ?>
                                <div class=" my-custom-scrollbar">
                                    <?php if ($value['tujuan'] = $tanda) { ?>
                                        <a href="<?= Url::toRoute(['tandatangan/update', 'id' => $tanda1->id]) ?>" class="dropdown-item">
                                            <!-- Message Start -->
                                            <div class="media">
                                                <div class="media-body">
                                                    <h3 class="dropdown-item-title ">
                                                        <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                            <span class="float-right badge badge-danger">New</span>
                                                        <?php }   ?>
                                                        <?php echo $value["header"]; ?>
                                                    </h3>
                                                    <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                                    <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                                    <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>
                                                        <?php $user = User::find()->where(['id' => $value["id_pengirim"]])->one(); ?>
                                                        <?php echo $user["username"]; ?>
                                                    </p>
                                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                                </div>
                                            </div>
                                            <!-- Message End -->
                                        </a>
                                    <?php } ?>
                                    <?php if ($value['tujuan'] = $tujuan) { ?>
                                        <a href="<?= Url::toRoute(['isisurat/update', 'id' => $isi->id]) ?>" class="dropdown-item">
                                            <!-- Message Start -->
                                            <div class="media">
                                                <div class="media-body">
                                                    <h3 class="dropdown-item-title ">
                                                        <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                            <span class="float-right badge badge-danger">New</span>
                                                        <?php }   ?>
                                                        <?php echo $value["header"]; ?>
                                                    </h3>
                                                    <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                                    <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                                    <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>

                                                        <?php $user = User::find()->where(['id' => $value["id_pengirim"]])->one(); ?>
                                                        <?php echo $user["username"]; ?>
                                                    </p>
                                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                                </div>
                                            </div>
                                            <!-- Message End -->
                                        </a>
                                    <?php } ?>

                                    <div class="dropdown-divider"></div>
                                <?php } ?>
                                <?php if ($value['id_sm'] != "0") { ?>
                                    <div class=" my-custom-scrollbar">
                                        <a href="<?= Url::toRoute(['suratmasuk/smdisposisi', 'id_sm' => $value->id_sm]) ?>" class="dropdown-item">
                                            <!-- Message Start -->
                                            <div class="media">
                                                <div class="media-body">
                                                    <h3 class="dropdown-item-title ">
                                                        <?php if ($value["status"] ==  "belum dibaca") { ?>
                                                            <span class="float-right badge badge-danger">New</span>
                                                        <?php }   ?>
                                                        <?php echo $value["header"]; ?>
                                                    </h3>
                                                    <?php $tampil_sebagian  = substr($value["isi"], 0, 30); ?>
                                                    <p class="text-sm">Perihal : <?php echo $tampil_sebagian ?> </p>
                                                    <p class="text-sm text-muted"><i class="fa fa-paper-plane"> :</i>
                                                        <?php $status = Smpenerima::find()->where(['id_sm' => $value, 'id_penerima' => Yii::$app->user->identity->id])->one(); ?>
                                                        <?php $user = User::find()->where(['id' => $status["id_pengirim"]])->one(); ?>
                                                        <?php echo $user["username"]; ?>
                                                    </p>
                                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo $value["created_at"]; ?></p>
                                                </div>
                                            </div>
                                            <!-- Message End -->
                                        </a>
                                        <div class="dropdown-divider"></div>
                                    <?php } ?>
                                <?php endforeach; ?>

                                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class=" dropdown user user-menu">
                    <a data-toggle="dropdown" class="nav-link">
                        <?php if (!Yii::$app->user->identity->foto) { ?>

                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                        <?php } else { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="user-image" alt="User Image">

                        <?php } ?>

                        <?= Yii::$app->user->identity->username ?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background-color: #0093dd;">
                            <?php if (!Yii::$app->user->identity->foto) { ?>

                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                                <!-- //"// Url::toRoute(['upload/user/' . $value->foto]) " -->
                            <?php } else { ?>
                                <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="img-circle elevation-2" alt="User Image">

                            <?php } ?>
                            <p>
                                <?= Yii::$app->user->identity->username ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="<?= Url::toRoute(['user/index']) ?>" class="btn btn-default btn-flat">Profile</a>
                            <a href="<?= Url::toRoute(['site/logout']) ?>" class="btn btn-default btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= Url::toRoute(['/']) ?>" class="brand-link">
                <img src="<?= Yii::$app->getHomeUrl(); ?>dist/img/350-MAN_2_PADANG.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MAN2</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <?php if (!Yii::$app->user->identity->foto) { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        <?php } else { ?>
                            <img src="<?= Yii::$app->getHomeUrl(); ?>upload/user/<?= Yii::$app->user->identity->foto ?>" class="img-circle elevation-2" alt="User Image">

                        <?php } ?>
                    </div>
                    <div>
                        <?php
                        if (Yii::$app->user->isGuest) {
                        } else {
                            echo Html::beginForm(['/user/index'])
                                . Html::submitButton(
                                    ' ' . Yii::$app->user->identity->username . '',
                                    ['class' => 'btn  btn-dark text-decoration-none']
                                )
                                . Html::endForm();
                        }
                        ?>
                    </div>
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= Url::toRoute(['/']) ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Surat
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if (Yii::$app->user->identity->role == "admin" || Yii::$app->user->identity->role == "tu") { ?>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">
                                            <i class="nav-icon  fa fa-plus-square"></i>
                                            <p>
                                                Buat Surat
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['suratmasuk/smterkirim']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Surat Masuk Terkirim</p>
                                        </a>
                                    </li>

                                <?php } ?>
                                <li class="nav-item">
                                    <a href="<?= Url::toRoute(['suratmasuk/index']) ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Surat Masuk</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= Url::toRoute(['informasisurat/index']) ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Surat Baru</p>
                                    </a>
                                </li>
                                <?php if (Yii::$app->user->identity->role == "kepsek" || Yii::$app->user->identity->role == "admin") { ?>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['tandatangan/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tandatangan Surat</p>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php if (Yii::$app->user->identity->role == "admin") { ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Master
                                        <i class="fas fa-angle-left right"></i>

                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['site/user']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['asalsurat/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Asal Surat</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['jabatan/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jabatan</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['role/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Role</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= Url::toRoute(['naskahdinas/index']) ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>naskah dinas</p>
                                        </a>
                                    </li>
                                </ul>

                            </li>

                        <?php } ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="modal fade bd-example-modal-sm" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembuatan Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <div class=""> <a href="<?= Url::toRoute(['suratmasuk/create']) ?>" style="background-color: #0093dd;" class="btn  btn-lg active" role="button" aria-pressed="true">Surat&nbsp;Masuk</a></div>
                        <div style="padding-top: 8px;"> <a href="<?= Url::toRoute(['informasisurat/create']) ?>" class="btn btn-success btn-lg active" role="button" aria-pressed="true">&nbsp;&nbsp;Surat Baru&nbsp;&nbsp;</a></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Footer -->
        <footer class="main-footer">

        </footer>
        <main role="main" class="flex-shrink-0">
            <div class="content-wrapper">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>
    </div>
    <!-- jQuery -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/moment/moment.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>dist/js/adminlte.js"></script>
    <!-- jQuery -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= Yii::$app->getHomeUrl(); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src=<?= Url::toRoute(['signature/jSignature-master/libs/jSignature.min.js']) ?>></script>

    <script src="<?= Yii::$app->getHomeUrl(); ?>ckeditor/ckeditor.js" ?>
        >
    </script>
    <script>
        CKEDITOR.replace('content1', {
            width: 832,
            height: 1060,
            filebrowserUploadUrl: "<?= Url::toRoute(['site/upload-ckeditor']) ?>",
            filebrowserUploadMethod: 'form',

            fullPage: true,
            allowedContent: true,
        });
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
