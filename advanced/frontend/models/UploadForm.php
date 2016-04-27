<?php

	namespace frontend\models;

	use Yii;
	use yii\base\Model;

	class UploadForm extends Model
	{
		public $file;

		public function rules()
		{
			return [

					['file','file','extensions'=> ['rar']],

			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
					'file' => 'Зображення користувача',
			];
		}
	}