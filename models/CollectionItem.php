<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Товары в коллекции
 *
 * @property int $id
 * @property int $collection_id Коллекция
 * @property int $item_id Товар
 * @property int $amount Количество
 *
 * @property Collection $collection Коллеция
 * @property Item $item Товар
 */
class CollectionItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'collection_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collection_id', 'item_id', 'amount'], 'required'],
            [['collection_id', 'item_id', 'amount'], 'default', 'value' => null],
            [['collection_id', 'item_id', 'amount'], 'integer'],
            [['collection_id'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::class, 'targetAttribute' => ['collection_id' => 'id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'collection_id' => 'Коллекция',
            'item_id' => 'Товар',
            'amount' => 'Количество',
        ];
    }

    /**
     * Gets query for [[Collection]].
     *
     * @return ActiveQuery
     */
    public function getCollection(): ActiveQuery
    {
        return $this->hasOne(Collection::class, ['id' => 'collection_id']);
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
}
