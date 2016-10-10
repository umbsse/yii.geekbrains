<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%static_pages}}".
 *
 * @property integer $id
 * @property string $url_slug
 * @property string $title
 * @property string $text
 */
class StaticPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%static_pages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url_slug'], 'required'],
            [['url_slug', 'title', 'text'], 'string', 'max' => 255],
            [['url_slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_slug' => 'Url Slug',
            'title' => 'Title',
            'text' => 'Text',
        ];
    }

    public static function getPage($page_slug){


        $url = static::find()->where(['url_slug'=>$page_slug])->one();

        if($url){

            $page = explode('/',$url->slug_url);

            return $page[count($page)-1];
        }
        return false;

    }
}
