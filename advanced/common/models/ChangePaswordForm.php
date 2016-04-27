<?php
namespace common\models;

use common\models\User;
use common\models\UserInfo;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ChangePaswordForm extends Model
{
    public $password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Введіть пароль користувача.'],
            ['password', 'string', 'min' => 6, 'message' => 'Довжина пароля має бути більша за 6 символів.'],

            ['confirm_password', 'required', 'message' => 'Підтвердіть пароль користувача.'],
            ['confirm_password', 'string', 'min' => 6, 'message' => 'Довжина пароля має бути більша за 6 символів.'],
            [['confirm_password'],'compare', 'compareAttribute' => 'password', 'message' => 'Паролі не збігаються.'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'confirm_password' => 'Підтвердіть пароль',
        ];
    }
}
