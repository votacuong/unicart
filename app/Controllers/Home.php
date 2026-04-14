<?php

namespace App\Controllers;
use App\Models\AdminCurrencyModel;
use App\Models\UserModel;
use App\Libraries\VLang;

class Home extends BaseController
{
    public function index(): string
    {
		
		$data = [];
		
		$data = [
		
		    'subview'=>'home/home.php',
			
			'title'=>'Home',
			
			'video'=>'yes'
			
		];
		
        return view('front-end/main', $data);
		
    }
	
	public function currencysync()
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currencies    = $AdminCurrencyModel->select(['date_sync'=>date("Y-m-d")]);
		
		$curl = [];
		
		if (is_array($currencies) && count($currencies) == 0)
		{
			
			$currencies    = $AdminCurrencyModel->select([]);
			
			$AppConfig = new \Config\AppConfig();
			
			if ($AppConfig->currency_apikey != '')
			{
				
				foreach($currencies as $item)
				{
					
					$curl[] = v_base_url('sync_auto/'.$item['id']);
					
				}
				
				$this->multi_curl($curl);
				
			}
			
		}
		
		exit();
		
	}
	
	public function multi_curl($url)
	{

		$mh = curl_multi_init();
		
		foreach($url as $key => $value)
		{
			
		  $ch[$key] = curl_init($value);
		  
		  curl_setopt($ch[$key], CURLOPT_URL, $value);
		  
		  curl_setopt($ch[$key], CURLOPT_HEADER, 0);		  
		  
		  curl_multi_add_handle($mh,$ch[$key]);
		  
		}

		do {
			
		  curl_multi_exec($mh, $running);
		  
		  curl_multi_select($mh);
		  
		} while ($running > 0);

		foreach(array_keys($ch) as $key)
		{
			
		  echo curl_getinfo($ch[$key], CURLINFO_HTTP_CODE);
		  
		  echo curl_getinfo($ch[$key], CURLINFO_EFFECTIVE_URL);
		  
		  echo "\n";
		  
		  curl_multi_remove_handle($mh, $ch[$key]);
		  
		}

		curl_multi_close($mh);
		
	}
	
	public function sync_auto($id)
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currencies = [$AdminCurrencyModel->get($id)];
		
		$AppConfig = new \Config\AppConfig();
		
		if ($AppConfig->currency_apikey != '')
		{
			
			foreach($currencies as $item)
			{
				
				$req_url = 'https://v6.exchangerate-api.com/v6/'.$AppConfig->currency_apikey.'/latest/'.strtoupper($item['code']);	
				
				$response_json = file_get_contents($req_url);
				
				if(false !== $response_json)
				{
					
					try {
						
						$response = json_decode($response_json);
						
						if('success' === $response->result)
						{
							
							$exchange = (array) abb_json_decode($item['exchange']);
							
							$exchanges    = $AdminCurrencyModel->select([]);
							
							foreach($exchanges as $item1)
							{
								
								if (isset($response->conversion_rates->{$item1['code']}))
								{
									
									$exchange[$item1['code']] = $response->conversion_rates->{$item1['code']};
									
								}
								
							}
							
							$AdminCurrencyModel->updateField($item['id'], "exchange",  abb_raw_json_encode($exchange));
							
							$AdminCurrencyModel->updateField($item['id'], "date_sync",  date("Y-m-d"));
							
						}
						
					}
					catch(Exception $e) {}
					
				}
				
			}
			
		}
		
		exit();
		
	}
	
	public function sync($id)
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currencies = [$AdminCurrencyModel->get($id)];
		
		$AppConfig = new \Config\AppConfig();
		
		if ($AppConfig->currency_apikey != '')
		{
			
			foreach($currencies as $item)
			{
				
				$req_url = 'https://v6.exchangerate-api.com/v6/'.$AppConfig->currency_apikey.'/latest/'.strtoupper($item['code']);	
				
				$response_json = file_get_contents($req_url);
				
				if(false !== $response_json)
				{
					
					try {
						
						$response = json_decode($response_json);
						
						if('success' === $response->result)
						{
							
							$exchange = (array) abb_json_decode($item['exchange']);
							
							$exchanges    = $AdminCurrencyModel->select([]);
							
							foreach($exchanges as $item1)
							{
								
								if (isset($response->conversion_rates->{$item1['code']}))
								{
									
									$exchange[$item1['code']] = $response->conversion_rates->{$item1['code']};
									
								}
								
							}
							
							$AdminCurrencyModel->updateField($item['id'], "exchange",  abb_raw_json_encode($exchange));
							
							$AdminCurrencyModel->updateField($item['id'], "date_sync",  date("Y-m-d"));
							
						}
						
					}
					catch(Exception $e) {}
					
				}
				
			}
			
		}
		
		exit();
		
	}
	
}
