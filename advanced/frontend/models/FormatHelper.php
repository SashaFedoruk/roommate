<?php
	/**
	 * Created by PhpStorm.
	 * User: Александр
	 * Date: 28.01.2016
	 * Time: 1:40
	 */

	namespace frontend\models;

	use Yii;


	class FormatHelper
	{
		public $TRUE = 'Yes';
		public $FALSE = 'No';
		public $NO_MATTER = 'NoMatter';


		public static function getInfoStr($name, $data)
		{
			return '<div class="row">'
			. '<div class="col-md-6 text-center"><b>' . $name . '</b></div>'
			. '<div class="col-md-6 text-center">' . $data . '</div>'
			. '</div><br>';
		}

		public static function getInfoImageStr($name, $data)
		{

			$path = Yii::getAlias('@web') . '/img/' . $data;
			return '<div class="row">'
			. '<div class="col-md-6 text-center"><b>' . $name . '</b></div>'
			. '<div class="col-md-6 text-center">'
			. '<img class="img- ico40x40 img-circle" alt="' . $data . '" src="' . $path . '"></div>'
			. '</div><br>';
		}

		public static function getInfoPairImageStr($name, $data1, $data2)
		{
			$path1 = Yii::getAlias('@web') . '/img/' . $data1;
			$path2 = Yii::getAlias('@web') . '/img/' . $data2;
			return '<div class="row">'
			. '<div class="col-md-6 text-center"><b>' . $name . '</b></div>'
			. '<div class="col-md-3 col-xs-6 text-center">'
			. '	<img class="img- ico40x40 img-circle" alt="' . $data1 . '" src="' . $path1 . '"></div>'
			. '<div class="col-md-3 col-xs-6 text-center">'
			. '<img class="img- ico40x40 img-circle" alt="' . $data2 . '" src="' . $path2 . '"></div>'
			. '</div><br>';
		}
	}