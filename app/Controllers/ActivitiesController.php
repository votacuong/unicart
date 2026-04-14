<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminActivitiesSessionModel;
use App\Models\AdminCurrencyModel;
use App\Libraries\VLang;
  
class ActivitiesController extends BaseController
{
	public function edit()
    {
		
        helper(['form', 'Common']);
		
		$AdminActivitiesSessionModel = new AdminActivitiesSessionModel();
		
		if ( $this->request->getVar('submit') )
		{
			$data = [
				
				'id'       => get_activities_session()['id'],
			
				'currency'=> $this->request->getVar('currency')[0],
				
				'language'=> $this->request->getVar('language')[0]
				
			];
			
			$AdminActivitiesSessionModel->store($data);
				
			$ndata = [
	
				'subview' => 'activity/edit.php',
				
				'details' => $data,
				
				'title'=>'Edit Activity'
			
			];
			
			$ndata['details'] = array_merge($ndata['details'], $data);
			
			echo view('front-end/main', $ndata);
			
		}
		else
		{
			
			$data = [
		
				'subview' => 'activity/edit.php',
				
				'details' => $AdminActivitiesSessionModel->get( get_activities_session()['id'] ),
				
				'title'=>'Edit Activity'
			
			];
			
			echo view('front-end/main', $data);
			
		}
		
    }
	public function currency($code = '')
	{
		
		$AdminActivitiesSessionModel = new AdminActivitiesSessionModel();
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$data = get_activities_session();
		
		$AdminActivitiesSessionModel->updateField($data['id'], 'currency', $code);
		
		$AdminActivitiesSessionModel->updateField($data['id'], 'symbol', $AdminCurrencyModel->select(['code'=>$code])[0]['symbol']);		
		
		header("Location: ".base64_decode($this->request->getVar('return_url')));
		
		exit;
		
	}
	public function language($language = '')
	{
		
		$AdminActivitiesSessionModel = new AdminActivitiesSessionModel();
		
		$data = get_activities_session();
		
		$AdminActivitiesSessionModel->updateField($data['id'], 'language', $language);
		
		header("Location: ".base64_decode($this->request->getVar('return_url')));
		
		exit;
		
	}
  
}