<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                //логируем не удачный вход
                Yii::info('user ' . $user->username . '(id=' . $this->username . ') - auth unsuccessful', 'security');

                $this->addError($attribute, 'Incorrect username or password.');


            } else {
                //дополнительная проверка для пользователей бэкэнда
                if (isset(Yii::$app->params['back_admin'])) {
                    if (in_array($user->id, Yii::$app->params['back_admin'])) {
                        //логируем удачный вход
                        Yii::info('user ' . $user->username . '(id=' . $user->id . ') - auth success', 'security');
                    } else {
                        Yii::info('user ' . $user->username . '(id=' . $this->username . ') - auth backend unsuccessful', 'security');
                        $this->addError($attribute, 'Incorrect backend username or password.');
                    }
                } else {
                    Yii::info('user ' . $user->username . '(id=' . $user->id . ') - auth success', 'security');
                }
            }
        }
        //принудительно записываем логи
        Yii::getLogger()->flush();

    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public
    function login()
    {
        if ($this->validate()) {
            $u = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            return $u;
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected
    function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
