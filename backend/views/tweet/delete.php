<?php
use yii\helpers\Html;
use frontend\assets\TweetAsset;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user \common\models\User*/
/* @var $id integer */
/* @var $count_tweets integer */

?>
<h3>Delete tweet ?</h3>

<a href="<?=Url::to(['tweet/index']) ?>"><button type="button" class="btn btn-default">Cancel</button></a>
<a href="<?=Url::to(['tweet/delete','id'=>$id, 'confirm'=>'yes']) ?>"><button type="button" class="btn btn-danger">Delete</button></a>
