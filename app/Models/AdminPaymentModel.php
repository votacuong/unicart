<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class AdminPaymentModel extends BaseModel
{
	protected $table = 'payment';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'order_idorder_id',
		
		'customer_id', 
		
		'total',
		
		'time_add',
		
		'status'
		
	];

	protected $useTimestamps = false;

	public $validationRules = [
	
		'order_id' => 'required'
		
	];
	
	public $validationRulesUpdate = [
	
		'order_id' => 'required'
		
	];
	
	protected $validationMessages = [
	
		'order_id' => [
		
		  'required' => 'order_id field is required'
		  
		]
	];
	
	
	public function getObject()
	{
		
		$payment = new stdClass();
		
		$payment->id = 0;
		
		$payment->order_id = 0;
		
		$payment->customer_id = 0;
		
		$payment->total = '';
		
		$payment->time_add = '';
		
		$payment->status = '';
		
		return (array)$payment;
		
	}
	
}