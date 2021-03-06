<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
        ], $tableOptions);

        $this->insert('user', [
            'username' => 'calcionit',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('metaleiro'),
            'email' => 'calcionit@gmail.com',
            'status' => '10',
        ]);

        $this->insert('user', [
            'username' => 'keylla',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('kcac1985'),
            'email' => 'keyllacorrea@yahoo.com.br',
            'status' => '10',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
