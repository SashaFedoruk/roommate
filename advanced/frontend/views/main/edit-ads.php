<?php
	/* @var $this yii\web\View */
	/* @var $model House */
	/* @var $form yii\widgets\ActiveForm */

	use common\models\House;
	use common\models\HouseState;
	use common\models\HouseType;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = "Нове оголошення";
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
							<label>Оголошення</label>
						</summary>
						<div class="panel-body">
							<?php $form = ActiveForm::begin([
								'fieldConfig' => [
									'template' => '<div class="row">'
										. '<div class="col-md-6 text-center"><b>{label}</b></div>'
										. '<div class="col-md-6 text-center">{input}<div class="help-block with-errors">{error}</div></div>'
										. '</div>',
								]
							]); ?>

							<?= $form->field($model, 'title')->textInput() ?>

							<?= $form->field($model, 'city_id')->textInput() ?>

							<?= $form->field($model, 'type_id')->dropDownList(HouseType::getMap(), ['prompt' => 'Виберіть тип...']); ?>

							<?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'num_rooms')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'n_floor')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'area')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'state_id')->dropDownList(HouseState::getMap(), ['prompt' => 'Виберіть cтан...']); ?>

							<?= $form->field($model, 'desc')->textarea(); ?>

							<div class="row">
								<div class="col-md-12 ">
									<?= Html::submitButton('Зберегти', ['class' => 'btn btn-success col-xs-12', 'name' => 'save-button']); ?>
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