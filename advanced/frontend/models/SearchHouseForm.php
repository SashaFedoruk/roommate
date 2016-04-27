<?php
	/**
	 * Created by PhpStorm.
	 * User: Александр
	 * Date: 26.01.2016
	 * Time: 21:38
	 */

namespace frontend\models;

use common\models\House;
use yii\base\Model;
use Yii;


class SearchHouseForm extends Model
{
	public $city_id;
	public $type_id;
	public $priceMin;
	public $priceMax;
	public $nRoomsMin;
	public $nRoomsMax;
	public $AreaMin;
	public $AreaMax;
	public $nFloorMin;
	public $nFloorMax;
	public $state_id;

	public $city_name;

	public function rules()
	{
		return [
				[['city_id', 'type_id', 'state_id', 'nRoomsMin', 'nRoomsMax', 'nFloorMin', 'nFloorMax'], 'integer'],
				[['priceMin', 'priceMax', 'AreaMin', 'AreaMax'], 'number'],
				['city_name', 'string'],
		];
	}

	function getParams(){
		$params = '';
		if(!empty($this->city_id)){ $params = $params.' city_id = "'.$this->city_id.'" and'; }
		if(!empty($this->type_id)){ $params = $params.' type_id = '.$this->type_id.' and'; }
		if(!empty($this->priceMin)){ $params = $params.' price >= '.$this->priceMin.' and'; }
		if(!empty($this->priceMax)){ $params = $params.' price <= '.$this->priceMax.' and'; }
		if(!empty($this->nRoomsMin)){ $params = $params.' num_rooms >= '.$this->nRoomsMin.' and'; }
		if(!empty($this->nRoomsMax)){ $params = $params.' num_rooms <= '.$this->nRoomsMax.' and'; }
		if(!empty($this->nFloorMin)){ $params = $params.' n_floor >= '.$this->nFloorMin.' and'; }
		if(!empty($this->nFloorMax)){ $params = $params.' n_floor <= '.$this->nFloorMax.' and'; }
		if(!empty($this->AreaMin)){ $params = $params.' area >= '.$this->AreaMin.' and'; }
		if(!empty($this->AreaMax)){ $params = $params.' area <= '.$this->AreaMax.' and'; }
		if(!empty($this->state_id)){ $params = $params.' state_id = '.$this->state_id.' and'; }
		if(!Yii::$app->user->isGuest){ $params = $params.' author_id != '.Yii::$app->user->id.' and'; }
		$params = $params.' TRUE';
		return $params;
	}

	public function getHouses(){
		return House::find()->where($this->getParams())->all();
		#return House::find()->all();
	}
	public function getQuery(){
		return House::find()->where($this->getParams())->asArray();
	}
}