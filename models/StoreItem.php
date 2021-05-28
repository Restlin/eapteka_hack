<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Товар в аптеке
 *
 * @property int $id
 * @property int $store_id Аптека
 * @property int $item_id Товар
 * @property float $price Стоимость
 * @property int $amount Количество
 *
 * @property Item $item Товар
 * @property Store $store Аптека
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class StoreItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id', 'item_id', 'price', 'amount'], 'required'],
            [['store_id', 'item_id', 'amount'], 'default', 'value' => null],
            [['store_id', 'item_id', 'amount'], 'integer'],
            [['price'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::class, 'targetAttribute' => ['store_id' => 'id']],
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
            'item_id' => 'Товар',
            'price' => 'Стоимость',
            'amount' => 'Количество',
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
     * Gets query for [[Store]].
     *
     * @return ActiveQuery
     */
    public function getStore(): ActiveQuery
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }
}
