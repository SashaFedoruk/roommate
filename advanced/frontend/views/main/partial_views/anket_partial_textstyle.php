<?php
	/* @var $userAnket common\models\QuestionaireOfRoommate */
	use frontend\models\FormatHelper;

?>
<details open="open" class="panel panel-default">
	<summary class="panel-heading">
		<label>Анкета користувача (Вимоги до співмешканця)</label>
	</summary>
	<div class="panel-body">
		<?php
			if (!empty($userAnket->city_id)) {
				echo '<p><b>Місто: </b>' . $userAnket->city_name . '</p>';
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
				echo '<p><b>Вік: </b>' . $data . '</p>';
			}

			if ($userAnket->gender == 'man') {
				$data = 'Чоловік';
			} else if ($userAnket->gender == 'woman') {
				$data = 'Жінка';
			} else {
				$data = 'Не важливо';
			}
			echo '<p><b>Стать: </b>' . $data . '</p>';


			if ($userAnket->alcohol_addiction == 'Yes') {
				$data = 'Позитивне';
			} else if ($userAnket->alcohol_addiction == 'No') {
				$data = 'Негативне';
			} else {
				$data = 'Не важливо';
			}
			echo '<p><b>Ставлення до алкоголю: </b>' . $data . '</p>';


			if ($userAnket->cigarette_addiction == 'Yes') {
				$data = 'Позитивне';
			} else if ($userAnket->cigarette_addiction == 'No') {
				$data = 'Негативне';
			} else {
				$data = 'Не важливо';
			}
			echo '<p><b>Ставлення до куріння: </b>' . $data . '</p>';


			if ($userAnket->availability_of_house == 'Yes') {
				$data = 'Так';
			} else if ($userAnket->availability_of_house == 'No') {
				$data = 'Ні';
			} else {
				$data = 'Не важливо';
			}
			echo '<p><b>Наявність житла: </b>' . $data . '</p>';

			if (!empty($userAnket->type_id)) {
				echo '<p><b>Тип житла: </b>' . $userAnket->type->name . '</p>';
			}
			if (!empty($userAnket->state_id)) {
				echo '<p><b>Стан житла: </b>' . $userAnket->state->name . '</p>';
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
				echo '<p><b>Ціна житла: </b>' . $data . '</p>';
			}

		?>
	</div>
</details>