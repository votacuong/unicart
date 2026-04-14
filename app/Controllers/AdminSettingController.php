<?php 
namespace App\Controllers;  

use App\Libraries\VLang;

class AdminSettingController extends BaseController
{
	
	public function index()
    {
		
        helper(['form', 'Common']);
		
		
		$config = new \Config\AppConfig();
		
		if ( $this->request->getVar('submit') )
		{
			$content = '<?php
namespace Config;

class AppConfig{
';

			$fields = [];
			
			foreach($_POST as $key => $value )
			{
				
				if ( $key != 'submit' )
				{
					
					$config->{$key} = $value;
					
					$fields[] = "	public $".$key." = '".$value."';"; 
					
				}
				
			}
			$content .= implode(PHP_EOL, $fields).PHP_EOL.'}';
			
			file_put_contents(dirname(dirname(__FILE__)).'/Config/AppConfig.php', $content);
			
			addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
			
		}
		
        $data = [
		
			'subview'=>'setting/index.php',
			
			'details'=>$config,
			
			'title'=>'Settings'
			
		];
		
        echo view('back-end/main', $data);
		
    }
}
?>