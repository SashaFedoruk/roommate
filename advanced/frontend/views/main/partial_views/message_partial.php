<?php
	/* @var $model common\models\Messages */
	/* @var $prev_date string */
	use common\models\User;

	$date = new DateTime($model->created_at);
?>
<?php if ($prev_date != $date->format('F d')) { ?>
	<hr>
	<div class="row noMargin text-center opacity60">
		<?php echo $date->format('F d'); ?>
	</div>
	<hr>
<?php } ?>
<?php if ($model->from_id != User::GetCurrentUser()->id) { ?>
	<div class="row noMargin">
		<div class="col-xs-11 col-sm-10 col-md-8">
			<div class="col-xs-10 col-md-10 blockTextMessage toMessage">
				<?php echo $model->message; ?>
			</div>
			<div class="col-xs-2 col-md-2 blockTimeMessage">
				<?php
					echo $date->format('H:i');
				?>
			</div>
		</div>
	</div>
	<br>
<?php } else { ?>
	<div class="row noMargin">
		<div class="col-xs-11 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-2 col-md-offset-4">
			<div class="col-xs-2 col-md-2 blockTimeMessage">
				<?php
					$date = new DateTime($model->created_at);
					echo $date->format('H:i');
				?>
			</div>
			<div class="col-xs-10 col-md-10 blockTextMessage fromMessage">
				<?php echo $model->message; ?>
			</div>
		</div>
	</div>
	<br>
<?php } ?>

