<?php
namespace frontend\controllers;

use common\models\Tweets;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\base\Response;
use common\models\Like;

/**
 * Site controller
 */
class AjaxController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */


    public function actionLike()
    {
        $tweet_id = Yii::$app->request->post('id');
        $user_id = Yii::$app->user->id;

        $response = new \stdClass();
        $response->status = 'error';


        if($tweet_id){

            if(!Like::isLikeExist($tweet_id,$user_id)){

                $like = Like::addLike($tweet_id,$user_id);
                $response->like = true;
            }
            else{

                $like = Like::deleteLike($tweet_id,$user_id);
                $response->like = false;
            }
            if($like) {

                $response->id = (int)$tweet_id;
                $response->status = 'success';
                $response->like_count = (int)Like::likeCount($tweet_id);
            }

        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $response;
    }



}
