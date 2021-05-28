<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prescription}}`.
 */
class m210527_101939_create_prescription_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%diagnosis}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наименование'),
        ]);


        $this->createTable('{{%prescription}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull()->comment('Автор'),
            'patient_id' => $this->integer()->notNull()->comment('Пациент'),
            'diagnosis_id' => $this->integer()->notNull()->comment('Диагноз'),
            'date' => $this->date()->notNull()->comment('Дата рецепта'),
        ]);

        $tableName = "prescription";
        $this->addForeignKey("fk_{$tableName}_author_id", $tableName, 'author_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_author_id", $tableName, 'author_id');
        $this->addForeignKey("fk_{$tableName}_patient_id", $tableName, 'patient_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_patient_id", $tableName, 'patient_id');
        $this->addForeignKey("fk_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prescription}}');
        $this->dropTable('{{%diagnosis}}');
    }
}
