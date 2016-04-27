<?php
	/* @var $message common\models\Messages */
	use common\models\User;
	use yii\helpers\Url;

	$cur_user_id = User::GetCurrentUser()->id;
	if ($message->from_id != $cur_user_id) {
		$user_model = $message->from;
	} else {
		$user_model = $message->for;
	}
	$date = new DateTime($message->created_at);
?>


<div class="row blockMessage noMargin <?php echo $message->status != 2 ? 'noReaded' : '' ?>">
	<div class="col-md-2 col-sm-2 col-xs-3  ">
		<img class=" icoWidth100prc maxWidth350" alt="..."
			 src="<?php echo $user_model->userInfo->image; ?>">
	</div>
	<div class="col-xs-9 col-sm-10 col-md-10 borderBottom">
		<a class="col-xs-10" href="<?php echo Url::to(['main/wiew-profile', 'id' => $user_model->id]); ?>">
			<?php echo $user_model->userInfo; ?>
		</a>

		<div class="col-md-2 visible-md visible-lg littleText">
			<?php
				echo $date->format('M d H:i');
			?>
		</div>
		<div class="col-xs-2 visible-sm littleText">
			<?php
				echo $date->format('m.d H:i');
			?>
		</div>
	</div>
	<br>
	<a class=" col-md-10 col-sm-10 col-xs-9"
	   href="<?php echo Url::to(['main/view-messages', 'for' => $user_model->id]); ?> ">
		<br>
		<?php
			if ($message->for_id != $cur_user_id) {
				echo '<b>' . $message->from->userInfo . ':  </b>';
			}
			echo $message->message;
		?>
	</a>
</div>