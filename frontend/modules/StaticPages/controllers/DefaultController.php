<?php

namespace app\modules\StaticPages\controllers;

use common\models\StaticPages;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `StaticPages` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public $layout = "@app/views/layouts/tweet.php";

    public function actionIndex()
    {

        $static = StaticPages::find()->where(['url_slug'=>Yii::$app->request->url])->one();

        if($static){

            $page = explode('/',Yii::$app->request->url);

            return $this->render($page[count($page)-1],[
                'static'=>$static
            ]);
        }

        throw new \yii\web\NotFoundHttpException();
    }
}
