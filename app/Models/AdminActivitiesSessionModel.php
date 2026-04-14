<?php namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Vlang;
use stdClass as stdClass;

class AdminActivitiesSessionModel extends BaseModel
{
	protected $table = 'activities_session';
	
	protected $primaryKey = 'id';
	
	protected $allowedFields = [
	
		'currency',
		
		'symbol',
		
		'language', 
		
		'session_id',
		
		'date_created'
		
	];
}