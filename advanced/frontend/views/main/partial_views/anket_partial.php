<?php
	/* @var $userAnket common\models\QuestionaireOfRoommate */
	use frontend\models\FormatHelper;

?>
<details class="panel panel-default">
	<summary class="panel-heading">
		<label>Анкета користувача (Вимоги до співмешканця)</label>
	</summary>
	<div class="panel-body">
		<?php
			if (!empty($userAnket->city_id)) {
				echo FormatHelper::getInfoStr('Місто:', $userAnket->city_name);
			}
			if (!empty($userAnket->age_min) || !empty($userAnket->age_max)) {
				$data = '';
				if (!empty($userAnket->age_min) && !empty($userAnket->age_max)) {
					$data = $userAnket->age_min . ' - ' . $userAnket->age_max;
				} else if (!empty($userAnket->age_min)) {
					$data = 'Від ' . $userAnket->age_min;
				} else {
					$data = 'До ' . $userAnket->age_max;
				}
				echo FormatHelper::getInfoStr('Вік:', $data);
			}

			if ($userAnket->gender == 'man') {
				$data = 'Man.png';
			} else if ($userAnket->gender == 'woman') {
				$data = 'Woman.png';
			} else {
				$data = 'Unisex.png';
			}
			echo FormatHelper::getInfoImageStr('Стать:', $data);


			if ($userAnket->alcohol_addiction == 'Yes') {
				$data = 'Alcohol.png';
			} else if ($userAnket->alcohol_addiction == 'No') {
				$data = 'NoAlcohol.png';
			} else {
				$data = 'AlcoholNoMatter.png';
			}
			echo FormatHelper::getInfoImageStr('Ставлення до алкоголю:', $data);


			if ($userAnket->cigarette_addiction == 'Yes') {
				$data = 'Smoking.png';
			} else if ($userAnket->cigarette_addiction == 'No') {
				$data = 'NoSmoking.png';
			} else {
				$data = 'SmokingNoMatter.png';
			}
			echo FormatHelper::getInfoImageStr('Ставлення до куріння:', $data);


			if ($userAnket->availability_of_house == 'Yes') {
				$data = 'Так';
			} else if ($userAnket->availability_of_house == 'No') {
				$data = 'Ні';
			} else {
				$data = 'Не важливо';
			}
			echo FormatHelper::getInfoStr('Наявність житла:', $data);

			if (!empty($userAnket->type_id)) {
				echo FormatHelper::getInfoStr('Тип житла:', $userAnket->type->name);
			}
			if (!empty($userAnket->state_id)) {
				echo FormatHelper::getInfoStr('Стан житла:', $userAnket->state->name);
			}
			if (!empty($userAnket->price_of_house_min) || !empty($userAnket->price_of_house_max)) {
				$data = '';
				if (!empty($userAnket->price_of_house_min) && !empty($userAnket->price_of_house_max)) {
					$data = $userAnket->price_of_house_min . ' - ' . $userAnket->price_of_house_max;
				} else if (!empty($userAnket->price_of_house_min)) {
					$data = 'Від ' . $userAnket->price_of_house_min;
				} else {
					$data = 'До ' . $userAnket->price_of_house_max;
				}
				echo FormatHelper::getInfoStr('Ціна:', $data);
			}

		?>
	</div>
</details>