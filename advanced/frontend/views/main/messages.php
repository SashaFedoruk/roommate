<?php
	/* @var $this yii\web\View */
	/* @var $messages Messages[] */
	/* @var $form yii\widgets\ActiveForm */

	use common\models\User;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use vision\messages\widgets\PrivateMessageKushalpandyaWidget;
	use common\models\Messages;

	$this->title = "Повідомлення";
?>
<div class="container content noPadding-xs">
	<br>

	<div class="row noMargin-xs">
		<?php require_once('partial_views\left_profile_menu.php'); ?>
		<div class="col-xs-12  col-sm-8 col-md-9  noPadding-xs">
			<div class="row noMargin">
				<div class="col-md-12 noPadding-xs">
					<details open="open" class="panel panel-default">
						<summary class="panel-heading">
							<label>Повідомлення</label>
						</summary>
						<div class="panel-body noPadding-xs">
							<?php #PrivateMessageKushalpandyaWidget::widget() ?>
							<?php
								if(!empty($messages)) {
									foreach ($messages as $el){
										echo $this->render('partial_views\dialog_partial', ['message' => $el]);
									}
								}
							?>
						</div>
					</details>
				</div>
			</div>

		</div>
	</div>

</div>