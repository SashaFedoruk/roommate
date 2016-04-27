<?php
	/* @var $this yii\web\View */
	/* @var $messages Messages[] */
	/* @var $toUser userInfo */
	/* @var $form yii\widgets\ActiveForm */

	use common\models\Messages;
	use common\models\UserInfo;
	use yii\helpers\Url;
	use yii\web\View;
	use \common\models\User;

	$this->registerJsFile('/js/jquery.min.js', [
		'position' => View::POS_HEAD,
	]);
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
							<label><?php echo $toUser; ?></label>
						</summary>
						<div class="row noMargin noPadding-xs">
							<div class="scrollBlock noPadding-xs" id="messages">
								<br>
								<?php
									if (!empty($messages)) {
										$prevDate = '';
										foreach ($messages as $el) {
											echo $this->render('partial_views\message_partial', ['model' => $el, 'prev_date' => $prevDate]);
											$date = new DateTime($el->created_at);
											$prevDate = $date->format('F d');
											if($el->for_id == User::GetCurrentUser()->id && $el->status != 2 ){
												$el->status = 2;
												$el->save();
											}
										}
										$last_message_id = end($messages);
										$last_message_id = $last_message_id->id;
										echo "<script> var last_message_id = " . $last_message_id . ';</script>';
									}
									else {
										echo '<script> var last_message_id = 0;</script>';
									}
								?>


								<br>
							</div>
							<hr>
							<div class="row noMargin">
								<div class="col-xs-12 col-md-9">
									<textarea id="messageText" class="form-control" rows="3"></textarea>
								</div>
								<div class="col-xs-12 col-md-3">
									<button type="submit" class="btn btn-default col-xs-12 col-md-12" id="send_message_btn">Відправити</button>
								</div>
							</div>
						</div>
						<br>

					</details>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	$(function () {
		var element = document.getElementsByClassName("scrollBlock")[0];
		element.scrollTop = element.scrollHeight;
		var isEndAjax = false;
		var messages = $('#messages');
		var sendMsgBtn = $('#send_message_btn');



		setInterval(function () {
			if (!isEndAjax) {
				isEndAjax = true;
				$.ajax({
					url: '<?php echo Url::toRoute(["main/get-messages"]) ?>',
					type: 'post',
					data: {
						for: <?php echo $toUser->user_id ?>,
						last_message_id: last_message_id === null ? 0 : last_message_id,
						_csrf: '<?php echo Yii::$app->request->getCsrfToken(); ?>'
					},
					success: function (data) {
						//console.log(data);
						var dataRez = JSON.parse(data);
						if (last_message_id != dataRez.last_message_id) {
							messages.append(dataRez.messagesResult);
							last_message_id = dataRez.last_message_id;
							element.scrollTop = element.scrollHeight;
						}
						isEndAjax = false;
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		}, 1000);

		sendMsgBtn.click(function(){
			var textMessage = $('#messageText')[0].value;
			if(textMessage != '') {
				$.ajax({
					url: '<?php echo Url::toRoute(["main/send-messages"]) ?>',
					type: 'post',
					data: {
						for: <?php echo $toUser->user_id ?>,
						message: textMessage,
						_csrf: '<?php echo Yii::$app->request->getCsrfToken(); ?>'
					},
					success: function (data) {
						$('#messageText')[0].value = "";
					},
					error: function (error) {
						console.log(error);
					}
				});
			}
		});

	});


</script>
