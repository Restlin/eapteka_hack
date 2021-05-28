<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Связь активных веществ
 *
 * @property int $id
 * @property int $substance_id1 Вещество №1
 * @property int $substance_id2 Вещество №2
 * @property bool $positive Влияние
 * @property string $content Описание влияния
 *
 * @property Substance $substanceId1 Вещество №1
 * @property Substance $substanceId2 Вещество №2
 */
class SubstanceEffect extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'substance_effect';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['substance_id1', 'substance_id2', 'positive', 'content'], 'required'],
            [['substance_id1', 'substance_id2'], 'default', 'value' => null],
            [['substance_id1', 'substance_id2'], 'integer'],
            [['positive'], 'boolean'],
            [['content'], 'string'],
            [['substance_id1'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id1' => 'id']],
            [['substance_id2'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id2' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'substance_id1' => 'Вещество №1',
            'substance_id2' => 'Вещество №2',
            'positive' => 'Влияние',
            'content' => 'Описание влияния',
        ];
    }

    /**
     * Gets query for [[SubstanceId1]].
     *
     * @return ActiveQuery
     */
    public function getSubstanceId1(): ActiveQuery
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id1']);
    }

    /**
     * Gets query for [[SubstanceId2]].
     *
     * @return ActiveQuery
     */
    public function getSubstanceId2(): ActiveQuery
    {
        return $this->hasOne(Substance::class, ['id' => 'substance_id2']);
    }
}
