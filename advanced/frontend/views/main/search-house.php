<?php
	/* @var $model frontend\models\SearchHouseForm */
	/* @var $models common\models\House[] */
	/* @var $pages Pagination */
	/* @var $this yii\web\View */
	/* @var $tmp string */

	use common\models\HouseState;
	use common\models\HouseType;
	use yii\bootstrap\ActiveForm;
	use yii\data\Pagination;
	use yii\helpers\Html;
	use yii\widgets\LinkPager;

	$this->title = 'Пошук житла';
	$this->registerJsFile('/js/jquery.min.js', [
			'position' => \yii\web\View::POS_HEAD,
	]);
?>
<div class="container content">
	<br>

	<div class="row">
		<div class="col-xs-12 col-md-3 noPadding-xs">
			<details open="open" class="panel">
				<summary class="panel-heading visible-xs">
					<label>Параметри пошуку</label>
				</summary>
				<div>
			<?php $form = ActiveForm::begin([
				'method'      => 'get',
				'fieldConfig' => [
					'template' => "{input}",
				]
			]); ?>
			<?php #$form->field($model, 'login')->textInput(['class' => 'form-control ', 'placeholder' => 'Логин'])->label("Логін"); ?>
			<div class="paramsOfSearch">
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
						<label>Тип</label>
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
						<label>Ціна за житло</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'priceMin', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'Від', 'type' => 'number'])->label(false); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'priceMax', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'До', 'type' => 'number'])->label(false); ?>
							</div>
						</div>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Кількість кімнат</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'nRoomsMin', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'Від', 'type' => 'number'])->label(false); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'nRoomsMax', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'До', 'type' => 'number'])->label(false); ?>
							</div>
						</div>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Площа (м2)</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'AreaMin', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'Від', 'type' => 'number'])->label(false); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'AreaMax', ['options' => ['tag' => 'div', 'class' => '']])->textInput(['class' => 'form-control input-sm', 'placeholder' => 'До', 'type' => 'number'])->label(false); ?>
							</div>
						</div>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Поверх</label>

						<div class="row">
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'nFloorMin', ['options' => ['tag' => 'div', 'class' => '']])
									->textInput(['class' => 'form-control input-sm', 'placeholder' => 'Від', 'type' => 'number'])->label(false); ?>
							</div>
							<div class="col-xs-6 col-md-6">
								<?= $form->field($model, 'nFloorMax', ['options' => ['tag' => 'div', 'class' => '']])
									->textInput(['class' => 'form-control input-sm', 'placeholder' => 'До', 'type' => 'number'])->label(false); ?>
							</div>
						</div>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-xs-12 col-md-12">
						<label>Стан</label>
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
			</div>
			<?php ActiveForm::end(); ?>
		</div>
		</div>
		<div class="col-xs-12 col-md-9  noPadding-xs">
			<div class="searchResult">
				<?php
					$houses = $models;
					if (!empty($houses)) {
						foreach ($houses as $el) {
							echo $this->render('partial_views\house_partial', ['param' => $el]);
							?>

						<?php } ?>
						<div class="row">
							<div class="navPages">
								<?php echo LinkPager::widget([
									'pagination' => $pages,
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