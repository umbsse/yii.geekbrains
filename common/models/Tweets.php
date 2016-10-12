<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%tweets}}".
 *
 * @property integer $id
 * @property string $text
 * @property string $image
 * @property integer $user_id
 *
 * @property User $user
 * @property Like $like
 */
class Tweets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $like_count;

    public static function tableName()
    {
        return '{{%tweets}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['text', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'image' => 'Image',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getLike()
    {
        return $this->hasOne(Like::className(), ['tweet_id' => 'id']);
    }

    public static function getUserTweets($user_id)
    {

        return static::find()
            ->joinWith('user')
            ->where(['user_id' => $user_id])
            ->orderBy(['published' => SORT_DESC])
            ->all();
    }

    public static function getAllTweets()
    {

        return static::find()
            ->joinWith('user')
            ->joinWith('like')
            ->addSelect(static::tableName().'.*, COUNT(tweet_id) AS like_count')
            ->groupBy(static::tableName().'.id')
            ->orderBy(['published' => SORT_DESC])
            ->all();
    }

    public static function getTweetsWithSubscribe($user_id)
    {

        $query = static::find()->joinWith('user')->where(['user_id' => $user_id]);

        $subscribed = Subscribe::getSubscribe($user_id);

        if ($subscribed){
            foreach ($subscribed as $s){

                $query = $query->orWhere(['user_id' => $s['subscribe_user_id']]);
            }

        }

        return $query->orderBy(['published' => SORT_DESC])->all();


        /*$where_str = 'user_id='.$user_id;

        $subscribed = Subscribe::getSubscribe($user_id);

        if ($subscribed){
            foreach ($subscribed as $s){

                $where_str.=' or user_id='.$s['subscribe_user_id'];
            }

        }

        return static::find()
            ->joinWith('user')
            ->where($where_str)
            ->all();*/
    }



}
