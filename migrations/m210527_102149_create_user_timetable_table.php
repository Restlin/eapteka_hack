<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_timetable}}`.
 */
class m210527_102149_create_user_timetable_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_timetable}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'date' => $this->dateTime()->notNull()->comment('Время события'),
            'content' => $this->text()->notNull()->comment('Содержание события'),
            'item_id' => $this->integer()->notNull()->comment('Товар'),
            'type' => $this->integer()->notNull()->comment('Тип'),
            'complete' => $this->boolean()->notNull()->defaultValue(false)->comment('Завершено'),
        ]);

        $tableName = "user_timetable";
        $this->addForeignKey("fk_{$tableName}_user_id", $tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id", $tableName, 'user_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_timetable}}');
    }
}
