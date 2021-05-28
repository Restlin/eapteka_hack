<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Пользователь
 *
 * @property int $id
 * @property string $fio ФИО
 * @property string $email Email
 * @property string|null $password_hash Хеш пароля
 * @property int $role Роль
 *
 * @property Order[] $orders Заказы
 * @property Prescription[] $wrotePrescriptions Выписанные рецепты
 * @property Prescription[] $receivedPrescriptions Полученные рецепты
 * @property UserTimetable[] $userTimetables Расписание пользователя
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email'], 'required'],
            [['role'], 'default', 'value' => null],
            [['role'], 'integer'],
            [['fio'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 64],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'email' => 'Email',
            'password_hash' => 'Хеш пароля',
            'role' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return ActiveQuery
     */
    public function getOrders(): ActiveQuery
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Prescriptions]].
     *
     * @return ActiveQuery
     */
    public function getWrotePrescriptions(): ActiveQuery
    {
        return $this->hasMany(Prescription::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Prescriptions0]].
     *
     * @return ActiveQuery
     */
    public function getReceivedPrescriptions(): ActiveQuery
    {
        return $this->hasMany(Prescription::class, ['patient_id' => 'id']);
    }

    /**
     * Gets query for [[UserTimetables]].
     *
     * @return ActiveQuery
     */
    public function getUserTimetables(): ActiveQuery
    {
        return $this->hasMany(UserTimetable::class, ['user_id' => 'id']);
    }
}
