<?php
namespace App\Libraries;

use App\Models\AdminCurrencyModel;

final class Currency_Item{
	
	public $id;
	
	public $code;
	
	public $symbol;
	
	public $exchange;
	
	public $state;
	
	public function __construct($id = 0, $code = '', $symbol = '', $exchange = '', $state = 0)
	{
		
		$this->id       = $id;
		
		$this->code     = $code;
		
		$this->symbol   = $symbol;
		
		$this->exchange = $exchange;
		
		$this->state    = $state;
		
	}
	
}

class Currency{
	
	public $currency;
	
	public static $instances = null;
	
	public function __construct()
	{
		
		$this->__load();
		
	}
	
	public static function getInstance()
	{
		
		if (self::$instances == null)
		{
			
			self::$instances = new self();
			
		}
		
		return self::$instances;
		
	}
	
	public function __load()
	{
		
		$AppConfig = new \Config\AppConfig();
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currency = $AdminCurrencyModel->select(['code'=>$AppConfig->system_currency]);
		
		$this->currency = new Currency_Item($currency[0]['id'], $currency[0]['code'], $currency[0]['symbol'], abb_json_decode($currency[0]['exchange']), $currency[0]['state']);
		
		return $this;
		
	}
	
	public function __loadCurrent()
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currency = $AdminCurrencyModel->select(['code'=>get_activities_session()['currency']]);
		
		$this->currency = new Currency_Item($currency[0]['id'], $currency[0]['code'], $currency[0]['symbol'], abb_json_decode($currency[0]['exchange']), $currency[0]['state']);
		
		return $this;
		
	}
	
	public function __loadUSD()
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currency = $AdminCurrencyModel->select(['code'=>'USD']);
		
		$this->currency = new Currency_Item($currency[0]['id'], $currency[0]['code'], $currency[0]['symbol'], abb_json_decode($currency[0]['exchange']), $currency[0]['state']);
		
		return $this;
		
	}
	
	public function __getExchange($name)
	{
		
		return isset($this->currency->exchange[$name])?$this->currency->exchange[$name]:null;
		
	}
	
}

?>