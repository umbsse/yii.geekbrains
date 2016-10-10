<?php

use yii\db\Migration;

class m161009_155950_static_page extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%static_pages}}', [
            'id' => $this->primaryKey(),
            'url_slug' => $this->string()->notNull()->unique(),
            'title' => $this->string(),
            'text' => $this->string(),
        ], $tableOptions);

        $page = new \common\models\StaticPages();
        $page->url_slug = "/one";
        $page->title = "First Static Page";
        $page->text = "First Static Page";
        $page->save();
        $page = new \common\models\StaticPages();
        $page->url_slug = "/two";
        $page->title = "Second Static Page";
        $page->text = "Second Static Page";
        $page->save();
     }

    public function safeDown()
    {
        $this->dropTable('{{%static_pages}}');
    }
}
