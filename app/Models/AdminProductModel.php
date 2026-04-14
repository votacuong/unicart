<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class AdminProductModel extends BaseModel
{
	protected $table = 'product';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'name', 
		
		'description',
		
		'price',
		
		'sku',
		
		'custom_product',
		
		'state'
		
	];

	protected $useTimestamps = false;

	public $validationRules = [
	
		'name' => 'required',
		
		'description' => 'required',
		
		'price' => 'required',
		
	];
	
	public $validationRulesUpdate = [
	
		'name' => 'required',
		
		'description' => 'required',
		
		'price' => 'required',
		
	];
	
	protected $validationMessages = [
	
		'name' => [
		
		  'required' => 'name field is required'
		  
		],
		'description' => [
		
		  'required' => 'description field is required'
		  
		],
		'price' => [
		
		  'required' => 'price field is required'
		  
		]
	];
	
	
	public function getObject()
	{
		
		$product = new stdClass();
		
		$product->id = 0;
		
		$product->name = '';
		
		$product->description = '';
		
		$product->price = '';
		
		$product->sku = '';
		
		$product->address = '';
		
		$product->latitude = '';
		
		$product->longitude = '';
		
		$product->state = 0;		
		
		return (array)$product;
		
	}
	
}