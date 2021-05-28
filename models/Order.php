<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Заказ
 *
 * @property int $id
 * @property int $store_id Аптека
 * @property int $user_id Пользователь
 * @property float $price Стоимость
 * @property string $date Время заказа
 * @property bool $complete Признак оплаты
 *
 * @property OrderItem[] $orderItems Товары в заказе
 * @property Store $store Аптека
 * @property User $user Пользователь
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'user_id', 'price', 'date'], 'required'],
            [['store_id', 'user_id'], 'default', 'value' => null],
            [['store_id', 'user_id'], 'integer'],
            [['price'], 'number'],
            [['date'], 'safe'],
            [['complete'], 'boolean'],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_id' => 'Аптека',
            'user_id' => 'Пользователь',
            'price' => 'Стоимость',
            'date' => 'Время заказа',
            'complete' => 'Признак оплаты',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return ActiveQuery
     */
    public function getOrderItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[Store]].
     *
     * @return ActiveQuery
     */
    public function getStore(): ActiveQuery
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
