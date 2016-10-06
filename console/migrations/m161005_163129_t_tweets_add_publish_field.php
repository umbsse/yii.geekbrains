<?php

use yii\db\Migration;

class m161005_163129_t_tweets_add_publish_field extends Migration
{
    public function safeUp()
    {
        $this->addColumn("{{%tweets}}","published",$this->timestamp());
    }
    public function safeDown()
    {
        $this->dropColumn("{{%tweets}}","published");
    }
}
