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
<h3>Delete user <?=$user->username?> ?</h3>
<h4>This user has <?=$count_tweets?> tweets, all tweets will be removed</h4>
<a href="<?=Url::to(['users/index']) ?>"><button type="button" class="btn btn-default">Cancel</button></a>
<a href="<?=Url::to(['users/delete','id'=>$id, 'confirm'=>'yes']) ?>"><button type="button" class="btn btn-danger">Delete</button></a>
