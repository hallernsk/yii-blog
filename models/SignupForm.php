<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'email', 'password'], 'required'],
            ['name', 'string', 'max' => 32],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'targetAttribute' => 'email'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->attributes = $this->attributes;

            return $user->create();
        }
        return false;
    }

}
