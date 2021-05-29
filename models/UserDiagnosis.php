<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_diagnosis".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $diagnosis_id Диагноз
 * @property bool $regular Регулярный прием
 *
 * @property User $diagnosis
 * @property User $user
 */
class UserDiagnosis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_diagnosis';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'diagnosis_id'], 'required'],
            [['user_id', 'diagnosis_id'], 'default', 'value' => null],
            [['user_id', 'diagnosis_id'], 'integer'],
            [['regular'], 'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['diagnosis_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['diagnosis_id' => 'id']],
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
            'diagnosis_id' => 'Диагноз',
            'regular' => 'Регулярный прием',
        ];
    }

    /**
     * Gets query for [[Diagnosis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosis()
    {
        return $this->hasOne(User::class, ['id' => 'diagnosis_id']);
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
