<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $tweets \common\models\Tweets[] */

$this->title = 'Tweets';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table user-list table-hover">
                        <thead>
                        <tr>
                            <th><span>Tweet</span></th>
                            <th><span>Published</span></th>
                            <th><span>User</span></th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        foreach ($tweets as $t){

                            ?>
                            <tr>
                                <td>
                                    <?= $t->text ?>
                                </td>
                                <td>
                                    <?= Yii::$app->formatter->asDate($t->published, 'd.M.Y') ?>
                                </td>
                                <td>
                                    <a href="#"><?= $t->user->username ?></a>
                                </td>
                                    <td style="width: 20%;">
                                        <a href="#" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-search-plus fa-stack-1x fa-inverse"></i>
                                    </span>
                                        </a>
                                        <a href="#" class="table-link">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                    </span>
                                        </a>

                                        <a href="<?= Url::to(['tweet/delete','id'=>$t->id])?>" class="table-link danger">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                    </span>
                                        </a>
                                    </td>
                            </tr>

                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
