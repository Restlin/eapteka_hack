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
 * @property integer $amount количество в упаковке
 * @property string $image
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
            [['amount'], 'integer'],
            [['content'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['substance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Substance::class, 'targetAttribute' => ['substance_id' => 'id']],
            [['image'], 'string'],
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
            'amount' => 'Количество в упаковке, штуки',
            'image' => 'Фото',
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

    public function getTimes(): array {
        if($this->food_mode == 1) {
            $times = ['7:30', '11:30', '17:30'];
        } elseif($this->food_mode == 2) {
            $times = ['8:00', '12:00', '18:00'];
        } else {
            $times = ['8:30', '12:30', '18:30'];
        }
        if($this->per_day == 1) {
            unset($times[2]);
            unset($times[0]);
        } elseif($this->per_day == 2) {
            unset($times[1]);
        }
        return $times;
    }

    public function getModeContent(): string {
        $foodModes = self::getFoodModeList();
        $perDayModes = self::getPerDayModeList();
        return mb_strtolower($foodModes[$this->food_mode], 'UTF-8');
    }

    public static function getList($substance_id = null): array {
        $list = [];
        $query = self::find()->orderBy('name');
        if($substance_id) {
            $query->andWhere(['substance_id' => $substance_id]);
        }
        $models = $query->orderBy(['price' => SORT_ASC])->all();
        foreach($models as $model) {
            $list[$model->id] = $model->price.' руб. - '.$model->name;
        }
        return $list;
    }
}
