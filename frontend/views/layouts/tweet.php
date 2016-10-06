<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\TweetAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\models\User;
use yii\helpers\Url;

TweetAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="navbar navbar-material-blog navbar-primary navbar-absolute-top">

    <div class="navbar-image" style="background-image: url('img/technology/unsplash-6.jpg');background-position: center 40%;"></div>

    <div class="navbar-wrapper container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><i class="material-icons">&#xE871;</i> Yii2 Tweets</a>
        </div>

        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li class="active dropdown">
                    <a href="<?=Url::to(['user/feed']) ?>">My Feed </a>
                </li>
                <li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Filters <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="filter-category.html">Category</a></li>
                        <li><a href="filter-author.html">Author</a></li>
                        <li><a href="filter-date.html">Date</a></li>
                    </ul>
                </li>
                <!------<li class="dropdown">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Post <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="post-image.html">Image post</a></li>
                        <li><a href="post-video.html">Video post</a></li>
                    </ul>
                </li>
                <li><a href="page-about.html">About</a></li>
                <li><a href="page-contact.html">Contact</a></li>
                <li class="dropdown hidden-sm">
                    <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Documentation <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="doc-buttons.html">Buttons</a></li>
                        <li><a href="doc-forms.html">Forms</a></li>
                        <li><a href="doc-icons.html">Icons</a></li>
                        <li><a href="doc-indicators.html">Indicators</a></li>
                        <li><a href="doc-navbars.html">Navbars</a></li>
                        <li><a href="doc-panels.html">Panels</a></li>
                        <li><a href="doc-tables.html">Tables</a></li>
                        <li><a href="doc-typography.html">Typography</a></li>
                    </ul>
                </li>------>
            </ul>
            <ul class="nav navbar-nav navbar-right bold">
                <!-----<li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>---->
                <?php
                if (Yii::$app->user->isGuest) {?>
                    <li><a href="<?= \yii\helpers\Url::to(['user/signup']) ?>"> <b>Signup</b></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['user/login']) ?>"> <b>Login</b></a></li>
                <?php
                } else {
                ?>
                    <li><a href="<?= \yii\helpers\Url::to(['user/logout']) ?>" data-method="post"><b> Logout <?=Yii::$app->user->identity->username ?> </b></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="container blog-content">

    <?= $content ?>

</div><!-- /.container -->

<footer class="blog-footer">

    <div id="links">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <i class="material-icons brand">&#xE871;</i>
                </div>

                <div class="col-sm-8 text-center offset">
                    <ul class="list-inline">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="page-about.html">About</a></li>
                        <li><a href="doc-buttons.html">Documentation</a></li>
                        <li><a href="page-contact.html">Contact</a></li>
                    </ul>
                </div>

                <div class="col-md-2 text-right offset">
                    <ul class="list-inline">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</footer>

<button class="material-scrolltop primary" type="button"></button>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>