<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Необходимо указать логин.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким логином уже существует.'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Логин должен быть не менее двух символов', 'tooLong' => 'Логин должен быть не более 255 символов'],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Необходимо указать почтовый ящик.'],
            ['email', 'email', 'message' => 'Неправильно указан почтовый ящик.'],
            ['email', 'string', 'max' => 255, 'message' => 'Адрес почтового ящика не может быть более 255 символов.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Данный почтовый ящик уже используется.'],

            ['password', 'required', 'message' => 'Необходимо указать пароль.'],
            ['password', 'string', 'min' => 8, 'tooShort' => 'Пароль должен быть не менее восьми символов'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
