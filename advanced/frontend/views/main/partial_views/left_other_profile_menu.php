<?php
	/* @var $userInfo common\models\UserInfo */
	use yii\helpers\Url;

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
			<div class="col-xs-12 col-md-12"><b>
					<a href="<?php echo Url::to(['main/wiew-profile', 'id' => $userInfo->user_id]); ?>"><?php echo $userInfo; ?></a>
				</b>
			</div>
		</div>
		<br>

		<?php if (!Yii::$app->user->isGuest) { ?>
			<div class="row noMargin">
				<a href="<?php echo Url::to(['main/view-messages', 'for' => $userInfo->user_id]); ?>">
					<button type="button" class="btn btn-success col-xs-12 col-md-12">Надіслати повідомлення</button>
				</a>
			</div>
			<br>
		<?php } ?>
	</div>
</div>