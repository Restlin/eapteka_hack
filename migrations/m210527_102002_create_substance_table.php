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
        ]);

        $this->batchInsert('{{%substance}}', ['name'], [
            ['Ибупрофен'],
            ['Флурбипрофен'],
            ['Натрия алгинат'],
            ['Хлоропирамин'],
            ['Аллантоин'],
            ['Биотин'],
            ['Таурин'],
            ['Кальций'],
            ['Омега-3'],
            ['Селен'],
            ['Бета-каротин'],
        ]);

        $this->createTable('{{%diagnosis_substance}}', [
            'id' => $this->primaryKey(),
            'substance_id' => $this->integer()->notNull()->comment('Активное вещество'),
            'diagnosis_id' => $this->integer()->notNull()->comment('Диагноз'),
        ]);

        $tableName = "diagnosis_substance";
        $this->addForeignKey("fk_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id', 'diagnosis', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id');
        $this->addForeignKey("fk_{$tableName}_substance_id", $tableName, 'substance_id', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id", $tableName, 'substance_id');

        $this->insert($tableName, [
            'substance_id' => 2,
            'diagnosis_id' => 38
        ]);


        $this->createTable('{{%user_diagnosis}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'diagnosis_id' => $this->integer()->notNull()->comment('Диагноз'),
            'regular' => $this->boolean()->notNull()->defaultValue(false)->comment('Регулярный прием'),
        ]);

        $tableName = "user_diagnosis";
        $this->addForeignKey("fk_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id', 'diagnosis', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id');
        $this->addForeignKey("fk_{$tableName}_user_id", $tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id", $tableName, 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_diagnosis}}');
        $this->dropTable('{{%diagnosis_substance}}');
        $this->dropTable('{{%substance}}');
    }
}
