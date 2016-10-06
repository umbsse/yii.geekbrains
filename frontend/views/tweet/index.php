<?php

/* @var $this yii\web\View */
/* @var $tweets \common\models\Tweet[]*/

use yii\helpers\Html;
use frontend\assets\TweetAsset;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\Tweets;

$this->title = 'Yii Tweets';


?>
<?php
if (!Yii::$app->user->isGuest) {?>
<section class="blog-post">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="blog-post-content">
            <?php
                $form = ActiveForm::begin([
                    'id' => 'tweet-form',
                    'options' => ['class' => 'form-horizontal'],
                ]);
                ?>
                <?= $form->field($model,'text')->textInput() ?>
                <?= Html::submitButton('Send tweet', ['class' => 'btn btn-primary']) ?>
                <?php
                ActiveForm::end();
                ?>

            </div>
        </div>
    </div>
</section>

<?php
}
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
                <a class="btn btn-info" href="<?=Url::to(['tweet/one','id'=>$tweet->id]) ?>">Read more</a>
                <a class="blog-post-share pull-right" href="#">
                    <i class="material-icons">&#xE80D;</i>
                </a>
            </div>
        </div>
    </div>
</section>
<?php }?>