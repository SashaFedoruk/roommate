<?php
	/* @var $model frontend\models\SearchHouseForm */
	/* @var $models UserInfo[] */
	/* @var $pages Pagination */
	/* @var $this yii\web\View */
	/* @var $tmp string */

	use common\models\HouseState;
	use common\models\HouseType;
	use common\models\UserInfo;
	use yii\bootstrap\ActiveForm;
	use yii\data\Pagination;
	use yii\helpers\Html;
	use yii\widgets\LinkPager;

	$this->registerJsFile('/js/jquery.min.js', [
		'position' => \yii\web\View::POS_HEAD,
	]);

	$this->title = 'Пошук співмешканця'
?>
<div class="container content">
	<br>

	<div class="row">
		<div class="col-xs-12 col-md-3 noPadding-xs">
			<div class="paramsOfSearch">
				<?php $form = ActiveForm::begin([
					'method'      => 'get',
					'fieldConfig' => [
						'template' => '{input}',
					]
				]); ?>
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Місто</label>
					</div>
					<div class="col-xs-12 col-md-12">

						<?php
							echo $form->field($model, 'city_name', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['id' => 'search-box', 'placeholder' => 'Введіть назву міста'])->label(false);
							echo $form->field($model, 'city_id', ['options' => ['tag' => 'div', 'class' => 'hiddenBlock']])->textInput(['id' => 'city_id', 'class' => 'hiddenBlock'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Вік</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?php echo $form->field($model, 'age_min')
									->textInput(['placeholder' => 'Від', 'class' => 'form-control input-sm', 'type' => 'number']); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?php echo $form->field($model, 'age_max')
									->textInput(['placeholder' => 'До', 'class' => 'form-control input-sm', 'type' => 'number']); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row radioButtonToImage">
					<div class="col-xs-12 col-md-12">
						<label>Стать</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'gender', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList([
									'man'   => 'Чоловік',
									'woman' => 'Жінка',
								], ['prompt' => 'Не важливо...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row ">
					<div class="col-xs-12 col-md-12">
						<label>Ставлення до куріння</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'cigarette_addiction', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList(['Yes' => 'Позитивне',
												'No'  => 'Негативне',
								], ['prompt' => 'Не важливо...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row ">
					<div class="col-xs-12 col-md-12">
						<label>Ставлення до алкоголю</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'alcohol_addiction', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList(['Yes' => 'Позитивне',
												'No'  => 'Негативне',
								], ['prompt' => 'Не важливо...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Ціна за житло</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?php echo $form->field($model, 'price_of_house_min')
									->textInput(['placeholder' => 'Від', 'class' => 'form-control input-sm', 'type' => 'number']); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?php echo $form->field($model, 'price_of_house_max')
									->textInput(['placeholder' => 'До', 'class' => 'form-control input-sm', 'type' => 'number']); ?>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Тип житла</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'type_id', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList(HouseType::getMap(), ['prompt' => 'Виберіть тип...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Наявність житла</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'availability_of_house', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList(['Yes' => 'Так',
												'No'  => 'Ні',
								], ['prompt' => 'Не важливо...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Стан житла</label>
					</div>
					<div class="col-xs-12 col-md-12">
						<?php
							echo $form->field($model, 'state_id', ['options' => ['tag' => 'div', 'class' => '']])
								->dropDownList(HouseState::getMap(), ['prompt' => 'Виберіть стан житла...'])->label(false);
						?>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-md-12 ">
						<?= Html::submitButton('Пошук', ['class' => 'btn btn-success col-xs-12', 'name' => 'find-button']); ?>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
		<div class="col-xs-12 col-md-9  noPadding-xs">
			<div class="searchResult">
				<div class="row searchInfo noPadding-xs">
					<?php
						$roommates = $models;
						if (!empty($roommates)) {
							foreach ($roommates as $el) {
								echo $this->render('partial_views\roommate_partial', ['userInfo' => $el]);
								?>

							<?php } ?>
							<div class="row">
								<div class="navPages">
									<?php echo LinkPager::widget([
										'pagination' => $pages,
										'class'      => 'pagination-centered',
									]); ?>
								</div>
							</div>
						<?php } else { ?>
							<h2>Пошук не дав результатів</h2>
						<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function initAutocomplete() {
		var inputForm = $('#city_id');
		var searchBox = $('#search-box');
		//console.log(placeId);
		var autocomplete = new google.maps.places.Autocomplete(searchBox[0], {
			types: ['(cities)']
		});
		searchBox.change(function () {
			if (searchBox.val() == "") {
				inputForm.value = "";
			}
		});

		autocomplete.addListener('place_changed', function () {
			var place = autocomplete.getPlace();
			inputForm.val(place.place_id);
			//inputForm.attr('value',place.place_id);
		});
	}
</script>
<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCm9bkUvEDLGz4BZZQKm_pr94vV35XQq0Y&libraries=places&callback=initAutocomplete"></script>
