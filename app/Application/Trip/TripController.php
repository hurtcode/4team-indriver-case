<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Trip;

use OutDriver\Application\DriverService;
use yii\filters\AccessControl;
use yii\web\Controller;

final class TripController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['add-trip'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionAddTrip(): string
    {
        if (!$this->request->isAjax) {
            return 'Not Allowed!';
        }
        $tripAddForm = TripAddForm::rand();
        if ($tripAddForm->load($this->request->post()) && $tripAddForm->validate()) {
            try {
                \Yii::$container->get(DriverService::class)
                    ->addTrip(
                        \Yii::$app->user->getId(),
                        $tripAddForm->cost,
                        $tripAddForm->distance,
                        $tripAddForm->spentTime,
                        $tripAddForm->date
                    );
                $tripAddForm = new TripAddForm();
            } catch (\DomainException|\RuntimeException $t) {
                $error = match (true) {
                    $t instanceof \DomainException => "Добавление поездки невозможно!",
                    default => "Критическая ошибка!"
                };
            }
        }

        return $this->renderAjax('add-form', ['tripAddForm' => $tripAddForm, 'error' => $error ?? null]);
    }

    public function actionAllTrips(): void
    {
    }
}