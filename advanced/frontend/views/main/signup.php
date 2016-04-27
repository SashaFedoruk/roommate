<?php
	$this->title = 'Реєстрація';
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;

	$this->title = 'Реєстрація';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
	<br>

	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 noPadding-xs ">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3>Форма реєстрації</h3>
				</div>
				<div class="panel-body">
					<?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'form-horizontal']); ?>
					<div class="form-group">
						<label class="col-sm-3 control-label">Ім'я</label>

						<div class="col-sm-9">
							<?= $form->field($model, 'name')->textInput(['class' => 'form-control', 'placeholder' => 'Ім\'я'])->label(false); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Прізвище</label>

						<div class="col-sm-9">
							<?= $form->field($model, 'last_name')->textInput(['class' => 'form-control', 'placeholder' => 'Прізвище'])->label(false); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Логін</label>

						<div class="col-sm-9">
							<?= $form->field($model, 'login')->textInput(['class' => 'form-control', 'placeholder' => 'Логін'])->label(false); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Email</label>

						<div class="col-sm-9">
							<?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email'])->label(false); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Пароль</label>

						<div class="col-sm-9">
							<?= $form->field($model, 'password')->passwordInput(['class' => 'form-control', 'placeholder' => 'Пароль'])->label(false); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-3 col-xs-12">
							<?= Html::submitButton('Реєстрація', ['class' => 'btn btn-default  col-xs-12', 'name' => 'signup-button']) ?>
						</div>
					</div>

					<?php ActiveForm::end(); ?>

				</div>
			</div>
		</div>
	</div>
</div>