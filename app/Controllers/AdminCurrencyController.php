<?php 
namespace App\Controllers;  


use App\Models\AdminCurrencyModel;
use App\Libraries\VLang;
  
class AdminCurrencyController extends BaseController
{
	
	public function index()
    {

        helper(['form', 'Common']);
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		if ( $this->request->getVar('query') != '')
		{
			
			$data = [
				
				'subview' => 'currency/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminCurrencyModel->selectAll( ['code'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminCurrencyModel->pager,
				
				'title'=>'Currencies'
				
			];
			
		}
		else
		{
			
			$data = [
				
				'subview' => 'currency/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminCurrencyModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminCurrencyModel->pager,
				
				'title'=>'Currencies'
				
			];
		}
		
        echo view('back-end/main', $data);
		
    }
	
  
    public function edit($id = 0)
    {
		
        helper(['form', 'Common']);
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		if ( $id > 0 )
		{
			
			if ( $this->request->getVar('submit') )
			{
				
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'code'=> $this->request->getVar('code'),
					
					'symbol'=> $this->request->getVar('symbol'),
				
					'state'=> $this->request->getVar('state')
					
				];
				
				if($this->validate($AdminCurrencyModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					$data['id'] = $id;
					
					$AdminCurrencyModel->store($data);
					
					$ndata = [
			
						'subview' => 'currency/edit.php',
						
						'details' => $AdminCurrencyModel->get( $id ),
			
						'title'=>'Edit currency'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				else
				{
					
					$object = $AdminCurrencyModel->get( $id );
					
					$ndata = [
			
						'subview' => 'currency/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit currency'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'currency/edit.php',
					
					'details' => $AdminCurrencyModel->get( $id ),
			
					'title'=>'Edit currency'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
        else
		{
			
			if ( $this->request->getVar('submit') )
			{
				
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'code'=> $this->request->getVar('code'),
					
					'symbol'=> $this->request->getVar('symbol'),
				
					'state'=> $this->request->getVar('state')
					
				];
				
				if($this->validate($AdminCurrencyModel->validationRules))
				{
					
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminCurrencyModel->store($data);
					
					v_redirect('admin/currency/edit/'.$insertID);
					
				}
				else
				{
					
					$ndata = [
			
						'subview' => 'currency/edit.php',
						
						'details' => $AdminCurrencyModel->get( $id ),
			
						'title'=>'Edit currency'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'currency/edit.php',
					
					'details' => $AdminCurrencyModel->getObject( ),
			
					'title'=>'Edit currency'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
		
    }
	
	public function delete($id = 0)
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$AdminCurrencyModel->deleteItem( $id );
			
		addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
		
		v_redirect('admin/currencies');
		
	}
	
	public function state()
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$AdminCurrencyModel->updateField($this->request->getVar('id'), 'state', $this->request->getVar('state'));
		
		v_redirect('admin/currencies');
		
		
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
		else
		{
			
			addMessage('Please go to setting area to set the API Key!', 'warning');
			
			v_redirect('admin/currencies');
			
		}
		
		addMessage('Successfully!');
		
		v_redirect('admin/currencies');
		
		exit();
		
	}
	public function sync_exchanges()
	{
		
		$AdminCurrencyModel = new AdminCurrencyModel();
		
		$currencies    = $AdminCurrencyModel->select([]);
		
		$curl = [];
		
		if (is_array($currencies) && count($currencies) > 0)
		{
			
			$AppConfig = new \Config\AppConfig();
			
			if ($AppConfig->currency_apikey != '')
			{
				
				foreach($currencies as $item)
				{
					
					$curl[] = v_base_url('sync/'.$item['id']);
					
				}
				
				$this->multi_curl($curl);
				
			}
			else
			{
				
				addMessage('Please go to setting area to set the API Key!', 'warning');
				
				v_redirect('admin/currencies');
				
			}
			
		}
		
		addMessage('Successfully!');
		
		v_redirect('admin/currencies');
		
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

		do 
		{
			
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
  
}