<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_item}}`.
 */
class m210527_102103_create_store_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_item}}', [
            'id' => $this->primaryKey(),
            'store_id' => $this->integer()->notNull()->comment('Аптека'),
            'item_id' => $this->integer()->notNull()->comment('Товар'),
            'price' => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
            'amount' => $this->integer()->notNull()->comment('Количество'),
        ]);

        $tableName = "store_item";
        $this->addForeignKey("fk_{$tableName}_store_id", $tableName, 'store_id', 'store', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_store_id", $tableName, 'store_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_item}}');
    }
}
