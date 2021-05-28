<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Товар в заказе
 *
 * @property int $id
 * @property int $order_id Заказ
 * @property int $item_id Товар
 * @property int $amount Количество
 * @property float $price Стоимость
 *
 * @property Item $item Товар
 * @property Order $order Заказ
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class OrderItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'amount', 'price'], 'required'],
            [['order_id', 'item_id', 'amount'], 'default', 'value' => null],
            [['order_id', 'item_id', 'amount'], 'integer'],
            [['price'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::class, 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Заказ',
            'item_id' => 'Товар',
            'amount' => 'Количество',
            'price' => 'Стоимость',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return ActiveQuery
     */
    public function getItem(): ActiveQuery
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Order]].
     *
     * @return ActiveQuery
     */
    public function getOrder(): ActiveQuery
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
}
