<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Рецепт
 *
 * @property int $id
 * @property int $author_id Автор
 * @property int $patient_id Пациент
 * @property string $date Дата рецепта
 *
 * @property User $author Автор
 * @property User $patient Пациент
 * @property PrescriptionItem[] $prescriptionItems Товары в рецепте
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Prescription extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prescription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'patient_id', 'date'], 'required'],
            [['author_id', 'patient_id'], 'default', 'value' => null],
            [['author_id', 'patient_id'], 'integer'],
            [['date'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Автор',
            'patient_id' => 'Пациент',
            'date' => 'Дата рецепта',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return ActiveQuery
     */
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return ActiveQuery
     */
    public function getPatient(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'patient_id']);
    }

    /**
     * Gets query for [[PrescriptionItems]].
     *
     * @return ActiveQuery
     */
    public function getPrescriptionItems(): ActiveQuery
    {
        return $this->hasMany(PrescriptionItem::class, ['substance_id' => 'id']);
    }
}
