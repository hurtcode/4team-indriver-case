<?php
/**
 * @var \yii\web\View $this
 * @var \OutDriver\Yii\Application\Driver\SignInForm $signInForm
 */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

?>

<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Авторизация</h3>
		</div>
        <?php
        $form = ActiveForm::begin() ?>
		<div class="card-body">
            <?= $form->field($signInForm, 'login')->textInput(); ?>
            <?= $form->field($signInForm, 'password')->passwordInput(); ?>
		</div>
		<div class="card-footer">
			<div class="container">
                <?= \yii\bootstrap4\Html::submitButton(
                    'Войти',
                    ['class' => ['btn btn-success']]
                ) ?>
				<div class="float-right">
                    <?= \yii\bootstrap4\Html::a(
                        "Зарегистрироваться",
                        Url::to(['/driver/sign-up'])
                    ); ?>
				</div>
			</div>
		</div>
        <?php
        $form = ActiveForm::end() ?>
	</div>
	<!-- /.card -->

</div>
