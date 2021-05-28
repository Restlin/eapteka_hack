<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210202_080058_create_user_table extends Migration
{
    const ROLE_USER = 1;
    const TYPE_CHILD = 1;
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

        $this->createTable('{{%user_family}}', [
            'id' => $this->primaryKey(),
            'user_id1' => $this->integer()->notNull()->comment('Пользователь'),
            'user_id2' => $this->integer()->notNull()->comment('Родственник'),
            'role' => $this->integer()->notNull()->defaultValue(self::TYPE_CHILD)->comment('Тип связи'),
        ]);

        $tableName = "user_family";
        $this->addForeignKey("fk_user_family_user_id1", $tableName, 'user_id1', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_user_family_user_id1", $tableName, 'user_id1');
        $this->addForeignKey("fk_user_family_user_id2", $tableName, 'user_id2', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id2", $tableName, 'user_id2');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_family}}');
        $this->dropTable('{{%user}}');
    }
}
