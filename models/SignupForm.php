<?php
namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{

    public $nickname;
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username', 'password', 'nickname'], 'required'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'nickname' => 'Никнейм',
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }
}
