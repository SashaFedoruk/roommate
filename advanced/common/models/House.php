<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property string $title
 * @property string $city_id
 * @property integer $type_id
 * @property float $price
 * @property integer $num_rooms
 * @property integer $n_floor
 * @property double $area
 * @property integer $state_id
 * @property string $desc
 * @property integer $author_id
 * @property string $image
 * @property string $create_date
 *
 * @property User $author
 * @property HouseType $type
 * @property HouseState $state
 * @property UserInfo[] $userInfo
 */
class House extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'num_rooms', 'n_floor', 'state_id', 'author_id'], 'integer'],
            [['area', 'price'], 'number'],
            [['create_date'], 'safe'],
            [['image'], 'string'],
            [['title'], 'string', 'max' => 128],
            [['desc'], 'string', 'max' => 712],
            [['title','city_id', 'type_id', 'num_rooms', 'state_id', 'author_id', 'price'], 'required'],
            [['city_id'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'city_id' => 'Місто',
            'type_id' => 'Тип',
            'price' => 'Ціна в грн.',
            'num_rooms' => 'Кількість кімнат',
            'n_floor' => 'Поверх',
            'area' => 'Площа',
            'state_id' => 'Стан',
            'desc' => 'Додаткова інформація',
            'author_id' => 'Author ID',
            'create_date' => 'Дата створення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(HouseType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(HouseState::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasMany(UserInfo::className(), ['house_id' => 'id']);
    }

    /**
     * @return House
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
}
