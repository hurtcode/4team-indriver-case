<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

final class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'logout', 'preset'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                        'roles' => ['?', '@']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => !\Yii::$app->user->isGuest
                    ? 'main' : 'main-login'
            ],
        ];
    }

    /** Home page */
    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionLogout(): Response
    {
        \Yii::$app->user->logout();

        return $this->redirect(
            \Yii::$app->user->loginUrl
        );
    }
}
