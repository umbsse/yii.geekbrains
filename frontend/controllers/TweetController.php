<?php
namespace frontend\controllers;

use common\models\Tweets;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;


/**
 * Tweet controller
 */
class TweetController extends Controller
{
    public $layout = "tweet.php";
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
    public function actionIndex()
    {

        $tweets = Tweets::getAllTweets();

        $model = new Tweets();

        return $this->render('index',[
            'tweets' => $tweets,
            'model'=> $model

        ]);
    }

    public function actionAddTweet(){

        $tweets = Tweets::getAllTweets();

        $model = new Tweets();

        $post = Yii::$app->request->post("Tweets");

        if($post){

            $model->text = $post["text"];
            $model->user_id = Yii::$app->user->id;
            if($model->save()){
                //$model = new Tweets();
                return $this->redirect(Url::to(['tweet/index']));

            }
        }

        return $this->render('add-tweet',[
            'tweets' => $tweets,
            'model'=> $model

        ]);


    }

    public function actionOne()
    {
        $id = Yii::$app->request->get('id');
        if ($id) {
            $tweets[] = Tweets::find()->where(['id' => $id])->one();
        }
        else $tweets = [];
        $model = new Tweets();
        return $this->render('one',[
            'tweets' => $tweets,
            'model' => $model

        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
