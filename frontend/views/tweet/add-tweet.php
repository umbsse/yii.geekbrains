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


?>
<?php
if (!Yii::$app->user->isGuest) {?>
<section class="blog-post">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="blog-post-content">
            <?php
                $form = ActiveForm::begin([
                    'action' =>['tweet/add-tweet'],
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
