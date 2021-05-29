<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_timetable".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property string $date Время события
 * @property string $content Содержание события
 * @property int $item_id Товар
 * @property int $type Тип
 * @property bool $complete Завершено
 *
 * @property Item $item
 * @property User $user
 */
class UserTimetable extends \yii\db\ActiveRecord
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
            [['date'], 'safe'],
            [['content'], 'string'],
            [['complete'], 'boolean'],
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
            'complete' => 'Завершено',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
