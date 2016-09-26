<?php
namespace frontend\controllers;

use common\models\Tweet;
use Yii;
use yii\web\Controller;


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
        $tweets = Tweet::find()->all();

        return $this->render('index',[
            'tweets' => $tweets

        ]);
    }

    public function actionOne()
    {
        $id = Yii::$app->request->get('id');
        if ($id) {
            $tweets[] = Tweet::find()->where(['id' => $id])->one();
        }
        else $tweets = [];

        return $this->render('index',[
            'tweets' => $tweets

        ]);
    }
}
