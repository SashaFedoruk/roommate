<?php

	namespace common\models;

	use Yii;
	use yii\db\ActiveRecord;

	/**
	 * This is the model class for table "questionaire_of_roommate".
	 *
	 * @property integer $id
	 * @property integer $user_id
	 * @property string $city_id
	 * @property string $city_name
	 * @property integer $type_id
	 * @property integer $age_min
	 * @property integer $age_max
	 * @property string $gender
	 * @property string $nationality
	 * @property string $cigarette_addiction
	 * @property string $alcohol_addiction
	 * @property string $availability_of_house
	 * @property integer $price_of_house_min
	 * @property integer $price_of_house_max
	 * @property integer $state_id
	 *
	 * @property User $user
	 * @property HouseType $type
	 * @property HouseState $state
	 */
	class QuestionaireOfRoommate extends ActiveRecord
	{

		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return 'questionaire_of_roommate';
		}

		/**
		 * @return QuestionaireOfRoommate
		 */
		public static function findIdentity($id)
		{
			return static::findOne(['id' => $id]);
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['user_id', 'type_id', 'age_min', 'age_max', 'price_of_house_min', 'price_of_house_max', 'state_id'], 'integer'],
				[['gender', 'cigarette_addiction', 'alcohol_addiction', 'availability_of_house'], 'string', 'max' => 10],
				[['nationality', 'city_id', 'city_name'], 'string', 'max' => 64]
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id'                    => 'ID',
				'user_id'               => 'User ID',
				'city_id'               => 'City ID',
				'type_id'               => 'Тип житла',
				'age_min'               => 'Мінімальний вік',
				'age_max'               => 'Максимальний вік',
				'gender'                => 'Стать',
				'nationality'           => 'Національність',
				'cigarette_addiction'   => 'Ставлення до куріння',
				'alcohol_addiction'     => 'Ставлення до алкоголю',
				'availability_of_house' => 'Наявність житла',
				'price_of_house_min'    => 'Мінімальна ціна житла',
				'price_of_house_max'    => 'Максимальна ціна житла',
				'state_id'              => 'Стан житла',
				'city_name'             => 'Місто для проживання'
			];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getUser()
		{
			return $this->hasOne(User::className(), ['id' => 'user_id']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getType()
		{
			return $this->hasOne(HouseType::className(), ['id' => 'type_id']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getState()
		{
			return $this->hasOne(HouseState::className(), ['id' => 'state_id']);
		}


		/**
		 * @return string
		 */
		function getParamsOfQuestionare()
		{
			$params = '';

			if (!empty($this->city_id)) {
				$params = $params . ' city_id = ' . $this->city_id . ' and';
			}
			if (!empty($this->type_id)) {
				$params = $params . ' type_id = ' . $this->type_id . ' and';
			}
			if (!empty($this->price_of_house_min)) {
				$params = $params . ' price_of_house_min >= ' . $this->price_of_house_min . ' and';
			}
			if (!empty($this->price_of_house_max)) {
				$params = $params . ' price_of_house_max <= ' . $this->price_of_house_max . ' and';
			}
			if (!empty($this->gender)) {
				$params = $params . ' gender = ' . $this->gender . ' and';
			}
			if (!empty($this->age_min)) {
				$params = $params . ' age_min >= ' . $this->age_min . ' and';
			}
			if (!empty($this->age_max)) {
				$params = $params . ' age_max <= ' . $this->age_max . ' and';
			}
			if (!empty($this->nationality)) {
				$params = $params . ' nationality = ' . $this->nationality . ' and';
			}
			if (!empty($this->cigarette_addiction)) {
				$params = $params . ' cigarette_addiction = ' . $this->cigarette_addiction . ' and';
			}
			if (!empty($this->alcohol_addiction)) {
				$params = $params . ' alcohol_addiction = ' . $this->alcohol_addiction . ' and';
			}
			if (!empty($this->state_id)) {
				$params = $params . ' state_id = ' . $this->state_id . ' and';
			}
			if (!Yii::$app->user->isGuest) {
				$params = $params . ' user_id != ' . Yii::$app->user->id . ' and';
			}
			$params = $params . ' and search_in == TRUE and TRUE';
			return $params;
		}

		function getParamsOfUsers()
		{
			$params = "SELECT u.* FROM `user_info` as u, `questionaire_of_roommate` as q  WHERE u.user_id = q.user_id AND ";
			if (!empty($this->city_id)) {
				$params = $params . ' q.city_id = "' . $this->city_id . '" and';
			}
			if (!empty($this->age_max)) {
				$params = $params . ' TIMESTAMPDIFF(YEAR, u.birth_date, NOW()) <= ' . $this->age_max . ' and';
			}
			if (!empty($this->age_min)) {
				$params = $params . ' TIMESTAMPDIFF(YEAR, u.birth_date, NOW()) >= ' . $this->age_min . ' and';
			}
			if (!empty($this->nationality)) {
				$params = $params . ' u.nationality = "' . $this->nationality . '" and';
			}
			if (!empty($this->cigarette_addiction)) {
				$params = $params . ' u.cigarette_addiction = "' . $this->cigarette_addiction . '" and';
			}
			if (!empty($this->alcohol_addiction)) {
				$params = $params . ' u.alcohol_addiction = "' . $this->alcohol_addiction . '" and';
			}
			if (!Yii::$app->user->isGuest) {
				$params = $params . ' u.user_id != ' . Yii::$app->user->id . ' and';
			}
			if (!empty($this->price_of_house_min)) {
				$params = $params . ' q.price_of_house_min >= ' . $this->price_of_house_min . ' and';
			}
			if (!empty($this->price_of_house_max)) {
				$params = $params . ' q.price_of_house_max <= ' . $this->price_of_house_max . ' and';
			}
			if (!empty($this->gender)) {
				$params = $params . ' u.gender = "' . $this->gender . '" and';
			}
			if (!empty($this->type_id)) {
				$params = $params . ' q.type_id = ' . $this->type_id . ' and';
			}
			if (!empty($this->state_id)) {
				$params = $params . ' q.state_id = ' . $this->state_id . ' and';
			}
			if(!empty($this->availability_of_house)){
				$params = $params . ' q.availability_of_house = "' . $this->availability_of_house . '" and';
			}
			$params = $params . ' u.search_in = TRUE and TRUE';
			return $params;
		}

	}
