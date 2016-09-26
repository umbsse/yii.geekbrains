<?php

/* @var $this yii\web\View */
/* @var $tweets \common\models\Tweet[]*/

$this->title = 'Yii Tweets';

//var_dump($tweets);
//die();
?>

<?php foreach ($tweets as $tweet){?>
<section class="blog-post">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="blog-post-meta">
                <span class="label label-light label-primary"><?= $tweet->id?></span>
                <!-------<p class="blog-post-date pull-right">January 24, 2016</p>--->
            </div>
            <div class="blog-post-content">
                <a href="index.php?r=tweet%2Fone&id=<?=$tweet->id?>">
                    <h2 class="blog-post-title"><?= $tweet->text?></h2>
                </a>
                <p>Donec ut libero sed arcu vehicula ultricies a non tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ut gravida lorem.</p>
                <a class="btn btn-info" href="index.php?r=tweet%2Fone&id=<?=$tweet->id?>">Read more</a>
                <a class="blog-post-share pull-right" href="#">
                    <i class="material-icons">&#xE80D;</i>
                </a>
            </div>
        </div>
    </div>
</section>
<?php }?>