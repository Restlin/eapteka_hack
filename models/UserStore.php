<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_store".
 *
 * @property int $id
 * @property int $user_id Пользователь
 * @property int $item_id Лекарство
 * @property int $amount Количество
 * @property int $target_id Кто будет принимать
 * @property bool $regular Регулярный прием
 * @property int $mode Вид аптечки
 *
 * @property Item $item
 * @property User $target
 * @property User $user
 */
class UserStore extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'target_id'], 'required'],
            [['user_id', 'item_id', 'amount', 'target_id', 'mode'], 'default', 'value' => null],
            [['user_id', 'item_id', 'amount', 'target_id', 'mode'], 'integer'],
            [['regular'], 'boolean'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['target_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['target_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'item_id' => 'Лекарство',
            'amount' => 'Количество',
            'target_id' => 'Кто будет принимать',
            'regular' => 'Регулярный прием',
            'mode' => 'Вид аптечки',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'item_id']);
    }

    /**
     * Gets query for [[Target]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTarget()
    {
        return $this->hasOne(User::class, ['id' => 'target_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public static function getStoreModeList(): array {
        return [
            2 => 'Домой',
            1 => 'В дорогу',            
        ];
    }

    public function beforeValidate() {
        if($this->target && $this->item) {
            foreach($this->target->userDiagnoses as $userDiagnos) {
                foreach($userDiagnos->diagnosis->diagnosisSubstances as $diagnosisSubstance) {
                    if($diagnosisSubstance->substance_id == $this->item->substance_id) {
                        $this->addError('item_id', 'Это лекарство противопоказано Вам из-за вашего диагноза: '.$diagnosisSubstance->diagnosis->name.'!');
                    }
                }
            }
            foreach($this->target->items as $item) {
                if($item->substance->getSubstanceEffects()->andWhere(['positive' => false, 'substance_id2' => $this->item->substance_id])->one()) {
                    $this->addError('item_id', 'Это лекарство не сочетается с принимаемым: '.$item->name.'!');
                }
            }
        }
        return parent::beforeValidate();
    }

    public function afterSave($insert, $changedAttributes) {
        if($insert) {
            $now = new \DateTime();
            $times = $this->item->getTimes();
            $content = $this->item->getModeContent();
            for($day = 0; $day< 3; $day++) { //@todo заменить на курс приема из справочника. Константа для прототипа
                $date = $now->format('d.m.Y');
                foreach($times as $time) {
                    $this->createTimetable($date.' '.$time, $content);
                }
                $now->modify(" +1 days");
            }
        }        
        if(!$insert && $this->amount < 3 && $this->regular) { //@todo хардкод по прототипу
            $this->createTimetableAboutProduct();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    private function createTimetable($date, $content) {
        $timetable = new UserTimetable();
        $timetable->user_id = $this->target_id;
        $timetable->item_id = $this->item_id;
        $timetable->type = UserTimetable::TYPE_RECEPTION;
        $timetable->complete = false;
        $timetable->date = $date;
        $timetable->content = $content;
        $timetable->save();
    }

    private function createTimetableAboutProduct() {
        $timetable = new UserTimetable();
        $timetable->user_id = $this->user_id;
        $timetable->item_id = $this->item_id;
        $timetable->type = UserTimetable::TYPE_ITEM;
        $timetable->complete = false;
        $date = new \DateTime();
        $date->modify('+15 minutes');
        $timetable->date = $date->format('d.m.Y H:i:s');
        $timetable->content = 'Необходимо пополнить запас в аптечке!';
        $timetable->save();
    }
}
