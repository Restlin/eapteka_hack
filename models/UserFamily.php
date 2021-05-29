<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_family".
 *
 * @property int $id
 * @property int $user_id1 Пользователь
 * @property int $user_id2 Родственник
 * @property int $role Тип связи
 *
 * @property User $userId1
 * @property User $userId2
 */
class UserFamily extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_family';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id1', 'user_id2'], 'required'],
            [['user_id1', 'user_id2', 'role'], 'default', 'value' => null],
            [['user_id1', 'user_id2', 'role'], 'integer'],
            [['user_id1'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id1' => 'id']],
            [['user_id2'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id1' => 'Пользователь',
            'user_id2' => 'Родственник',
            'role' => 'Тип связи',
        ];
    }

    /**
     * Gets query for [[UserId1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserId1()
    {
        return $this->hasOne(User::class, ['id' => 'user_id1']);
    }

    /**
     * Gets query for [[UserId2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserId2()
    {
        return $this->hasOne(User::class, ['id' => 'user_id2']);
    }
}
