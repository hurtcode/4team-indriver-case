<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Driver;

use OutDriver\Application\DriverService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

final class DriverController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'car',
                            'sign-in',
                            'sign-up',
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['costs'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ],
            ],
        ];
    }

    public function actionSignIn(): string|Response
    {
        $this->layout = 'main-login';

        $signInForm = new SignInForm();

        if ($signInForm->load($this->request->post()) && $signInForm->validate($signInForm)) {
            $identity = \Yii::$container
                ->get(DriverService::class)
                ->authorize($signInForm->login, $signInForm->password);
            if (!is_null($identity) && \Yii::$app->user->login(new ApplicationUser($identity))) {
                return $this->goHome();
            }
            $signInForm->addErrors(
                [
                    'login' => "Неверные логин или пароль!",
                    'password' => "Неверные логин или пароль!"
                ]
            );
        }

        return $this->render('sign-in', compact('signInForm'));
    }

    public function actionCosts(): string
    {
        if (!$this->request->isAjax) {
            return 'Not Allowed!';
        }

        try {
            $id = \Yii::$app->user->getIdentity()->authority()->id;
            $res = \Yii::$container->get(DriverService::class)
                ->amortization($id);
        } catch (\Throwable $t) {
            return "Ошибка!";
        }

        return (string)round($res->amortization, 2);
    }

    public function actionSignUp(): string
    {
        return "SignUp";
    }
}