<?php
	/* @var $userInfo UserInfo */

	use common\models\UserInfo;
	use frontend\models\FormatHelper;
	use yii\helpers\Url;

	$userAnket = $userInfo->user->questionaireOfRoommate;
?>

<div class="col-xs-12 col-md-12 panel panel-default">
	<div class="panel-body">
		<h4><?php echo $userInfo; ?></h4>
		<hr/>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-9 noPadding-xs">

				<?php
					if (!empty($userInfo->city_id)) {
						echo '<p><b>Місто проживання: </b>' . $userInfo->city_name . '</p>';
					}
					if (!empty($userInfo->birth_date)) {
						$date = new DateTime($userInfo->birth_date);
						$today = new DateTime();
						echo '<p><b>Вік: </b>' . $today->diff($date, false)->y . ' років</p>';
					}
					if (!empty($userInfo->gender)) {
						$data = $userInfo->gender == 'man' ? 'Чоловік' : 'Жінка';
						echo '<p><b>Стать: </b>' . $data . '</p>';
					}
					if (!empty($userInfo->availability_of_house)) {
						$data = $userInfo->availability_of_house == TRUE ? 'Так' : 'Ні';
						echo '<p><b>Наявність житла: </b>' . $data . '</p>';
					}
					if (!empty($userInfo->desc)) {
						$len = strlen($userInfo->desc) > 50 ? 50 : $n;
						$data = $userInfo->desc;
						if(strlen($data) > 50){
							$text = substr ($data, 0, 50).'...';
						}
						echo '<p><b>Про користувача: </b>' . $text . '</p>';
					}
				?>

				<?php if (!empty($userAnket)) {
					echo $this->render('anket_partial_textstyle', ['userAnket' => $userAnket]);

				} ?>


			</div>

			<div class="col-xs-6 col-xs-offset-3 col-sm-offset-5 col-md-offset-0 col-sm-3 col-md-3 noPadding">
				<a href="#" class="thumbnail">
					<img class="img-rounded icoWidth100prc maxWidth350" alt="..." src="<?php echo $userInfo->image; ?>">
				</a>

				<div class="row noMargin-xs">
					<div class="col-xs-6 col-md-6 noPadding-xs">
						<?php
							if (!empty($userInfo->alcohol_addiction)) {
								$data = $userInfo->alcohol_addiction == 'Yes' ? 'alcoholIco' : 'noAlcoholIco';
								echo '<div class="ico40x40Circle ico35x35Circle-xs ' . $data . '"></div>';
							}
						?>
					</div>
					<div class="col-xs-6 col-md-6 noPadding-xs">
						<?php
							if (!empty($userInfo->cigarette_addiction)) {
								$data = $userInfo->cigarette_addiction == 'Yes' ? 'smokingIco' : 'noSmokingIco';
								echo '<div class="ico40x40Circle ico35x35Circle-xs ' . $data . '"></div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row panel-footer">
		<div class="col-xs-12  col-md-4 noPadding-xs">
			<a href="<?php echo Url::to(['main/wiew-profile', 'id' => $userInfo->user_id]); ?>">
				<button type="button" class="btn btn-primary col-xs-12">Переглянути профіль</button>
			</a>
		</div>
	</div>
</div>
<hr/>