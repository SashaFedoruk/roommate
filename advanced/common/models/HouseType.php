<?php

	namespace common\models;

	use Yii;
	use yii\helpers\ArrayHelper;

	/**
	 * This is the model class for table "house_type".
	 *
	 * @property integer $id
	 * @property string $name
	 *
	 * @property House[] $houses
	 * @property QuestionaireOfRoommate[] $questionaireOfRoommates
	 */
	class HouseType extends \yii\db\ActiveRecord
	{
		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return 'house_type';
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['name'], 'string', 'max' => 64]
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id'   => 'ID',
				'name' => 'Name',
			];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getHouses()
		{
			return $this->hasMany(House::className(), ['type_id' => 'id']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getQuestionaireOfRoommates()
		{
			return $this->hasMany(QuestionaireOfRoommate::className(), ['type_id' => 'id']);
		}

		public static function getHouseTypes()
		{
			return HouseType::find()->all();
		}

		/**
		 * @return ArrayHelper
		 */
		public static function getMap()
		{
			$types = HouseType::getHouseTypes();
			return ArrayHelper::map($types, 'id', 'name');
		}


		public function __toString()
		{
			return $this->name;
		}
	}
