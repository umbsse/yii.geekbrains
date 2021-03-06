<?php
namespace backend\controllers;

use common\models\Tweet;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\Tweets;
use yii\helpers\Url;

/**
 * Site controller
 */
class TweetController extends Controller
{
    /**
     * @inheritdoc
     */
    public $layout = "admin.php";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
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

        $tweets = Tweets::find()
            ->joinWith('user')
            ->all();

        $model = new Tweets();

        /*$post = Yii::$app->request->post("Tweets");
        if($post){

            $model->text = $post["text"];
            $model->user_id = Yii::$app->user->id;
            if($model->save()){
                //$model = new Tweets();
                return $this->redirect(Url::to(['tweet/index']));

            }
        }*/

        return $this->render('index',[
            'tweets' => $tweets,
            'model'=> $model

        ]);
    }

    public function actionDelete($id = null, $confirm = null)
    {

        if (!$id) {

            throw new \yii\web\NotFoundHttpException();
        }

        if (($id)&&($confirm === 'yes')) {

            $tweet = Tweets::findOne($id);
            $tweet->delete();

            return $this->redirect(Url::to(['tweet/index']));
        }
        return $this->render('delete',[
            'id'=>$id,
        ]);
    }

}
