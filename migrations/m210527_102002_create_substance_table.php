<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%substance}}`.
 */
class m210527_102002_create_substance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%substance}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование'),
            'description' => $this->text()->notNull()->comment('Описание'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%substance}}');
    }
}
