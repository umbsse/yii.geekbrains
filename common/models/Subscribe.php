<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subscribe}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $subscribe_user_id
 *
 * @property User $user
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subscribe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'subscribe_user_id'], 'integer'],
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
            'user_id' => 'User ID',
            'subscribe_user_id' => 'Subscribe User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return bool
     */

    public static function addSubscribe($user_id, $subscribed_to){


        if($user_id === $subscribed_to){
            return false;
        }

        if (Subscribe::isSubscribed($user_id, $subscribed_to)) {
            return false;
        }

        $sub = new Subscribe();
        $sub->user_id = $user_id;
        $sub->subscribe_user_id = $subscribed_to;
        if($sub->save()){
            return true;
        }
        return false;

    }

    public static function delSubscribe($user_id, $subscribed_to){


        if($user_id === $subscribed_to){
            return false;
        }

        if (Subscribe::isSubscribed($user_id, $subscribed_to)) {

            $sub = Subscribe::find()->where('user_id='.$user_id.' and subscribe_user_id='.$subscribed_to)->one();
            if($sub->delete()){
                return true;
            }
        }

        return false;

    }


    /**
     * @return array
     */

    public static function getSubscribe($user_id){


        return Subscribe::find()->where(['user_id'=>$user_id])->asArray()->all();
    }

    /**
     * @return bool
     */

    public static function isSubscribed($user_id, $subscribed_to){

        return Subscribe::find()->where(['user_id'=>$user_id,
                                    'subscribe_user_id'=> $subscribed_to])->all();


    }

}
