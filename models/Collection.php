<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Коллекция товаров
 *
 * @property int $id
 * @property string $name Наименование
 * @property int $store_id Аптека
 * @property float|null $price Стоимость
 *
 * @property CollectionItem[] $collectionItems Товары
 * @property Store $store Аптека
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Collection extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'store_id'], 'required'],
            [['store_id'], 'default', 'value' => null],
            [['store_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 100],
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
            'name' => 'Наименование',
            'store_id' => 'Аптека',
            'price' => 'Стоимость',
        ];
    }

    /**
     * Gets query for [[CollectionItems]].
     *
     * @return ActiveQuery
     */
    public function getCollectionItems(): ActiveQuery
    {
        return $this->hasMany(CollectionItem::class, ['collection_id' => 'id']);
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
