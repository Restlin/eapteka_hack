<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210202_080058_create_user_table extends Migration
{
    const ROLE_USER = 1;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(150)->notNull()->comment('ФИО'),
            'email' => $this->string(50)->notNull()->unique()->comment('Email'),
            'password_hash' => $this->string(64)->comment('Хеш пароля'),
            'role' => $this->integer()->notNull()->defaultValue(self::ROLE_USER)->comment('Роль'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
