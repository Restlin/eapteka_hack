<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prescription_item}}`.
 */
class m210527_102014_create_prescription_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%prescription_item}}', [
            'id' => $this->primaryKey(),
            'prescription_id' => $this->integer()->notNull()->comment('Рецепт'),
            'substance_id' => $this->integer()->notNull()->comment('Активное вещество'),
            'dose' => $this->float()->notNull()->comment('Доза активного вещества'),
        ]);

        $this->insert('{{%prescription_item}}', [ //тестовый рецепт на Уму
            'prescription_id' => 1,
            'substance_id' => 2,
            'dose' => 9
        ]);
        $this->insert('{{%prescription_item}}', [ //тестовый рецепт на Уму
            'prescription_id' => 1,
            'substance_id' => 10,
            'dose' => 200
        ]);
        $this->insert('{{%prescription_item}}', [ //тестовый рецепт на Уму
            'prescription_id' => 1,
            'substance_id' => 11,
            'dose' => 1
        ]);


        $tableName = "prescription_item";
        $this->addForeignKey("fk_{$tableName}_prescription_id", $tableName, 'prescription_id', 'prescription', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_prescription_id", $tableName, 'prescription_id');
        $this->addForeignKey("fk_{$tableName}_substance_id", $tableName, 'substance_id', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id", $tableName, 'substance_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prescription_item}}');
    }
}
