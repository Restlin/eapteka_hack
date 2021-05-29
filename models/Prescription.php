<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prescription".
 *
 * @property int $id
 * @property int $author_id Автор
 * @property int $patient_id Пациент
 * @property int $diagnosis_id Диагноз
 * @property string $date Дата рецепта
 *
 * @property User $author
 * @property Diagnosis $diagnosis
 * @property User $patient
 * @property PrescriptionItem[] $items
 */
class Prescription extends \yii\db\ActiveRecord
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
            [['author_id', 'patient_id', 'diagnosis_id', 'date'], 'required'],
            [['author_id', 'patient_id', 'diagnosis_id'], 'default', 'value' => null],
            [['author_id', 'patient_id', 'diagnosis_id'], 'integer'],
            [['date'], 'safe'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['patient_id' => 'id']],
            [['diagnosis_id'], 'exist', 'skipOnError' => true, 'targetClass' => Diagnosis::class, 'targetAttribute' => ['diagnosis_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Врач',
            'patient_id' => 'Пациент',
            'diagnosis_id' => 'Диагноз',
            'date' => 'Дата рецепта',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Diagnosis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosis()
    {
        return $this->hasOne(Diagnosis::class, ['id' => 'diagnosis_id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(User::class, ['id' => 'patient_id']);
    }
    /**
     * Gets query for [[PrescriptionItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(PrescriptionItem::class, ['prescription_id' => 'id']);
    }
}
