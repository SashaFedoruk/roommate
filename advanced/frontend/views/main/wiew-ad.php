<?php

	/* @var $this yii\web\View */
	/* @var $user User */
	/* @var $model House */
	/* @var $message string */
	/* @var $exception Exception */

	use common\models\House;
	use common\models\User;

	$userInfo = $user->userInfo;
	$this->title = $userInfo;

?>

<div class="container content noPadding-xs">
	<br>

	<div class="row noMargin-xs">
		<?php
			if ($user->id == User::GetCurrentUser()->id) {
				require_once('partial_views\left_profile_menu.php');
			} else {
				echo $this->render('partial_views\left_other_profile_menu', ['userInfo' => $userInfo]);
			} ?>
		<div class="col-xs-12 col-sm-8 col-md-9  noPadding-xs">
			<div class="row noMargin">
				<div class="col-md-12 noPadding-xs">
					<div class="BlockGray ">
						<div class="row">
							<div class="col-md-9">
								<h3><?php echo $model->title; ?></h3>
							</div>
							<div class="col-md-3">
								<div class="priceHouseGray">
									<h3 class="noPadding noMargin"><?php echo $model->price; ?></h3>
								</div>

							</div>
						</div>
						<hr>
						<div class="row">
							<a href="#" class="thumbnail">
								<img class="img-rounded icoWidth100prc " alt="..."
									 src="<?php echo $model->image; ?>">
							</a>
							</div>
						<div class="row">
							<?php
								if(!empty($model->type->name)){
									echo '<p><b>Тип: </b>'.$model->type->name.'</p>';
								}
								if(!empty($model->num_rooms)){
									echo '<p><b>К-сть кімнат: </b>'.$model->num_rooms.'</p>';
								}
								if(!empty($model->area)){
									echo '<p><b>Площа(м2): </b>'.$model->area.'</p>';
								}
								if(!empty($model->n_floor)){
									echo '<p><b>Поверх: </b>'.$model->n_floor.'</p>';
								}
								if(!empty($model->state->name)){
									echo '<p><b>Стан: </b>'.$model->state->name.'</p>';
								}
								if(!empty($model->n_floor)){
									echo '<p><b>Поверх: </b>'.$model->n_floor.'</p>';
								}
								if(!empty($model->city_id)){
									echo '<p><b>Місто: </b>'.$model->city_id.'</p>';
								}
								if(!empty($model->desc)){
									echo '<p><b>Опис: </b>'.$model->desc.'</p>';
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
