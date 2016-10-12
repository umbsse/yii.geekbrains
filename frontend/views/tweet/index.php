<?php

/* @var $this yii\web\View */
/* @var $tweets \common\models\Tweets[]*/
/* @var $model \common\models\Tweets*/

use yii\helpers\Html;
use frontend\assets\TweetAsset;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Tweets;

$this->title = 'Yii Tweets';

$like_url = Url::to(['ajax/like']);


$this->registerJs(<<<JS
    $(".like-btn").click(
        function() {
            $.ajax(
                {
                    url : "{$like_url}",
                    type : "POST",
                    data : {id: $(this).data("id")},
                    dataType: 'json',
                    context: $(this)
                }
                
            ).done(
                function(msg) {
                    if(msg.status =="success"){                        

                        var like = $(this).children("i");
                        like.text(msg.like_count);
                        if (msg.like){
                            like.removeClass("not-liked");
                            like.addClass("liked");
                        }
                        else{
                            like.removeClass("liked");
                            like.addClass("not-liked");
                        }
                    }
                }
            );
        }
    );
JS
);

?>

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
                <a class="btn btn-info" href="<?=Url::to(['tweet/one','id'=>$tweet->id]) ?>">Read more </a>
                <!-------<a class="blog-post-share pull-right like-btn" href="#">
                    <i class="fa fa-thumbs-up fa-2x liked" aria-hidden="true"></i>
                </a>---------->
                <button class="btn like-btn pull-right" data-id="<?=$tweet->id ?>">

                    <?php
                    if($tweet->like["tweet_id"]){?>

                        <i class="fa fa-thumbs-up fa-2x liked" aria-hidden="true"><?= $tweet->like_count?></i>
                    <?php
                    }
                    else
                    {?>
                        <i class="fa fa-thumbs-up fa-2x not-liked" aria-hidden="true"><?= $tweet->like_count?></i>
                    <?php
                    }?>
                </button>
            </div>
        </div>
    </div>
</section>
<?php }?>