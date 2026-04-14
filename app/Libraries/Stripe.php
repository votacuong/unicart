<?php
namespace App\Libraries;  

class Stripe{
	 /**
     * Payment intent id holder
     *
     * @var string
     */
    protected $intent_id = '';
    /**
     * Client secret holder
     *
     * @var string
     */
    protected $client_secret = '';
	/**
     * secret_key
     *
     * @var string
     */
    protected $secret_key = '';
	
	public function __construct(){
		
		$this->id           = 'stripe-connect';
		
		$AppConfig          = new \Config\AppConfig();
		
		if ($AppConfig->stripe_mode == 'test')
		{
			
			$this->secret_key   = $AppConfig->stripesecretkey_test;
			
		}
		else
		{
			
			$this->secret_key   = $AppConfig->stripesecretkey_live;
			
		}
		
		$this->api_endpoint = 'https://api.stripe.com/';
		
		$this->icon         = '';
		
	}
	
	public static function getInstance()
	{
		static $_instance = null;
		
		if (!$_instance)
		{
			
			$_instance = new self();
			
		}
		
		return $_instance;
		
	}
	
	public function create_payment_intent($intent_value, $currency)
	{
		
		if ($intent_value < 1)
		{
			
			$intent_value = 1;
			
		}
		
		$intent_value = $intent_value * 100;
		
		$this->setJavascriptVariables($intent_value, $currency);
		
	}
	
	public function cancel_subscription($subscription_id)
	{
		
		require FCPATH . '../public/stripe/lib/init.php';
		
		\Stripe\Stripe::setApiKey($this->secret_key);
		
		\Stripe\Subscription::update(
		
		   $subscription_id,
		   [
			  'cancel_at_period_end' => true
		   ]
		   
		);
		
	}
	
	public function charge_subscription($price, $transaction_id)
	{
		
		require FCPATH . '../public/stripe/lib/init.php';
		
		\Stripe\Stripe::setApiKey($this->secret_key);
		
		try
		{
			
			$customer = \Stripe\Customer::create([
			
				'name' => session()->get('name'),
				
				'email' => session()->get('email'),
				
				'source'  => $transaction_id['id']
				
			]);
			
			\Stripe\Charge::create ([
			
				"customer" => $customer->id,
				
				"amount" => floatval(round($price, 2)) * 100,
				
				"currency" => strtolower(get_activities_session()['currency']),
				
				"description" => session()->get('name').' order' , 
				
			]);
			
		}
		catch(Exception $err)
		{
			
			echo VLang::__('PAYMENT_FAIL_MESSAGE');
			
			return false;
		}
		
		return true;
		
	}
	
	public function setJavascriptVariables($intent_value, $currency)
	{
		
		$AppConfig = new \Config\AppConfig();
		
		if ($AppConfig->stripe_mode == 'test')
		{
			
			$stripepublickey   = $AppConfig->stripepublickey_test;
			
		}
		else
		{
			
			$stripepublickey   = $AppConfig->stripepublickey_live;
			
		}
		
		echo "
		    var __baseURL = '".v_base_url('')."';
			var AMStripe = {};
			AMStripe.options = {
				publicKey         : '',
				stripe_amount     : '',
				stripe_currency   : '',
				order_id          : '',
				result_token      : ''
			};
			AMStripe.options.name       = 'order';
			AMStripe.options.publicKey       = '".$stripepublickey."';
			AMStripe.options.stripe_amount   = ".$intent_value.";
			AMStripe.options.stripe_currency = '".strtolower($currency)."';
			AMStripe.options.customer_email  = '".session()->get('email')."';
			AMStripe.options.description  = '".VLang::__('STRIPE_DESCRIPTION')."';
		";
		
	}
	
}