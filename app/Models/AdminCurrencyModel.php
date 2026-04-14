<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class AdminCurrencyModel extends BaseModel
{
	protected $table = 'currency';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'code',
		
		'symbol', 
		
		'exchange',
		
		'state'
		
	];

	protected $useTimestamps = false;

	public $validationRules = [
	
		'code' => 'required'
		
	];
	
	public $validationRulesUpdate = [
	
		'code' => 'required'
		
	];
	
	protected $validationMessages = [
	
		'code' => [
		
		  'required' => 'code field is required'
		  
		]
	];
	
	
	public function getObject()
	{
		
		$Currency = new stdClass();
		
		$Currency->id       = 0;
		
		$Currency->code     = '';
		
		$Currency->symbol   = '';
		
		$Currency->exchange = '';
		
		$Currency->state    = 0;
		
		return (array)$Currency;
		
	}
	
}