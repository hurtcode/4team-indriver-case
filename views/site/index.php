<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Application\Trip\TripAddForm $tripAddForm
 */

?>
<div class="container-fluid">
    <?= $this->render('index/info-boxes') ?>

    <?= $this->render('index/add-trip', compact('tripAddForm')) ?>

    <?= $this->render('index/trip-history'); ?>
</div>