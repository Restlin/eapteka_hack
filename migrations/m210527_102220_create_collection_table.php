<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%collection}}`.
 */
class m210527_102220_create_collection_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%collection}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование'),
            'store_id' => $this->integer()->notNull()->comment('Аптека'),
            'price' => $this->decimal(10, 2)->comment('Стоимость'),
        ]);

        $tableName = "collection";
        $this->addForeignKey("fk_{$tableName}_store_id", $tableName, 'store_id', 'store', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_store_id", $tableName, 'store_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%collection}}');
    }
}
