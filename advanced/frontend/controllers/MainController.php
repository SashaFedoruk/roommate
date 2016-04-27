<?php
	/**
	 * Created by PhpStorm.
	 * User: Александр
	 * Date: 18.01.2016
	 * Time: 20:21
	 */

	namespace frontend\controllers;

	use common\models\ChangePaswordForm;
	use common\models\House;
	use common\models\LoginForm;
	use common\models\Messages;
	use common\models\QuestionaireOfRoommate;
	use common\models\User;
	use common\models\UserInfo;
	use DateTime;
	use frontend\models\SearchHouseForm;
	use frontend\models\SignupForm;
	use frontend\models\UploadForm;
	use Yii;
	use yii\data\Pagination;
	use yii\filters\AccessControl;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\web\UploadedFile;

	class MainController extends Controller
	{
		public $layout = 'basic';
		public $defaultAction = 'index';
		public $postsInPage = 10;

		public function behaviors()
		{
			return [
				'access' => [
					'class' => AccessControl::className(),
					'only'  => ['auth', 'logout', 'signup', 'profile', 'profile-setting', 'edit-anket', 'edit-user-info'
						, 'wiew-user-ads', 'create-ads', 'setting', 'messages', 'view-messages', 'get-messages'],
					'rules' => [
						[
							'allow'   => true,
							'actions' => ['login', 'signup'],
							'roles'   => ['?'],
						],
						[
							'allow'   => true,
							'actions' => ['logout', 'profile', 'profile-setting', 'edit-anket', 'edit-user-info'
								, 'wiew-user-ads', 'create-ads', 'setting', 'messages', 'view-messages', 'get-messages'],
							'roles'   => ['@'],
						],
					],
				],
			];
		}

		public function actions()
		{
			return [
				'error'            => [
					'class' => 'yii\web\ErrorAction',
				],
			];
		}

		public function actionIndex()
		{
			return $this->render('index');
		}

		public function actionLogin()
		{
			if (!\Yii::$app->user->isGuest) {
				return $this->goHome();
			}
			$model = new LoginForm();
			if ($model->load(Yii::$app->request->post()) && $model->login()) {
				$this->layout = 'authorize';
				return $this->goHome();
			} else {
				return $this->render('login', [
					'model' => $model,
				]);
			}
		}

		public function actionLogout()
		{
			Yii::$app->user->logout();
			return $this->goHome();
		}

		public function actionSignup()
		{

			$model = new SignupForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup()) {
					if (Yii::$app->getUser()->login($user)) {
						return $this->goHome();
					}
				}
			}

			return $this->render('signup', [
				'model' => $model,
			]);
		}

		public function actionSearchHouse()
		{
			$model = new SearchHouseForm();
			if ($model->load(Yii::$app->request->get()) && $model->validate()) {
				#return $this->render('search-house', ['model' => $model]);
				$pagHelper = $this->PaginationHouseHelper($model);
				return $this->render('search-house', [
					'model'  => $model,
					'models' => $pagHelper['models'],
					'pages'  => $pagHelper['pages'],
					'tmp'    => $model->getParams(),
				]);
			}
			$pagHelper = $this->PaginationHouseHelper($model);
			return $this->render('search-house', [
				'model'  => $model,
				'models' => $pagHelper['models'],
				'pages'  => $pagHelper['pages'],
				'tmp'    => $model->getParams(),
			]);
		}

		/* @var $model SearchHouseForm */
		function PaginationHouseHelper($model)
		{
			$query = House::find()->where($model->getParams());
			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count()]);
			$pages->setPageSize($this->postsInPage);
			$models = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();

			return [
				'models' => $models,
				'pages'  => $pages,
			];
		}

		public function actionSearchRoommate($anketId = null)
		{
			$model = new QuestionaireOfRoommate();
			if (!is_null($anketId)) {
				$model = QuestionaireOfRoommate::findIdentity($anketId);
				if (is_null($model) || $model->user_id != User::GetCurrentUser()->id) {
					$model = new QuestionaireOfRoommate();
				} else {
					$model = clone QuestionaireOfRoommate::findIdentity($anketId);
				}
			}

			if ($model->load(Yii::$app->request->get()) && $model->validate()) {
				#return $this->render('search-house', ['model' => $model]);
				$pagHelper = $this->PaginationRoommateHelper($model);
				return $this->render('search-roommate', [
					'model'  => $model,
					'models' => $pagHelper['models'],
					'pages'  => $pagHelper['pages'],
				]);
			}
			$pagHelper = $this->PaginationRoommateHelper($model);
			return $this->render('search-roommate', [
				'model'  => $model,
				'models' => $pagHelper['models'],
				'pages'  => $pagHelper['pages'],
			]);
		}

		/* @var $model QuestionaireOfRoommate */
		function PaginationRoommateHelper($model)
		{
			//$query = UserInfo::find()->where($model->getParamsOfUsers());
			$query = UserInfo::findBySql($model->getParamsOfUsers());
			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count()]);
			$pages->setPageSize($this->postsInPage);
			$models = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();
			return [
				'models' => $models,
				'pages'  => $pages,
			];
		}

		public function actionProfile()
		{
			return $this->render('profile');
		}

		public function actionEditAnket()
		{
			$model = User::GetCurrentUser()->questionaireOfRoommate;
			if (empty($model)) {
				$model = new QuestionaireOfRoommate();
				$model->user_id = User::GetCurrentUser()->id;
				$model->save();
				$model = User::GetCurrentUser()->questionaireOfRoommate;
			}
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$model->save();
			}

			return $this->render('edit-anket', ['model' => $model]);
		}

		public function actionEditUserInfo()
		{
			$model = User::GetCurrentUser()->userInfo;

			$imageModel = new UploadForm();
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$model->save();
			}
			if ($imageModel->load(Yii::$app->request->post())) {
				$file = UploadedFile::getInstance($imageModel,'file');
				if($imageModel->validate() && !is_null($file)) {
					$fileName = $model->user_id . '_photo.jpg';
					$path = Yii::getAlias('@app/web/uploads').'/'. $fileName;
					$uploaded = $file->saveAs($path);
					$curUserModel = User::GetCurrentUser()->userInfo;
					$curUserModel->image = Yii::getAlias('@web/uploads/').$fileName;
					if($curUserModel->validate()){
						$curUserModel->save();
					}

				}
			}

			return $this->render('edit-user-info', ['model' => $model, 'imageModel' => $imageModel]);
		}

		public function actionWiewUserAds()
		{
			$query = User::GetCurrentUser()->getHouses();
			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count()]);
			$pages->setPageSize($this->postsInPage);
			$models = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();

			return $this->render('wiew-user-ads', [
				'models' => $models,
				'pages'  => $pages,
			]);
		}

		public function  actionCreateAds()
		{
			$model = new House();
			$model->author_id = User::GetCurrentUser()->id;
			$model->city_id = 1;
			$model->image = '/img/room.jpg';
			if ($model->load(Yii::$app->request->post()) && $model->validate()) {
				$date = new DateTime();
				$model->create_date = $date->format('Y-m-d H:i:s');
				$model->save();
				$this->redirect(['wiew-user-ads']);
			}
			return $this->render('edit-ads', ['model' => $model]);
		}

		public function actionEditAds($id)
		{
			$model = House::findIdentity($id);
			if ($model->author_id == User::GetCurrentUser()->id) {
				if ($model->load(Yii::$app->request->post()) && $model->validate()) {
					$model->save();
				}
				return $this->render('edit-ads', ['model' => $model]);
			}
			$this->redirect(['wiew-user-ads']);
		}

		public function actionRemoveAds($id)
		{
			$model = House::findIdentity($id);
			if ($model->author_id == User::GetCurrentUser()->id) {
				$model->delete();
			}
			$this->redirect(['wiew-user-ads']);
		}

		public function actionWiewAd($id)
		{
			$model = House::findIdentity($id);
			if ($model === null) {
				throw new NotFoundHttpException;
			}
			$user = $model->author;
			return $this->render('wiew-ad', ['user' => $user, 'model' => $model]);
		}

		public function actionWiewProfile($id)
		{
			$model = User::findIdentity($id);
			if ($model === null) {
				throw new NotFoundHttpException;
			}

			return $this->render('wiew-profile', ['model' => $model]);
		}

		public function actionSetting()
		{
			$changePassword = new ChangePaswordForm();
			$user = User::GetCurrentUser();
			if ($user->load(Yii::$app->request->post()) && $user->validate()) {
				$user->save(false);
				return $this->render('setting', ['user' => $user, 'password_form' => $changePassword]);
			}
			if ($changePassword->load(Yii::$app->request->post()) && $changePassword->validate()) {
				$user->setPassword($changePassword->password);
				$user->save();
				$changePassword = new ChangePaswordForm();
				return $this->render('setting', ['user' => $user, 'password_form' => $changePassword]);
			}

			return $this->render('setting', ['user' => $user, 'password_form' => $changePassword]);
		}

		public function actionMessages()
		{
			$messages = Messages::getUserMessages();
			if(!is_null($messages)){
				$messages = $messages->all();
			}
			return $this->render('messages', ['messages' => $messages]);
		}

		public function  actionViewMessages($for)
		{
			$toUser = UserInfo::findIdentity($for);
			$messages = Messages::getDialog($for)->all();
			return $this->render('view-messages', ['toUser' => $toUser, 'messages' => $messages]);
		}

		public function actionGetMessages()
		{
			$this->layout = false;
			if (Yii::$app->request->isAjax) {
				$data = Yii::$app->request->post();
				$for = $data['for'];
				$last_message_id = $data['last_message_id'];
				$messages = Messages::getDialog($for)->andWhere(' id > ' . $last_message_id)->all();
				$messagesResult = ' ';
				if (!empty($messages)) {
					if(!empty($last_message_id)) {
						$prevDate = new DateTime(Messages::findIdentity($last_message_id)->created_at);
						$prevDate = $prevDate->format('F d');
					}
					else{
						$prevDate = "";
					}
					/* @var $el Messages */
					foreach ($messages as $el) {
						$messagesResult .= $this->render('partial_views\message_partial', ['model' => $el, 'prev_date' => $prevDate]);
						$date = new DateTime($el->created_at);
						$prevDate = $date->format('F d');
						if ($el->for_id == User::GetCurrentUser()->id && $el->status != 2) {
							$el->status = 2;
							$el->save();
						}
					}
					/* @var $last_message Messages */
					$last_message = end($messages);
				} else if (!empty($last_message_id)) {
					$last_message = Messages::findIdentity($last_message_id);
				} else {
					/* @var $last_message Messages */
					$last_message = 0;
				}
				#return  $result;
				return json_encode([
					'messagesResult'  => $messagesResult,
					'last_message_id' => $last_message->id,
				]);
			}
		}

		public function actionSendMessages()
		{
			if (Yii::$app->request->isAjax) {
				$data = Yii::$app->request->post();
				$message = new Messages();
				$message->message =  nl2br($data['message']);
				$message->for_id = $data['for'];
				$message->from_id = User::GetCurrentUser()->id;
				$message->status = 0;
				$date = new DateTime();
				$message->created_at = $date->format('Y-m-d h:i:s');
				if ($message->validate()) {
					$message->save();
					return "1";
				}
				return "0";
			}
		}

		public function actionTest(){
			$this->layout = false;
			return $this->render('test');
		}
	}