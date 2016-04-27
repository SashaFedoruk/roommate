<?php

	/* @var $this yii\web\View */
	/* @var $models common\models\House[] */
	/* @var $pages Pagination */
	/* @var $name string */
	/* @var $message string */
	/* @var $exception Exception */

	use common\models\User;
	use yii\widgets\LinkPager;
	use yii\data\Pagination;
	use yii\helpers\Url;

	$this->title = "Мої оголошення";

?>

<div class="container content noPadding-xs">
	<br>

	<div class="row noMargin-xs">
		<?php require_once('partial_views\left_profile_menu.php'); ?>
		<div class="col-xs-12  col-sm-8 col-md-9  noPadding-xs">
			<div class="row noMargin">
				<div class="col-md-12 noPadding-xs">
					<div class="searchResult">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-5 col-md-offset-7">
								<a href="<?php echo Url::toRoute(['create-ads']); ?>">
									<button type="button" class="btn btn-success col-xs-12 col-md-12">Створити оголошення</button>
								</a>
							</div>
						</div>
						<hr>

						<?php
							if (!empty($models)) {
								foreach ($models as $el) {
									echo $this->render('partial_views\user_ads_partial', ['param' => $el]);
									?>

								<?php } ?>
								<div class="row">
									<div class="navPages">
										<?php echo LinkPager::widget([
												'pagination' => $pages,
										]); ?>
									</div>
								</div>
							<?php } else { ?>
								<h2>Не знайдено жодного вашого оголошення!</h2>
							<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
