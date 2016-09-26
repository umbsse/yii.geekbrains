<?php
namespace backend\controllers;

use common\models\Tweet;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class TweetController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "tweet.php";

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
     * @return string
     */
    public function actionIndex()
    {
        $tweeet = new Tweet();
        $tweeet->text = Yii::$app->formatter->asDate('now', 'd-M-Y H:i:s');;
        $tweeet->save();

        return $this->render('index');
    }


}
