<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Активное вещество
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $description Описание
 *
 * @property Item[] $items
 * @property PrescriptionItem[] $prescriptionItems Товары в рецепте
 * @property SubstanceEffect[] $substanceEffects
 * @property SubstanceEffect[] $substanceEffects0
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class Substance extends ActiveRecord
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
     * Gets query for [[Items]].
     *
     * @return ActiveQuery
     */
    public function getItems(): ActiveQuery
    {
        return $this->hasMany(Item::class, ['substance_id' => 'id']);
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

    /**
     * Gets query for [[SubstanceEffects]].
     *
     * @return ActiveQuery
     */
    public function getSubstanceEffects(): ActiveQuery
    {
        return $this->hasMany(SubstanceEffect::class, ['substance_id1' => 'id']);
    }

    /**
     * Gets query for [[SubstanceEffects0]].
     *
     * @return ActiveQuery
     */
    public function getSubstanceEffects0(): ActiveQuery
    {
        return $this->hasMany(SubstanceEffect::class, ['substance_id2' => 'id']);
    }
}
