<?php

use yii\db\Migration;

class m161006_072926_t_tweets_subscribe extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscribe}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'subscribe_user_id' => $this->integer(),
        ], $tableOptions);

        $this->createIndex("user_subscribe", "{{%subscribe}}", "user_id");
        $this->addForeignKey("FK_user_subscribe", "{{%subscribe}}", "user_id", "{{%user}}", "id");
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_user_subscribe", "{{%subscribe}}");
        $this->dropTable('{{%subscribe}}');
    }
}
