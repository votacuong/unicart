<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class ResetpasswordModel extends BaseModel
{
	
	protected $table = 'resetpassword';
	
	protected $primaryKey = 'id';
	
	public function lostpassword($email, $code)
	{
		$this->deleteItemWhere(['email'=>$email]);
		
		$this->store([
		
			'id'=>0,
			
			'email'=>$email,
			
			'code'=>$code
			
		]);		
		
	}
	
}