<?php

/* @var $this yii\web\View */
/* @var $users \common\models\User[] */

use yii\helpers\Url;

$this->title = 'Users';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box no-header clearfix">
            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table user-list table-hover">
                        <thead>
                        <tr>
                            <th><span>User</span></th>
                            <th><span>Created</span></th>
                            <th class="text-center"><span>Status</span></th>
                            <th><span>Email</span></th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        foreach ($users as $u){

                        ?>
                        <tr>
                            <td>
                                <img src="img/samples/scarlet-159.png" alt=""/>
                                <a href="#" class="user-link"><?= $u->username ?></a>
                                <span class="user-subhead">Admin</span>
                            </td>
                            <td>
                                <?= Yii::$app->formatter->asDate($u->created_at, 'd.M.Y') ?>
                            </td>
                            <td class="text-center">
                                <span class="label label-default">Inactive</span>
                            </td>
                            <td>
                                <a href="#"><?= $u->email ?></a>
                            </td>
                            <form>
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

                                <a href="<?= Url::to(['users/delete','id'=>$u->id])?>" class="table-link danger">
                                    <span class="fa-stack">
                                        <i class="fa fa-square fa-stack-2x"></i>
                                        <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </td>
                            </form>
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
