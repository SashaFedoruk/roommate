<?php
	/* @var $this yii\web\View */
	/* @var $model common\models\UserInfo */
	/* @var $imageModel UploadForm */
	/* @var $form yii\widgets\ActiveForm */
	/* @var $tmp string */

	use common\models\User;
	use frontend\models\UploadForm;
	use yii\helpers\Html;
	use yii\web\View;
	use yii\widgets\ActiveForm;

	$this->registerJsFile('/js/jquery.min.js', [
		'position' => View::POS_HEAD,
	]);
	$this->registerJsFile('/js/bootstrap-datepicker.min.js', [
			'position' => View::POS_HEAD,
	]);
	$this->registerJsFile('/js/bootstrap-datepicker.uk.min.js', [
			'position' => View::POS_HEAD,
	]);

	$this->registerCssFile('/css/bootstrap-datepicker3.min.css', [
			'position' => View::POS_HEAD,
	]);
	$this->title = "Редагування даних користувача";
	$userAnket = User::GetCurrentUser()->questionaireOfRoommate;
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
							<label>Інформація про користувача</label>
						</summary>
						<div class="panel-body">
							<?php $form = ActiveForm::begin([
								'options' => ['enctype' => 'multipart/form-data'],
							]) ?>

							<div class="row">
								<div class="col-md-6 text-center"><b>Зображення користувача</b></div>
								<div class="col-md-6 text-center">
									<span class="btn btn-default btn-file">
									Виберіть файл<?php echo Html::activeFileInput($imageModel, 'file') ?>
										</span>
								</div>
							</div>
							<br>

							<div class="row">
								<div class="col-md-12 ">
									<?= Html::submitButton('Завантажити', ['class' => 'btn btn-success col-xs-12', 'name' => 'upload-button']); ?>
								</div>
							</div>

							<?php ActiveForm::end() ?>
							<br>
							<?php $form = ActiveForm::begin([
								'fieldConfig' => [
									'template' => '<div class="row">'
										. '<div class="col-md-6 text-center"><b>{label}</b></div>'
										. '<div class="col-md-6 text-center">{input}<div class="help-block with-errors">{error}</div></div>'
										. '</div>',
								]
							]); ?>

							<?php
								echo $form->field($model, 'city_name')->textInput(['id' => 'search-box', 'placeholder' => 'Введіть назву міста']);
								echo $form->field($model, 'city_id', ['options' => ['tag' => 'div', 'class' => 'hidden']])->textInput(['id' => 'city_id', 'class' => 'hiddenBlock'])->label(false);
							?>


							<?= $form->field($model, 'name')->textInput(); ?>

							<?= $form->field($model, 'last_name')->textInput(); ?>

							<?= $form->field($model, 'gender')->radioList([
								'man'   => 'Чоловік',
								'woman' => 'Жінка'
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?php echo $form->field($model, 'birth_date')->textInput(['class' => 'form-control datepticker']); ?>



							<?= $form->field($model, 'phone')->textInput(); ?>

							<?= $form->field($model, 'other_contacts')->textarea(); ?>

							<?= $form->field($model, 'availability_of_house')->radioList([
								true => 'Так',
								false  => 'Ні'
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?php #$form->field($model, 'house_id')->textInput(); ?>

							<?= $form->field($model, 'nationality')->textInput(); ?>

							<?= $form->field($model, 'ideology')->textInput(); ?>

							<?= $form->field($model, 'cigarette_addiction')->radioList([
								'Yes' => 'Позитивне',
								'No'  => 'Негативне',
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?= $form->field($model, 'alcohol_addiction')->radioList([
								'Yes' => 'Позитивне',
								'No'  => 'Негативне',
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?= $form->field($model, 'desc')->textarea(); ?>

							<?= $form->field($model, 'search_in')->radioList([
								1 => 'Так',
								0 => 'Ні'
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>


							<?php #$form->field($model, 'state_id')->dropDownList(HouseState::getMap(), ['prompt' => 'Виберіть cтан...']);?>

							<div class="row">
								<div class="col-md-12 ">
									<?= Html::submitButton('Оновити анкету', ['class' => 'btn btn-success col-xs-12', 'name' => 'update-button']); ?>
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
<div id="map"></div>
<div id="map"></div>
<script>
	function initAutocomplete() {
		$('.datepticker').datepicker({
			language: "uk",
			format: 'yyyy-mm-dd',
			defaultViewDate: { year: 1990, month: 01, day: 1 },
		});

		var inputForm = $('#city_id');
		var searchBox = $('#search-box');

		//console.log(placeId);
		var autocomplete = new google.maps.places.Autocomplete(searchBox[0], {
			types : ['(cities)']
		});

		autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
			console.log('ID: '+ place.place_id);
			inputForm.attr('value', place.place_id);
		});
	}
</script>
<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm9bkUvEDLGz4BZZQKm_pr94vV35XQq0Y&libraries=places&callback=initAutocomplete">
</script>