<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Товар
 *
 * @property int $id
 * @property string $name Наменование
 * @property int $group_id Группа
 * @property int $substance_id Активное вещество
 * @property float $dose Доза
 *
 * @property CollectionItem[] $collectionItems Коллекции
 * @property Group $group Группа
 * @property OrderItem[] $orderItems Заказы товара
 * @property StoreItem[] $storeItems Наличие в аптеках
 * @property Substance $substance Активное вещество
 * @property UserTimetable[] $userTimetables Расписания пользователей
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Item extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id', 'substance_id', 'dose'], 'required'],
            [['group_id', 'substance_id'], 'default', 'value' => null],
            [['group_id', 'substance_id'], 'integer'],
            [['dose'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['substance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наменование',
            'group_id' => 'Группа',
            'substance_id' => 'Активное вещество',
            'dose' => 'Доза',
        ];
    }

    /**
     * Gets query for [[CollectionItems]].
     *
     * @return ActiveQuery
     */
    public function getCollectionItems(): ActiveQuery
    {
        return $this->hasMany(CollectionItem::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return ActiveQuery
     */
    public function getGroup(): ActiveQuery
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return ActiveQuery
     */
    public function getOrderItems(): ActiveQuery
    {
        return $this->hasMany(OrderItem::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for [[StoreItems]].
     *
     * @return ActiveQuery
     */
    public function getStoreItems(): ActiveQuery
    {
        return $this->hasMany(StoreItem::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for [[Substance]].
     *
     * @return ActiveQuery
     */
    public function getSubstance(): ActiveQuery
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id']);
    }

    /**
     * Gets query for [[UserTimetables]].
     *
     * @return ActiveQuery
     */
    public function getUserTimetables(): ActiveQuery
    {
        return $this->hasMany(UserTimetable::class, ['item_id' => 'id']);
    }
}
