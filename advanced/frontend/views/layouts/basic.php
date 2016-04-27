<?php

	/* @var $this \yii\web\View */
	/* @var $content string */

	use yii\helpers\Html;
	use frontend\assets\AppAsset;
	use yii\helpers\Url;
	use common\models\User;

	$userInfo = User::GetCurrentUser()->userInfo;
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	<?php AppAsset::register($this); ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand navbar-logo" href="#">
				<img src="/img/logo.png" alt="">
			</a>
			<!--<a class="navbar-brand" href="#">
				Roommate Search
			</a>-->
		</div>
		<div class="navbar-collapse collapse" style="height: 1px;">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo Url::toRoute(['index']); ?>">Головна</a></li>
				<li><a href="<?php echo Url::toRoute(['search-roommate']); ?>">Пошук співмешканця</a></li>
				<li class="borderBottom-xs"><a href="<?php echo Url::toRoute(['search-house']); ?>">Пошук житла</a></li>
			</ul>


			<?php  if (Yii::$app->user->isGuest) { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?php echo Url::toRoute(['signup']); ?>">Реєстрація</a></li>
				<li><a href="<?php echo Url::toRoute(['login']); ?>">Вхід</a></li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav visible-xs">
				<li>
					<a href="<?php echo Url::toRoute(['profile']); ?>"><b><?php echo $userInfo;  ?></b></a>
				</li>
				<li>
					<a href="<?php echo Url::toRoute(['messages']); ?>">
						<span>Повідомлення</span>
						<span class="badge pull-right"></span>
					</a>
				</li>
				<li><a href="<?php echo Url::toRoute(['setting']); ?>">Налаштування</a></li>
				<li><a href="<?php echo Url::toRoute(['wiew-user-ads']); ?>">Мої оголошення</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo Url::toRoute(['logout']); ?>">Вихід</a></li>
			</ul>

			<div class="navbar-right">
				<ul class="nav navbar-nav navbar-right hidden-xs dropdown-toggle" data-toggle="dropdown">
					<li>
						<a href="<?php echo Url::toRoute(['profile']); ?>">
							<label class="minWidht160">
								<?php echo User::GetCurrentUser()->userInfo;   ?>
							</label>
						</a>
					</li>
					<li class=" hidden-sm">
						<div class="btn-group">
							<div class="icoUser ico45x45Circle" style="<?php echo 'background-image: url(..'.$userInfo->image.')'; ?>"></div>
						</div>
					</li>
				</ul>

				<ul class="dropdown-menu" role="menu">
					<li><a href="<?php echo Url::toRoute(['profile']); ?>">Профіль</a></li>
					<li>
						<a href="<?php echo Url::toRoute(['messages']); ?>">
							<span>Повідомлення</span>
							<span class="badge pull-right"></span>
						</a>
					</li>
					<li><a href="<?php echo Url::toRoute(['setting']); ?>">Налаштування</a></li>
					<li><a href="<?php echo Url::toRoute(['wiew-user-ads']); ?>">Мої оголошення</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo Url::toRoute(['logout']); ?>">Вихід</a></li>
				</ul>
			</div>
			<?php } ?>

		</div>
	</div>
</div>





<?= $content ?>


<br>
<footer class="footer">
	<div class="container">
		<p class="text-muted">Created by Sasha Fedoruk</p>
	</div>
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
