<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "substance".
 *
 * @property int $id
 * @property string $name Наименование
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
            [['name'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[DiagnosisSubstances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosisSubstances()
    {
        return $this->hasMany(DiagnosisSubstance::class, ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[PrescriptionItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class, ['substance_id' => 'id']);
    }

    /**
     * Gets query for [[SubstanceEffects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubstanceEffects()
    {
        return $this->hasMany(SubstanceEffect::class, ['substance_id1' => 'id']);
    }

    /**
     * Gets query for [[SubstanceEffects0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubstanceEffects0()
    {
        return $this->hasMany(SubstanceEffect::class, ['substance_id2' => 'id']);
    }

    public static function getList(): array {
        $list = [];
        $models = self::find()->orderBy('name')->all();
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
}
