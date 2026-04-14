<?php
namespace App\Libraries;  

class VLang{
	
	public static $langs = [];
	
	public static function __e($code)
	{
		
		if ( count( self::$langs ) == 0 )
		{
			
			if (!isAdmin())
			{
				$data = get_activities_session();
				
				if (empty($data['language']))
				{
					
					$language = 'English';
					
				}
				else
				{
					
					$language = $data['language'];
					
				}
				
				self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$language.'.ini' );
				
			}
			else
			{		
		
				$AppConfig = new \Config\AppConfig();
				
				self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$AppConfig->system_language.'.ini' );

			}
			
		}
		
		echo isset( self::$langs[$code] ) ? self::$langs[$code] : $code;
		
	}
	
	public static function __($code)
	{
		
		if ( count( self::$langs ) == 0 )
		{
			
			if (!isAdmin())
			{
				
				$data = get_activities_session();
				
				if (empty($data['language']))
				{
					
					$language = 'English';
					
				}
				else
				{
					
					$language = $data['language'];
					
				}
				
				self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$language.'.ini' );
				
			}
			else
			{		
		
				$AppConfig = new \Config\AppConfig();
				
				self::$langs = parse_ini_file( dirname(dirname(__FILE__)). '/Language/countries/'.$AppConfig->system_language.'.ini' );

			}
			
		}
		
		return isset( self::$langs[$code] ) ? self::$langs[$code] : $code;
		
	}
	
}
?>