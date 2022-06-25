<?php

declare(strict_types=1);

namespace OutDriver\Yii\Trip;

use yii\base\Model;

final class TripAddForm extends Model
{
    public int $cost;
    public float $distance;
    public string $spentTime;
    public string $date;

    public static function rand(): TripAddForm
    {
        $form = new TripAddForm();
        $form->cost = rand(400, 800);
        $form->distance = (float)((string)rand(0, 9) . (string)(rand(0, 9)));
        $form->spentTime = "0" . (string)(rand(0, 1)) . ":" .
            (string)(rand(0, 6)) . (string)(rand(0, 9)) . ":" .
            (string)(rand(0, 6)) . (string)(rand(0, 9));
        $form->date = date('d-m-Y', time());
        return $form;
    }

    public function rules(): array
    {
        return [

        ];
    }

    public function attributeLabels()
    {
        return [
            'cost' => 'Стоимость поездки (тг)',
            'distance' => 'Расстояние (км)',
            'spentTime' => 'Время выполнения (ч:м:c)',
            'date' => 'Дата поездки (д:м:г)'
        ];
    }
}