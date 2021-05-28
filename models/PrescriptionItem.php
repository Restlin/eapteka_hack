<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Товары в рецепте
 *
 * @property int $id
 * @property int $substance_id Активное вещество
 * @property float $dose Доза активного вещества
 *
 * @property Substance $substance Активное вещество
 *
 * @package app\models
 * @author Dmitrii N <https://github.com/johnny-silverhand>
 */
class PrescriptionItem extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prescription_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['substance_id', 'dose'], 'required'],
            [['substance_id'], 'default', 'value' => null],
            [['substance_id'], 'integer'],
            [['dose'], 'number'],
            [['substance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id' => 'id']],
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
            'dose' => 'Доза активного вещества',
        ];
    }

    /**
     * Gets query for [[Substance]].
     *
     * @return ActiveQuery
     */
    public function getSubstance(): ActiveQuery
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id']);
    }
}
