<?php
	/* @var $this yii\web\View */
	/* @var $user User */
	/* @var ChangePaswordForm $password_form */
	/* @var $form yii\widgets\ActiveForm */

	use common\models\ChangePaswordForm;
	use common\models\User;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = "Налаштування";
?>
<div class="container content noPadding-xs">
	<br>

	<div class="row noMargin-xs">
		<?php require_once('partial_views\left_profile_menu.php'); ?>
		<div class="col-xs-12  col-sm-8 col-md-9  noPadding-xs">
			<div class="row noMargin">
				<div class="col-md-12 noPadding-xs">
					<details open="open" class="panel panel-default">
						<summary class="panel-heading">
							<label>Налаштування профілю</label>
						</summary>
						<div class="panel-body">
							<?php $form = ActiveForm::begin([
								'id'          => 'form1',
								'fieldConfig' => [
									'template' => '<div class="row">'
										. '<div class="col-md-6 text-center"><b>{label}</b></div>'
										. '<div class="col-md-6 text-center">{input}<div class="help-block with-errors">{error}</div></div>'
										. '</div>',
									#. '<div class="row">{error}</div>',
								]
							]); ?>

							<?= $form->field($user, 'email')->textInput(); ?>

							<div class="row">
								<div class="col-md-12 ">
									<?= Html::submitButton('Змінити email', ['class' => 'btn btn-success col-xs-12', 'name' => 'save-button']); ?>
								</div>
							</div>

							<?php ActiveForm::end(); ?>

							<hr>

							<?php $form = ActiveForm::begin([
								'id'          => 'form2',
								'fieldConfig' => [
									'template' => '<div class="row">'
										. '<div class="col-md-6 text-center"><b>{label}</b></div>'
										. '<div class="col-md-6 text-center">{input}<div class="help-block with-errors">{error}</div></div>'
										. '</div>',
								]
							]); ?>
							<?= $form->field($password_form, 'password')->passwordInput(); ?>
							<?= $form->field($password_form, 'confirm_password')->passwordInput(); ?>

							<div class="row">
								<div class="col-md-12 ">
									<?= Html::submitButton('Змінити пароль', ['class' => 'btn btn-success col-xs-12', 'name' => 'savePass-button']); ?>
								</div>
							</div>
							<?php ActiveForm::end(); ?>
						</div>
					</details>
				</div>
			</div>

		</div>
	</div>

</div>