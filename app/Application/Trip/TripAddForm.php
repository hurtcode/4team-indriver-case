<?php

declare(strict_types=1);

namespace OutDriver\Yii\Application\Trip;

use yii\base\Model;

final class TripAddForm extends Model
{
    public float $cost = 0.0;
    public float $distance = 0.0;
    public string $spentTime = '';
    public string $date = '';

    public static function rand(): TripAddForm
    {
        $form = new TripAddForm();
        $form->cost = rand(400, 800);
        $form->distance = (float)((string)rand(0, 9) .
            (string)(rand(0, 9)) .
            (string)(rand(0, 9)));
        $form->spentTime = "0" . (string)(rand(0, 1)) . ":" .
            (string)(rand(0, 6)) . (string)(rand(0, 9)) . ":" .
            (string)(rand(0, 6)) . (string)(rand(0, 9));
        $form->date = date('d-m-Y', time());
        return $form;
    }

    public function rules(): array
    {
        return [
            [['cost', 'distance', 'spentTime', 'date'], 'required'],
            [['cost', 'distance'], 'double'],
            [['spentTime'], 'date', 'format' => 'php:H:i:s'],
            [['date'], 'date', 'format' => 'php:d-m-Y'],
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