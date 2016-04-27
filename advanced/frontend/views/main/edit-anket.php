<?php
	/* @var $this yii\web\View */
	/* @var $model common\models\QuestionaireOfRoommate */
	/* @var $form yii\widgets\ActiveForm */

	use common\models\HouseState;
	use common\models\HouseType;
	use common\models\User;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = "Редагування анкети";
	$userAnket = User::GetCurrentUser()->questionaireOfRoommate;
	$userInfo = User::GetCurrentUser()->userInfo;

	$this->registerJsFile('/js/jquery.min.js', [
			'position' => \yii\web\View::POS_HEAD,
	]);
?>
<div class="container content noPadding-xs">
	<br>

	<div class="row noMargin-xs">
		<?php require_once('partial_views\left_profile_menu.php'); ?>
		<div class="col-xs-12 col-sm-8 col-md-9  noPadding-xs">
			<div class="row noMargin">
				<div class="col-md-12 noPadding-xs">
					<details open="open" class="panel panel-default">
						<summary class="panel-heading">
							<label>Анкета користувача (Вимоги до співмешканця)</label>
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

							<?php
								echo $form->field($model, 'city_name')->textInput(['id' => 'search-box', 'placeholder' => 'Введіть назву міста']);
								echo $form->field($model, 'city_id', ['options' => ['tag' => 'div', 'class' => '', 'template' => '']])->textInput(['id' => 'city_id', 'class' => 'hiddenBlock'])->label(false);
							?>
							<?= $form->field($model, 'type_id')->dropDownList(HouseType::getMap(), ['prompt' => 'Виберіть тип...']); ?>

							<?= $form->field($model, 'age_min')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'age_max')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'gender')->radioList([
								'man'    => 'Чоловік',
								'woman'  => 'Жінка',
								'unisex' => 'Не важливо'
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

							<?= $form->field($model, 'cigarette_addiction')->radioList([
								'Yes'      => 'Позитивне',
								'No'       => 'Негативне',
								'NoMatter' => 'Не важливо',
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
								'Yes'      => 'Позитивне',
								'No'       => 'Негативне',
								'NoMatter' => 'Не важливо',
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?= $form->field($model, 'availability_of_house')->radioList([
								'Yes'      => 'Позитивне',
								'No'       => 'Негативне',
								'NoMatter' => 'Не важливо',
							], [
								'class'       => 'btn-group',
								'data-toggle' => 'buttons',
								'unselect'    => null, // remove hidden field
								'item'        => function ($index, $label, $name, $checked, $value) {
									return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
									Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
								},
							]); ?>

							<?= $form->field($model, 'price_of_house_min')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'price_of_house_max')->textInput(['type' => 'number']) ?>

							<?= $form->field($model, 'state_id')->dropDownList(HouseState::getMap(), ['prompt' => 'Виберіть cтан...']); ?>

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
<script>
	function initAutocomplete() {
		var inputForm = document.getElementById('city_id');
		var searchBox = $('#search-box');

		//console.log(placeId);
		var autocomplete = new google.maps.places.Autocomplete(searchBox[0], {
			types : ['(cities)']
		});
		searchBox.change(function(){
			if(searchBox.val() == ""){
				inputForm.value = "";
			}
		});

		autocomplete.addListener('place_changed', function() {
			var place = autocomplete.getPlace();
			console.log('ID: '+ place.place_id);
			inputForm.value = place.place_id;
		});
	}
</script>
<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm9bkUvEDLGz4BZZQKm_pr94vV35XQq0Y&libraries=places&callback=initAutocomplete"></script>