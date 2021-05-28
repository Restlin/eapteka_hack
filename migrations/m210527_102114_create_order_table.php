<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m210527_102114_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'store_id' => $this->integer()->notNull()->comment('Аптека'),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'price' => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
            'date' => $this->dateTime()->notNull()->comment('Время заказа'),
            'complete' => $this->boolean()->notNull()->defaultValue(false)->comment('Признак оплаты'),
        ]);

        $tableName = "order";
        $this->addForeignKey("fk_{$tableName}_store_id", $tableName, 'store_id', 'store', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_store_id", $tableName, 'store_id');
        $this->addForeignKey("fk_{$tableName}_user_id", $tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id", $tableName, 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
