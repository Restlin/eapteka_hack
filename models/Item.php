<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name Наменование
 * @property int $group_id Группа
 * @property int $substance_id Активное вещество
 * @property float $dose Доза
 * @property int|null $food_mode Прием с пищей
 * @property int|null $per_day Периодичность
 * @property int|null $temp_min Минимальная температура
 * @property int|null $temp_max Максимальная температура
 * @property string|null $content Описание
 * @property float|null $price Стоимость
 *
 * @property Group $group
 * @property Substance $substance
 * @property UserStore[] $userStores
 * @property UserTimetable[] $userTimetables
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'group_id', 'substance_id', 'dose'], 'required'],
            [['group_id', 'substance_id', 'food_mode', 'per_day', 'temp_min', 'temp_max'], 'default', 'value' => null],
            [['group_id', 'substance_id', 'food_mode', 'per_day', 'temp_min', 'temp_max'], 'integer'],
            [['dose', 'price'], 'number'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
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
            'name' => 'Наменование',
            'group_id' => 'Группа',
            'substance_id' => 'Активное вещество',
            'dose' => 'Доза, мг',
            'food_mode' => 'Прием с пищей',
            'per_day' => 'Периодичность',
            'temp_min' => 'Мин. температура, C',
            'temp_max' => 'Макс. температура, С',
            'content' => 'Описание',
            'price' => 'Стоимость, рубли',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
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

    /**
     * Gets query for [[UserStores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserStores()
    {
        return $this->hasMany(UserStore::class, ['item_id' => 'id']);
    }

    /**
     * Gets query for [[UserTimetables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserTimetables()
    {
        return $this->hasMany(UserTimetable::class, ['item_id' => 'id']);
    }

    public static function getFoodModeList(): array {
        return [
            1 => 'Перед едой',
            2 => 'Во время еды',
            3 => 'После еды',
        ];
    }

    public static function getPerDayModeList(): array {
        return [
            1 => 'Один раз в день',
            2 => 'Два раза в день',
            3 => 'Три раза в день'
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
}
