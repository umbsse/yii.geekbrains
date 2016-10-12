<?php

use yii\db\Migration;

class m161010_083733_t_like extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%like}}', [
            'user_id' => $this->integer(),
            'tweet_id' => $this->integer(),
        ], $tableOptions);

        $this->addPrimaryKey('user_tweet', '{{%like}}', ['user_id', 'tweet_id']);
        $this->createIndex("index_user_tweet", "{{%like}}", ['user_id', 'tweet_id']);
        $this->addForeignKey("FK_user", "{{%like}}", "user_id", "{{%user}}", "id");
        $this->addForeignKey("FK_tweet", "{{%like}}", "tweet_id", "{{%tweets}}", "id");
    }

    public function safeDown()
    {
        $this->dropForeignKey("FK_tweet", "{{%like}}");
        $this->dropForeignKey("FK_user", "{{%like}}");
        $this->dropTable('{{%like}}');
    }
}
