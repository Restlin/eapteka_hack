<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%substance_effect}}`.
 */
class m210527_102248_create_substance_effect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%substance_effect}}', [
            'id' => $this->primaryKey(),
            'substance_id1' => $this->integer()->notNull()->comment('Вещество №1'),
            'substance_id2' => $this->integer()->notNull()->comment('Вещество №2'),
            'positive' => $this->boolean()->notNull()->comment('Влияние'),
            'content' => $this->text()->notNull()->comment('Описание влияния'),
        ]);

        $tableName = "substance_effect";
        $this->addForeignKey("fk_{$tableName}_substance_id1", $tableName, 'substance_id1', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id1", $tableName, 'substance_id1');
        $this->addForeignKey("fk_{$tableName}_substance_id2", $tableName, 'substance_id2', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id2", $tableName, 'substance_id2');
        
        $this->insert('{{%substance_effect}}', [
            'substance_id1' => 1,
            'substance_id2' => 4,
            'positive' => false,
            'Конфликтуют друг с другом'
        ]);
        
        $this->insert('{{%substance_effect}}', [
            'substance_id1' => 4,
            'substance_id2' => 1,
            'positive' => false,
            'Конфликтуют друг с другом'
        ]);
    }
        
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%substance_effect}}');
    }
}
