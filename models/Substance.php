<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "substance".
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $description Описание
 *
 * @property DiagnosisSubstance[] $diagnosisSubstances
 * @property Item[] $items
 * @property PrescriptionItem[] $prescriptionItems
 * @property SubstanceEffect[] $substanceEffects
 * @property SubstanceEffect[] $substanceEffects0
 */
class Substance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'substance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
        ];
    }

    /**
     * Gets query for [[DiagnosisSubstances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosisSubstances()
    {
        return $this->hasMany(DiagnosisSubstance::className(), ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[PrescriptionItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::className(), ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[SubstanceEffects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubstanceEffects()
    {
        return $this->hasMany(SubstanceEffect::className(), ['substance_id1' => 'id']);
    }

    /**
     * Gets query for [[SubstanceEffects0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubstanceEffects0()
    {
        return $this->hasMany(SubstanceEffect::className(), ['substance_id2' => 'id']);
    }
}
