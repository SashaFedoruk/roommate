<?php
namespace frontend\models;

use common\models\User;
use common\models\UserInfo;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $last_name;
    public $login;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required', 'message' => 'Введіть ім\'я користувача.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['last_name', 'filter', 'filter' => 'trim'],
            ['last_name', 'required', 'message' => 'Введіть прізвище користувача.'],
            ['last_name', 'string', 'min' => 2, 'max' => 255],

            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'required', 'message' => 'Введіть логін користувача.'],
            ['login', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Користувач з таким логіном вже зареєстрований в системі.'],
            ['login', 'string', 'min' => 5, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Введіть e-mail користувача.'],
            ['email', 'email', 'message' => 'Формат email не вірний.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Користувач з таким email вже зареєстрований в системі.'],

            ['password', 'required', 'message' => 'Введіть пароль користувача.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $userInfo = new UserInfo();
            if ($user->save()) {
                $userInfo->name = $this->name;
                $userInfo->last_name = $this->last_name;
                $userInfo->user_id = $user->id;
                $userInfo->search_in = true;
                $userInfo->image = Yii::getAlias('@web') . '/img/Man256x256.png';
                if ($userInfo->save()) {
                    return $user;
                }
            }
        }

        return null;
    }
}
