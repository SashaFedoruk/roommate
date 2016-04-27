<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "user_info".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $last_name
 * @property string $gender
 * @property string $birth_date
 * @property string $city_id
 * @property string $city_name
 * @property string $phone
 * @property string $other_contacts
 * @property integer $availability_of_house
 * @property integer $house_id
 * @property string $nationality
 * @property string $ideology
 * @property string $cigarette_addiction
 * @property string $alcohol_addiction
 * @property string $desc
 * @property string $image
 * @property integer $search_in
 *
 * @property User $user
 * @property House $house
 */
class UserInfo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'house_id', 'search_in', 'availability_of_house'], 'integer'],
            [['birth_date'], 'safe'],
            [['image'], 'string'],
            [['name', 'last_name', 'city_id', 'nationality', 'ideology', 'city_name'], 'string', 'max' => 64],
            [['gender', 'cigarette_addiction', 'alcohol_addiction'], 'string', 'max' => 10],
            [['phone'], 'string', 'max' => 32],
            [['other_contacts'], 'string', 'max' => 128],
            [['desc'], 'string', 'max' => 712],
            [['image'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Ім\'я',
            'last_name' => 'Прізвище',
            'gender' => 'Стать',
            'birth_date' => 'Дата народження',
            'city_id' => 'Місце проживання',
            'phone' => 'Телефон',
            'other_contacts' => 'Інші контакти',
            'availability_of_house' => 'Наявність житла',
            'house_id' => 'House ID',
            'nationality' => 'Національність',
            'ideology' => 'Релігійні погляди',
            'cigarette_addiction'   => 'Ставлення до куріння',
            'alcohol_addiction'     => 'Ставлення до алкоголю',
            'desc' => 'Інформація про користувача',
            'search_in' => 'Шукаю співмешканця',
            'city_name' => 'Місто проживання'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouse()
    {
        return $this->hasOne(House::className(), ['id' => 'house_id']);
    }

    public function __toString()
    {
        return $this->last_name.' '.$this->name;
    }

    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id]);
    }

}
