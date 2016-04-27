<?php

	/* @var $this yii\web\View */
	/* @var $name string */
	/* @var $message string */
	/* @var $exception Exception */

	use common\models\User;
	use Faker\Provider\DateTime;
	use frontend\models\FormatHelper;
	use yii\helpers\Url;

	$this->title = "Профіль";
	$userInfo = User::GetCurrentUser()->userInfo;
	$userAnket = User::GetCurrentUser()->questionaireOfRoommate;


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
							<label>Інформація про користувача</label>
						</summary>
						<div class="panel-body">
							<?php
								echo FormatHelper::getInfoStr('Прізвище та ім\'я:', $userInfo);
								if (!empty($userInfo->city_id)) {
									echo FormatHelper::getInfoStr('Місто:', $userInfo->city_name);
								}
								if (!empty($userInfo->birth_date)) {
									$data = DateTime::dateTimeBetween($userInfo->birth_date);
									echo FormatHelper::getInfoStr('Вік:', DateTime::year($data));
								}
								if (!empty($userInfo->gender)) {
									$data = $userInfo->gender == 'man' ? 'Man.png' : 'Woman.png';
									echo FormatHelper::getInfoImageStr('Стать:', $data);
								}
								if (!empty($userInfo->alcohol_addiction)) {
									$data = $userInfo->alcohol_addiction == 'Yes' ? 'Alcohol.png' : 'NoAlcohol.png';
									echo FormatHelper::getInfoImageStr('Ставлення до алкоголю:', $data);
								}
								if (!empty($userInfo->cigarette_addiction)) {
									$data = $userInfo->cigarette_addiction == 'Yes' ? 'Smoking.png' : 'NoSmoking.png';
									echo FormatHelper::getInfoImageStr('Ставлення до куріння:', $data);
								}
								if (!empty($userInfo->availability_of_house)) {
									$data = $userInfo->availability_of_house == TRUE ? 'Так' : 'Ні';
									echo FormatHelper::getInfoStr('Місто:', $data);
								}
								echo FormatHelper::getInfoStr('Email:', User::GetCurrentUser()->email);

								if (!empty($userInfo->phone)) {
									echo FormatHelper::getInfoStr('Телефон:', $userInfo->phone);
								}
								if (!empty($userInfo->desc)) {
									echo FormatHelper::getInfoStr('Про користувача:', $userInfo->desc);
								}
								$data = $userInfo->search_in == TRUE ? 'Так' : 'Ні';
								echo FormatHelper::getInfoStr('Користувач шукає співмешканця:', $data);

							?>
						</div>
					</details>

					<?php if (!empty($userAnket)) {
						echo $this->render('partial_views\anket_partial', ['userAnket' => $userAnket]);
						?>
						<div class="row noMargin">
							<a href="<?php echo Url::to(['main/search-roommate', 'anketId' => $userAnket->id]); ?>">
								<button type="button" class="btn btn-success col-xs-12 col-md-4 col-md-offset-8">Підібрати співмешканця</button>
							</a>
						</div>
					<?php } ?>


				</div>
			</div>
		</div>
	</div>
</div>
