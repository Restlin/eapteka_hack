<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prescription_item".
 *
 * @property int $id
 * @property int $substance_id Активное вещество
 * @property float $dose Доза активного вещества
 *
 * @property Substance $substance
 */
class PrescriptionItem extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery
     */
    public function getSubstance()
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id']);
    }
}
