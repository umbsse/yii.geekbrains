<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%like}}".
 *
 * @property integer $user_id
 * @property integer $tweet_id
 *
 * @property Tweets $tweet
 * @property User $user
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%like}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tweet_id'], 'required'],
            [['user_id', 'tweet_id'], 'integer'],
            [['tweet_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tweets::className(), 'targetAttribute' => ['tweet_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'tweet_id' => 'Tweet ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTweet()
    {
        return $this->hasOne(Tweets::className(), ['id' => 'tweet_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /*public static function addLike($user_id, $tweet_id){

        $user = User::findOne($user_id);
        $tweet = Tweets::findOne($tweet_id);

        if($user && $tweet){

            $if_like_exist = static::find()->where(['user_id'=>$user_id,'tweet_id'=>$tweet_id])->one();

            if(!$if_like_exist) {
                $like = new Like();
                $like->user_id = $user_id;
                $like->tweet_id = $tweet_id;
                if ($like->save()) {
                    return $like;
                }
            }
            else{

                static::deleteLike($user_id, $tweet_id);
            }
        }
        return false;
    }

    public static function deleteLike($user_id, $tweet_id){


        return false;
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            return true;
        }
        return false;
    }*/

    public static function isLikeExist($tweet_id, $user_id = null ){

        if ($user_id === null) $user_id = Yii::$app->user->id;

        return static::find()->where(['user_id'=>$user_id,'tweet_id'=>$tweet_id])->one();
    }

    public static function addLike($tweet_id, $user_id = null){

        if (Yii::$app->user->isGuest) return false;
        if ($user_id === null) $user_id = Yii::$app->user->id;

        if(!static::isLikeExist($tweet_id, $user_id)) {


                $like = new Like();
                $like->user_id = $user_id;
                $like->tweet_id = $tweet_id;
                if ($like->save()) {
                    return $like;
                }
            }
        return false;
    }

    public static function deleteLike($tweet_id, $user_id = null){

        if (Yii::$app->user->isGuest) return false;
        if ($user_id === null) $user_id = Yii::$app->user->id;

        $like = static::isLikeExist($tweet_id, $user_id);
        if($like) {
            $like->delete();
            return true;
        }
        return false;
    }

    public static function likeCount($tweet_id){

        return static::find()->where(['tweet_id'=>$tweet_id])->count();
    }


}
