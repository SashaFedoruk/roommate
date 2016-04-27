<?php

	use common\models\User;
	use yii\helpers\Url;

	$userInfo = User::GetCurrentUser()->userInfo;
	$userAnket = User::GetCurrentUser()->questionaireOfRoommate;

?>
<div class="col-xs-12 col-sm-4 col-md-3 noPadding">
	<div class="profileMenu">
		<div class="row noMargin ">
			<div class="col-md-12 noPadding ">
				<img class="img-thumbnail icoWidth100prc maxWidth350" alt="..."
					 src="<?php echo $userInfo->image; ?>">
			</div>
		</div>
		<br>

		<div class="row noMargin text-center">
			<div class="col-xs-12 col-md-12"><label><?php echo $userInfo; ?></label></div>
		</div>
		<br>

		<div class="row noMargin">
			<a href="<?php echo Url::toRoute(['profile']); ?>">
				<button type="button" class="btn btn-success col-xs-12 col-md-12">Профіль</button>
			</a>
		</div>
		<br>

		<div class="row noMargin">
			<a href="<?php echo Url::toRoute(['setting']); ?>">
				<button type="button" class="btn btn-warning col-xs-12 col-md-12">Налаштування</button>
			</a>
		</div>
		<br>

		<div class="row noMargin">
			<a href="<?php echo Url::toRoute(['edit-user-info']); ?>">
				<button type="button" class="btn btn-primary col-xs-12 col-md-12">Редагувати дані про профіль</button>
			</a>
		</div>
		<br>

		<div class="row noMargin">

			<a href="<?php echo Url::toRoute(['edit-anket']); ?>">
				<button type="button" class="btn btn-info col-xs-12 col-md-12">
					<?php if (!empty($userAnket)) {
						echo "Редагувати анкету";
					} else {
						echo "Створити анкету";
					} ?>
				</button>
			</a>
		</div>
		<br>

		<div class="row noMargin">
			<a href="<?php echo Url::toRoute(['wiew-user-ads']); ?>">
				<button type="button" class="btn btn-danger col-xs-12 col-md-12">Мої оголошення</button>
			</a>
		</div>
		<br>

		<div class="row noMargin">
			<a href="<?php echo Url::toRoute(['messages']); ?>">
				<button type="button" class="btn btn-pink col-xs-12 col-md-12">Мої повідомлення</button>
			</a>
		</div>
		<br>
	</div>
</div>