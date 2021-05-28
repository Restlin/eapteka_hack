<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store}}`.
 */
class m210527_102048_create_store_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование'),
            'address' => $this->string(300)->notNull()->comment('Адрес'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store}}');
    }
}
