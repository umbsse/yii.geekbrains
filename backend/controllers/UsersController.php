<?php
namespace backend\controllers;

use common\models\Tweet;
use common\models\Tweets;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use yii\helpers\Url;

/**
 * Site controller
 */
class UsersController extends Controller
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

        $users = User::find()->all();

        return $this->render('index',[
                "users"=>$users
            ]);
    }

    public function actionDelete($id = null, $confirm = null)
    {

        //$id = Yii::$app->request->get('id');
        //$confirm = Yii::$app->request->get('confirm');

        if ($id) {

            $user = User::findOne($id);
            $tweets = Tweets::find()->where(['user_id'=>$id])->all();

        }
        else{
            throw new \yii\web\NotFoundHttpException();
        }

        if (($id)&&($confirm === 'yes')) {

            foreach ($tweets as $t){

                $t->delete();
            }

            $user->delete();
            return $this->redirect(Url::to(['users/index']));
        }
        return $this->render('delete',[
            'id'=>$id,
            'user'=>$user,
            'count_tweets'=>count($tweets)
            ]);
    }

    public function actionBan()
    {

        $users = User::find()->all();

        return $this->render('index',[
            "users"=>$users
        ]);
    }

}
