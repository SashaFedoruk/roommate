<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;

	$this->title = 'Авторизація'
?>
<div class="container">
	<br>

	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 noPadding-xs ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Форма авторизації</h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
					<?= $form->field($model, 'login')->textInput(['class' => 'form-control ', 'placeholder' => 'Логин'])->label("Логін"); ?>

					<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Пароль'])->label("Пароль"); ?>

					<?= $form->field($model, 'rememberMe')->checkbox()->label("Запам'ятати мене"); ?>



					<?= Html::submitButton('Вхід', ['class' => 'btn btn-default center-block', 'name' => 'login-button']); ?>
					<?php ActiveForm::end(); ?>

				</div>
			</div>
		</div>
	</div>
</div>