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


        $this->createTable('{{%user_store}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull()->comment('Пользователь'),
            'item_id' => $this->integer()->notNull()->comment('Лекарство'),
            'amount' => $this->integer()->notNull()->defaultValue(1)->comment('Количество'),
            'target_id' => $this->integer()->notNull()->comment('Кто будет принимать'),
            'regular' => $this->boolean()->notNull()->defaultValue(false)->comment('Регулярный прием'),
            'mode' => $this->smallInteger()->notNull()->defaultValue(1)->comment('Вид аптечки'), //дома или в дороге
        ]);

        $tableName = "user_store";
        $this->addForeignKey("fk_{$tableName}_user_id", $tableName, 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_user_id", $tableName, 'user_id');
        $this->addForeignKey("fk_{$tableName}_target_id", $tableName, 'target_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_target_id", $tableName, 'target_id');
        $this->addForeignKey("fk_{$tableName}_item_id", $tableName, 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex("idx_{$tableName}_item_id", $tableName, 'item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%user_store}}');
    }
}
