<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Аптека
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $address Адрес
 *
 * @property Collection[] $collections Коллекции
 * @property Order[] $orders Заказы
 * @property StoreItem[] $storeItems Товары
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Store extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'address' => 'Адрес',
        ];
    }

    /**
     * Gets query for [[Collections]].
     *
     * @return ActiveQuery
     */
    public function getCollections(): ActiveQuery
    {
        return $this->hasMany(Collection::class, ['store_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return ActiveQuery
     */
    public function getOrders(): ActiveQuery
    {
        return $this->hasMany(Order::class, ['store_id' => 'id']);
    }

    /**
     * Gets query for [[StoreItems]].
     *
     * @return ActiveQuery
     */
    public function getStoreItems(): ActiveQuery
    {
        return $this->hasMany(StoreItem::class, ['store_id' => 'id']);
    }
}
