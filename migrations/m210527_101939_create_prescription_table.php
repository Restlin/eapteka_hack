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

        $this->batchInsert('{{%diagnosis}}', ['name'], [
            ['COVID-19'],
            ['Акне'],
            ['Алкоголизм и Похмелье'],
            ['Аллергия'],
            ['Алопеция/Выпадение волос'],
            ['Болезни суставов'],
            ['Бородавки'],
            ['Варикоз'],
            ['Гайморит'],
            ['Гастрит'],
            ['Геморрой'],
            ['Глаукома'],
            ['Диабет'],
            ['Заболевания простаты'],
            ['Избыточный вес'],
            ['Изжога'],
            ['Климакс'],
            ['Мешки и круги под глазами'],
            ['Мигрень'],
            ['Молочница'],
            ['Недержание мочи'],
            ['Остеопороз'],
            ['Отит'],
            ['Перхоть'],
            ['Пигментные пятна'],
            ['Пищеварительная система'],
            ['Подагра'],
            ['Покраснения кожи'],
            ['Потенция'],
            ['Простуда и грипп'],
            ['Профилактика инфекций'],
            ['Раздраженная кожа'],
            ['Раздраженный кишечник'],
            ['Сон и бессонница'],
            ['Стоматит'],
            ['Раны'],
            ['Цистит'],
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
        $this->addForeignKey("fk_{$tableName}_diagnosis_id", $tableName, 'diagnosis_id', 'diagnosis', 'id', 'CASCADE', 'CASCADE');
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
