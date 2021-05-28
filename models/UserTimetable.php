<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Расписание
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property string $date Время события
 * @property string $content Содержание события
 * @property int $item_id Товар
 * @property int $type Тип
 * @property bool $complete Завершено
 *
 * @property Item $item Товар
 * @property User $user Пользователь
 */
class UserTimetable extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_timetable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'date', 'content', 'item_id', 'type'], 'required'],
            [['user_id', 'item_id', 'type'], 'default', 'value' => null],
            [['user_id', 'item_id', 'type'], 'integer'],
            [['complete'], 'boolean'],
            [['date'], 'safe'],
            [['content'], 'string'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
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
            'user_id' => 'Пользователь',
            'date' => 'Время события',
            'content' => 'Содержание события',
            'item_id' => 'Товар',
            'type' => 'Тип',
            'complete' => 'Завершено'
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
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
