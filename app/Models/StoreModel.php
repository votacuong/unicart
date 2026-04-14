<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class StoreModel extends BaseModel
{
	protected $table = 'store';
	
	protected $primaryKey = 'id';
	
	public function getStore($id = 0)
	{
		if ($id == 0)
		{
			
			$store = $this->select(['vendor_id'=>session()->get('id')]);
			
			if (count($store) == 0)
			{
				
				return $this->store([
				
					'id'=>0,
					
					'vendor_id'=>session()->get('id')
					
				]);
				
			}
			
			return $store[0]['id'];
		
		}
		
		$store = $this->select(['vendor_id'=>$id]);
		
		if (count($store) == 0)
		{	
			
			return $this->store([
			
				'id'=>0,
				
				'vendor_id'=>$id
				
			]);
			
			$store = $this->select(['vendor_id'=>$id]);
		}
		
		return $store[0]['id'];
		
	}
	
}