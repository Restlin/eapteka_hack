<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m210527_102127_create_order_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull()->comment('Заказ'),
            'item_id' => $this->integer()->notNull()->comment('Товар'),
            'amount' => $this->integer()->notNull()->comment('Количество'),
            'price' => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
        ]);

        $tableName = "order_item";
        $this->addForeignKey("fk_{$tableName}_order_id", $tableName, 'order_id', 'order', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_order_id", $tableName, 'order_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
    }
}
