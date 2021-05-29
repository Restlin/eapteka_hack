<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosis_substance".
 *
 * @property int $id
 * @property int $substance_id Активное вещество
 * @property int $diagnosis_id Диагноз
 *
 * @property User $diagnosis
 * @property Substance $substance
 */
class DiagnosisSubstance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosis_substance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['substance_id', 'diagnosis_id'], 'required'],
            [['substance_id', 'diagnosis_id'], 'default', 'value' => null],
            [['substance_id', 'diagnosis_id'], 'integer'],
            [['substance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id' => 'id']],
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
            'substance_id' => 'Активное вещество',
            'diagnosis_id' => 'Диагноз',
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
     * Gets query for [[Substance]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubstance()
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id']);
    }
}
