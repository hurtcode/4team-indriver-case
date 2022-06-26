<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Application\Trip\TripsDataProvider $trips
 */


?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $trips,
    'columns' => [
        ['attribute' => 'id', 'header' => 'ID'],
        ['attribute' => 'date', 'header' => 'Дата поездки'],
        ['attribute' => 'distance', 'header' => 'Дальность поездки (км)'],
        ['attribute' => 'cost', 'header' => 'Стоимость'],
        ['attribute' => 'spendTime', 'header' => 'Затраченное время'],
    ]
])
?>
