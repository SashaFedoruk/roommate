<?php
	/* @var $param common\models\House */
	use yii\helpers\Url;

?>
<div class="row searchInfo noPadding-xs">
	<div class="col-xs-12 col-md-12 panel panel-default">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-9">
					<h4><?php echo $param->title; ?></h4>
				</div>
				<div class="col-md-3">
					<div class="priceHouse">
						<h4 class="noPadding noMargin"><?php echo $param->price; ?></h4>
					</div>

				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<?php
						if(!empty($param->type->name)){
							echo '<p><b>Тип: </b>'.$param->type->name.'</p>';
						}
						if(!empty($param->num_rooms)){
							echo '<p><b>К-сть кімнат: </b>'.$param->num_rooms.'</p>';
						}
						if(!empty($param->area)){
							echo '<p><b>Площа(м2): </b>'.$param->area.'</p>';
						}
						if(!empty($param->n_floor)){
							echo '<p><b>Поверх: </b>'.$param->n_floor.'</p>';
						}
						if(!empty($param->state->name)){
							echo '<p><b>Стан: </b>'.$param->state->name.'</p>';
						}
						if(!empty($param->n_floor)){
							echo '<p><b>Поверх: </b>'.$param->n_floor.'</p>';
						}
						if(!empty($param->city_id)){
							echo '<p><b>Місто: </b>'.$param->city_id.'</p>';
						}
						if (!empty($param->desc)) {
							$data = $param->desc;
							if(strlen($data) > 50){
								$text = substr ($data, 0, 50).'...';
							}
							echo '<p><b>Опис: </b>' . $data . '</p>';
						}
					?>
				</div>
				<div class="clearfix visible-xs"></div>
				<div class="col-xs-12 col-sm-12 col-md-6 noPadding">
					<a href="#" class="thumbnail">
						<img class="img-rounded icoWidth100prc" alt="..." src="<?php echo $param->image;?>">
					</a>
					<!--<div class="row noMargin-xs">
						<div class="col-xs-4 col-md-4 noPadding-xs">
							<div class="ico40x40Circle ico35x35Circle-xs smokingNoMatterIco"></div>
						</div>
						<div class="col-xs-4 col-md-4 noPadding-xs">
							<div class="ico40x40Circle ico35x35Circle-xs alcoholNoMatterIco"></div>
						</div>
						<div class="col-xs-4 col-md-4 noPadding-xs">
							<div class="ico40x40Circle ico35x35Circle-xs animalsNoMatterIco"></div>
						</div>
					</div>-->
				</div>
			</div>
		</div>

		<div class="row panel-footer">
			<div class="col-xs-12  col-md-4 noPadding-xs">
				<a href="<?php echo Url::to(['main/wiew-ad', 'id' => $param->id]); ?>">
					<button type="button" class="btn btn-primary col-xs-12">Переглянути</button>
				</a>
			</div>

			<div class="col-xs-12  col-md-8 noPadding-xs">
				<div class="silverBlock">
					<b>Дата створення: </b><?php
						$date = new DateTime($param->create_date);
						echo  $date->format('Y-m-d');
					?>
				</div>
			</div>
		</div>
	</div>
	<hr/>

</div>





