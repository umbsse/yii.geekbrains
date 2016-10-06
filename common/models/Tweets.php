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
 */
class Tweets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
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


    public static function getTweets($user_id)
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
            ->orderBy(['published' => SORT_DESC])
            ->all();
    }

    public static function getTweetsWithSubscribe($user_id)
    {

        $where_str = 'user_id='.$user_id;

        $subscribed = Subscribe::getSubscribe($user_id);

        if ($subscribed){
            foreach ($subscribed as $s){

                $where_str.=' or user_id='.$s['subscribe_user_id'];
            }

        }

        return static::find()
            ->joinWith('user')
            ->where($where_str)
            ->all();
    }



}
