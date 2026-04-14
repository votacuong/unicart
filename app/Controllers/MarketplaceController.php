<?php

namespace App\Controllers;
use App\Models\AdminCurrencyModel;
use App\Models\AdminProductModel;
use App\Models\UserModel;
use App\Libraries\VLang;

class MarketplaceController extends BaseController
{
    public function index(): string
    {
		
		$data = [];
		
		$data = [
		
		    'subview'=>'market-place/index.php',
			
			'title'=>'Market place'
			
		];
		
        return view('front-end/main', $data);
		
    }
	public function filter()
	{
		
		$latitude = $this->request->getVar('latitude');
		
		$longitude = $this->request->getVar('longitude');
		
		if (empty($latitude) || empty($longitude))
		{
			
			die('<div class="no-found-products">'.VLang::__('NO_FOUD_PRODUCTS').'</div>');
			
		}
		
		$Currency = new \App\Libraries\Currency();
		
		$AdminProductModel = new AdminProductModel();
		
		$products = $AdminProductModel->selectAll([])->paginate(1000);	

		$slider_min = $this->request->getVar('slider_min');
		
		$slider_max = $this->request->getVar('slider_max');
		
		$slider_price_min = $this->request->getVar('slider_price_min');
		
		$slider_price_max = $this->request->getVar('slider_price_max');
		
		$found = 0;
		
		foreach($products as $p)
		{
			
			if ( $p['latitude'] != '' && $p['longitude'] != '' )
			{
				$distance = $this->GetDrivingDistance($latitude, $p['latitude'], $longitude, $p['longitude']);
				
				$val['distance'] = (float)$distance['distance'];
				
				if ($val['distance'] > 0 && $val['distance'] >= $slider_min && $val['distance'] <= $slider_max && $p['price'] >= $slider_price_min && $p['price'] <= $slider_price_max)
				{
					
					$found++;
					
					?>
					<div class="col mb-5">
					<div class="card h-100">		
						<?php 
						if ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.gif') ):?>
							<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.gif?time='.date("Y-m-d"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.png') ):?>
							<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.png?time='.date("Y-m-d H:i:s"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.$p['id'].'.jpg') ):?>
							<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.jpg?time='.date("Y-m-d H:i:s"));?>" />
						<?php elseif ( is_file(FCPATH . '../public/images/product/'.session()->get('id').'.jpeg') ):?>
							<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$p['id'].'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
						<?php else:?>
							<img class="card-img-top" src="<?php echo v_base_url('public/images/default.jpg');?>" />
						<?php endif;
						?>
						<div class="card-body p-4">
							<div class="text-center">
								<!-- Product name-->
								<h5 class="fw-bolder inforproduct-title"><a class="cart-edit-link" href="<?php echo v_base_url('product/details/'.$p['id']);?>"><?php echo $p['name'];?></a></h5>
								
								<div class="product-price-form">
									<h5 class="fw-bolder inforproduct-price" id="product-<?php echo $p['id'];?>" data-value="<?php echo $p['price'];?>"><?php echo get_activities_session()['symbol'];?> <?php echo round(((float)$p['price'])*$Currency->__getExchange(get_activities_session()['currency']), 1);?></h5>
								</div>
								<p class="inforproduct-description"><?php echo $p['description'];?></p>
							</div>
						</div>
						<!-- Product actions-->
						<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
							<div class="text-center">
								<a class="btn btn-outline-dark mt-auto inforproduct-send" href="javascript:void(0);" onClick="addToCart(<?php echo $p['id'];?>);"><?php VLang::__e('INFORMATION_PRODUCT_SEND');?></a>
							</div>
						</div>
					</div>
				</div>
					<?php
				}
			}
		}
		if ($found == 0)
		{
			
			die('<div class="no-found-products">'.VLang::__('NO_FOUD_PRODUCTS').'</div>');
			
		}
		die();
	}
	
	public function GetDrivingDistance($lat1, $lat2, $long1, $long2)
	{
		
		$AppConfig = new \Config\AppConfig();
		
		$googleMapApi = $AppConfig->google_api_key;
		
		$googleMapApi = $googleMapApi ? "key=" . $googleMapApi . "&" : "";
		
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=en-EN&".$googleMapApi."";
		
		//$response = file_get_contents($url);
		
		$response = $this->curlget($url);
		
		$response_a = json_decode($response, true);
		
		if(isset($response_a['rows'][0]['elements'][0]['distance']['text']))
		{
			
			$dist = (float) trim(str_replace(Array('km', ','), Array('', ''), $response_a['rows'][0]['elements'][0]['distance']['text']));
			
			$time = $response_a['rows'][0]['elements'][0]['duration']['text'];
			
		}
		else
		{
			
			$dist = null;
			
			$time = null;
			
		}
		
		$return_data = array('distance' => $dist, 'time' => $time);
		
		return $return_data;
		
	}
	
	function curlget($url)
	{
		$user_agent = 'Mozilla HotFox 1.0';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		$res = curl_exec($ch);
		curl_close($ch);
		
		return $res;
	}
}
