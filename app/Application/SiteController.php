<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application;

use OutDriver\Yii\Application\Trip\TripAddForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

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

    /**
     * Action to see AdminLTE presets
     * Blocks, containers, etc.
     */
    public function actionPreset(): string
    {
        return $this->render('preset');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
    }
}
