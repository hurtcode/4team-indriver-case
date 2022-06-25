<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Application\Trip\TripAddForm $tripAddForm
 * @var string|null $error
 */

use yii\bootstrap4\ActiveForm;

?>

<?php
if (!is_null($error)): ?>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $error ?>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
<?php
endif; ?>

<?php
$form = ActiveForm::begin([
    'id' => 'trip-add-form',
    'action' => ['trip/add-trip'],
]) ?>
<div class="row">
	<div class="col-md-3">
        <?= $form->field($tripAddForm, 'cost')->textInput() ?>
	</div>
	<div class="col-md-3">
        <?= $form->field($tripAddForm, 'distance')->textInput() ?>
	</div>
	<div class="col-md-3">
        <?= $form->field($tripAddForm, 'spentTime')->textInput(['placeholder' => '0.1']) ?>
	</div>
	<div class="col-md-3">
        <?= $form->field($tripAddForm, 'date')->textInput(['placeholder' => '0.1']) ?>
	</div>
</div>
<div class="row">
	<div class="container">
		<div class="float-right">
            <?= \yii\bootstrap4\Html::submitButton(
                'Добавить поездку',
                ['class' => 'btn btn-success']
            ); ?>
		</div>
	</div>
</div>
<?php
ActiveForm::end() ?>

