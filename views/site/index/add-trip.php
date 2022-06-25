<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Trip\TripAddForm $tripAddForm
 */

use yii\bootstrap4\ActiveForm;

?>
	<div class="row">
		<div class="col-md-12">
			<div class="info-box">
				<div class="info-box-icon">
					<i class="fas fa-car-side"></i>
				</div>
				<div class="info-box-content">
                    <?php
                    $form = ActiveForm::begin([
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
				</div>
			</div>
		</div>
	</div>
<?php
$js = <<<JS

JS;
$this->registerJs($js);
?>