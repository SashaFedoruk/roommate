<?php

	namespace common\models;

	use Yii;
	use yii\db\ActiveRecord;

	/**
	 * This is the model class for table "messages".
	 *
	 * @property integer $id
	 * @property integer $from_id
	 * @property integer $for_id
	 * @property string $message
	 * @property integer $status
	 * @property string $created_at
	 *
	 * @property User $from
	 * @property User $for
	 */
	class Messages extends \yii\db\ActiveRecord
	{
		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return 'messages';
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public static function getUserMessages()
		{
			$sql = 'SELECT id, from_id, MAX(created_at) as updated_at'
				. ' FROM (SELECT id, from_id, created_at'
				. ' FROM messages'
				. ' WHERE for_id = '.User::GetCurrentUser()->id
				. ' UNION SELECT id, for_id, created_at'
				. ' FROM messages'
				. ' WHERE from_id = '.User::GetCurrentUser()->id
				. ' ORDER BY created_at DESC) as talks'
				. ' GROUP BY from_id '
				. ' ORDER BY created_at;';
			$queryRez = Messages::findBySql($sql)->all();
			$params = '';
			foreach($queryRez as $el){
				if(!empty($params)){
					$params .= ' OR ';
				}
				$params .= ' id = '.$el->id;
			}
			if(!empty($params)){
				return Messages::find()->where($params)->orderBy('created_at desc');
			}
			return null;
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public static function getDialog($from_id)
		{
			return User::GetCurrentUser()->getMessagesAll()->andWhere('for_id = ' . $from_id . ' OR from_id = ' . $from_id);
		}

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
				[['from_id', 'for_id', 'status'], 'integer'],
				[['from_id', 'for_id', 'message', 'created_at'], 'required'],
				[['created_at'], 'safe'],
				[['message'], 'string', 'max' => 750]
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id'         => 'ID',
				'from_id'    => 'From ID',
				'for_id'     => 'for ID',
				'message'    => 'Message',
				'status'     => 'Status',
				'created_at' => 'Created At',
			];
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getFrom()
		{
			return $this->hasOne(User::className(), ['id' => 'from_id']);
		}

		/**
		 * @return \yii\db\ActiveQuery
		 */
		public function getFor()
		{
			return $this->hasOne(User::className(), ['id' => 'for_id']);
		}
	}
