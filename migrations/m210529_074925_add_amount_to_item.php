<?php

use yii\db\Migration;

/**
 * Class m210529_074925_add_amount_to_item
 */
class m210529_074925_add_amount_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item', 'amount', $this->integer()->notNull()->defaultValue(10)->comment('Количество в упаковке'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item', 'amount');
    }
}
