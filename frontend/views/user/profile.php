<?php

/* @var $this yii\web\View */
/* @var $tweets \common\models\Tweet[]*/
/* @var $user User*/
/* @var $is_subscribed bool*/

use yii\helpers\Html;
use frontend\assets\TweetAsset;
use common\models\User;
use common\models\Subscribe;
use yii\helpers\Url;

$this->title = $user->username.' Tweets';


?>



<div class="col-sm-8 blog-main">

    <section class="blog-post">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="blog-post-content">
                    <h2 class="blog-post-title"><?=$user->username?> Profile</h2>

                     <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        </blockquote>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/img/technology/unsplash-1.jpg" class="img-responsive" />
                        </div>
                        <div class="col-md-4">
                            <?php if($user->id === Yii::$app->user->id){?>
                                <h3>My Profile</h3>

                            <?php
                            }
                            else{
                                if (!$is_subscribed) { ?>
                                    <a class="btn btn-info" href="<?= Url::to(['user/subscribe', 'id' => $user->id]) ?>">Subscribe</a>
                                    <?php
                                }
                                else{?>

                                    <a class="btn btn-info" href="<?= Url::to(['user/unsubscribe', 'id' => $user->id]) ?>">UnSubscribe</a>
                                <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">

                        <h3>Tweets</h3>
                    </div>
                    <div class="row">
                        <?php foreach ($tweets as $tweet){?>
                            <section class="blog-post">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="blog-post-meta">
                                            <a href="<?=Url::to(['user/profile','id'=>$tweet->user_id]) ?>">
                                                <span class="label label-light label-primary"><?= $tweet->user["username"]?></span>
                                            </a>
                                        </div>
                                        <div class="blog-post-content">
                                            <a href="<?=Url::to(['tweet/one','id'=>$tweet->id]) ?>">
                                                <h2 class="blog-post-title"><?= $tweet->text?></h2>
                                            </a>
                                            <a class="btn btn-info" href="<?=Url::to(['tweet/one','id'=>$tweet->id]) ?>">Read more</a>
                                            <a class="blog-post-share pull-right" href="#">
                                                <i class="material-icons">&#xE80D;</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php }?>
                    </div>


                </div>
            </div>
        </div>
    </section><!-- /.blog-post -->

</div><!-- /.blog-main -->