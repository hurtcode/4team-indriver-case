<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Driver;

use yii\base\Model;

final class SignInForm extends Model
{
    public string $login = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин (Номер телефона)',
            'password' => 'Пароль',
        ];
    }
}