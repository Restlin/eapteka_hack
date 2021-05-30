<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fio ФИО
 * @property string $email Email
 * @property string|null $password_hash Хеш пароля
 * @property int $role Роль
 * @property string $image
 *
 * @property DiagnosisSubstance[] $diagnosisSubstances
 * @property Prescription[] $prescriptions
 * @property Prescription[] $prescriptions0
 * @property Prescription[] $prescriptions1
 * @property UserDiagnosis[] $userDiagnoses
 * @property UserDiagnosis[] $userDiagnoses0
 * @property UserFamily[] $userFamilies
 * @property UserFamily[] $userFamilies0
 * @property UserStore[] $userStores
 * @property UserStore[] $userStores0
 * @property UserTimetable[] $userTimetables
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'email'], 'required'],
            [['role'], 'default', 'value' => null],
            [['role'], 'integer'],
            [['fio'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 64],
            [['email'], 'unique'],
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
            'fio' => 'ФИО',
            'email' => 'Email',
            'password_hash' => 'Хеш пароля',
            'role' => 'Роль',
            'image' => 'Фото',
        ];
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

    /**
     * Gets query for [[Prescriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptions()
    {
        return $this->hasMany(Prescription::class, ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Prescriptions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptions0()
    {
        return $this->hasMany(Prescription::class, ['patient_id' => 'id']);
    }

    /**
     * Gets query for [[Prescriptions1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrescriptions1()
    {
        return $this->hasMany(Prescription::class, ['diagnosis_id' => 'id']);
    }

    /**
     * Gets query for [[UserDiagnoses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDiagnoses()
    {
        return $this->hasMany(UserDiagnosis::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserDiagnoses0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserDiagnoses0()
    {
        return $this->hasMany(UserDiagnosis::class, ['diagnosis_id' => 'id']);
    }

    /**
     * Gets query for [[UserFamilies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFamilies()
    {
        return $this->hasMany(UserFamily::class, ['user_id1' => 'id']);
    }

    /**
     * Gets query for [[UserFamilies0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserFamilies0()
    {
        return $this->hasMany(UserFamily::class, ['user_id2' => 'id']);
    }

    /**
     * Gets query for [[UserStores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserStores()
    {
        return $this->hasMany(UserStore::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserStores0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserStores0()
    {
        return $this->hasMany(UserStore::class, ['target_id' => 'id']);
    }

    /**
     * Gets query for [[UserTimetables]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserTimetables()
    {
        return $this->hasMany(UserTimetable::class, ['user_id' => 'id']);
    }
    
    
    //@todo после стадии прототипа перенести в сервис или доменную сущность
    public function getFamilyUsers(): array {
        $list = [$this->id => $this->fio];
        foreach($this->userFamilies as $family) {
            $list[$family->user_id2] = $family->user2->fio;
        }
        return $list;
    }

    public static function getList(): array {
        $list = [];
        $models = self::find()->orderBy('fio')->all();
        foreach($models as $model) {
            $list[$model->id] = $model->fio;
        }
        return $list;
    }
}
