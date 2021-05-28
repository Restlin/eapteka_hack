<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m210527_102036_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Наменование'),
            'group_id' => $this->integer()->notNull()->comment('Группа'),
            'substance_id' => $this->integer()->notNull()->comment('Активное вещество'),
            'dose' => $this->float()->notNull()->comment('Доза'),
            'food_mode' => $this->smallInteger()->defaultValue(1)->comment('Прием с пищей'),
            'per_day' => $this->smallInteger()->defaultValue(1)->comment('Периодичность'),
            'temp_min' => $this->smallInteger()->defaultValue(0)->comment('Минимальная температура'),
            'temp_max' => $this->smallInteger()->defaultValue(25)->comment('Максимальная температура'),
            'content' => $this->text()->comment('Описание'),
            'price' => $this->decimal(10,2)->comment('Стоимость'),
        ]);

        $tableName = "item";
        $this->addForeignKey("fk_{$tableName}_group_id", $tableName, 'group_id', 'group', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_group_id", $tableName, 'group_id');
        $this->addForeignKey("fk_{$tableName}_substance_id", $tableName, 'substance_id', 'substance', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_substance_id", $tableName, 'substance_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
