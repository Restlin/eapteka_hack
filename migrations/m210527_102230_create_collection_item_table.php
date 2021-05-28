<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%collection_item}}`.
 */
class m210527_102230_create_collection_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%collection_item}}', [
            'id' => $this->primaryKey(),
            'collection_id' => $this->integer()->notNull()->comment('Коллекция'),
            'item_id' => $this->integer()->notNull()->comment('Товар'),
            'amount' => $this->integer()->notNull()->comment('Количество'),
        ]);

        $tableName = "collection_item";
        $this->addForeignKey("fk_{$tableName}_collection_id", $tableName, 'collection_id', 'collection', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_collection_id", $tableName, 'collection_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%collection_item}}');
    }
}
