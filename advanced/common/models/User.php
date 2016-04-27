<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $auth_key
 *
 * @property Messages[] $messagesFor
 * @property Messages[] $messagesFrom
 * @property Messages[] $messagesAll
 * @property House[] $houses
 * @property QuestionaireOfRoommate $questionaireOfRoommate
 * @property UserInfo $userInfo
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'email', 'password', 'auth_key'], 'required'],
            [['login', 'email'], 'string', 'max' => 64],
            [['password', 'auth_key'], 'string', 'max' => 256],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Користувач з таким email вже зареєстрований в системі.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логін',
            'email' => 'Email',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @return User
     */
    public static  function GetCurrentUser(){
        return User::findIdentity(Yii::$app->user->id);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHouses()
    {
        return $this->hasMany(House::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionaireOfRoommate()
    {
        return $this->hasOne(QuestionaireOfRoommate::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesFrom()
    {
        return $this->hasMany(Messages::className(), ['from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesFor()
    {
        return $this->hasMany(Messages::className(), ['for_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessagesAll()
    {
        return Messages::find()->where('for_id = '.$this->id.' OR from_id = '.$this->id);
    }
}
