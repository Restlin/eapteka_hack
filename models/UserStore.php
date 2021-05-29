<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_store".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $item_id Лекарство
 * @property int $amount Количество
 * @property int $target_id Кто будет принимать
 * @property bool $regular Регулярный прием
 * @property int $mode Вид аптечки
 *
 * @property Item $item
 * @property User $target
 * @property User $user
 */
class UserStore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'target_id'], 'required'],
            [['user_id', 'item_id', 'amount', 'target_id', 'mode'], 'default', 'value' => null],
            [['user_id', 'item_id', 'amount', 'target_id', 'mode'], 'integer'],
            [['regular'], 'boolean'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['target_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['target_id' => 'id']],
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
            'item_id' => 'Лекарство',
            'amount' => 'Количество',
            'target_id' => 'Кто будет принимать',
            'regular' => 'Регулярный прием',
            'mode' => 'Вид аптечки',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Target]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarget()
    {
        return $this->hasOne(User::className(), ['id' => 'target_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
