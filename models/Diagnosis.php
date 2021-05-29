<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "diagnosis".
 *
 * @property int $id
 * @property string $name Наименование
 * @property DiagnosisSubstance[] $diagnosisSubstances
 */
class Diagnosis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'diagnosis';
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

    public static function getList(): array {
        $list = [];
        $models = self::find()->orderBy('name')->all();
        foreach($models as $model) {
            $list[$model->id] = $model->name;
        }
        return $list;
    }
    /**
     * Gets query for [[DiagnosisSubstances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiagnosisSubstances()
    {
        return $this->hasMany(DiagnosisSubstance::class, ['diagnosis_id' => 'id']);
    }
}
