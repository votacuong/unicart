<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

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
				
				self::$langs = parse_ini_file( dirname(__FILE__). '/Language/countries/'.$language.'.ini' );
				
			}
			else
			{		
		
				$AppConfig = new \Config\AppConfig();
				
				self::$langs = parse_ini_file( dirname(__FILE__). '/Language/countries/'.$AppConfig->system_language.'.ini' );

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
				
				self::$langs = parse_ini_file( dirname(__FILE__). '/Language/countries/'.$language.'.ini' );
				
			}
			else
			{			
		
				$AppConfig = new \Config\AppConfig();
				
				self::$langs = parse_ini_file( dirname(__FILE__). '/Language/countries/'.$AppConfig->system_language.'.ini' );

			}
			
		}
		
		return isset( self::$langs[$code] ) ? self::$langs[$code] : $code;
		
	}
	
}