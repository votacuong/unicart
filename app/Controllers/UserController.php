<?php 
namespace App\Controllers;  


use App\Models\UserModel;
use App\Models\AdminUserModel;
use App\Models\CartModel;
use App\Models\AdminOrderModel;
use App\Models\AdminPaymentModel;
use App\Models\StripeModel;
use App\Models\AdminProductModel;
use App\Models\ResetpasswordModel;
use App\Models\StoreModel;
use App\Libraries\VLang;
  
class UserController extends BaseController
{
	
	public function lostpassword()
    {
		
		helper(['Common']);
		
		$UserModel = new UserModel(); 
		
		$ResetpasswordModel = new ResetpasswordModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
		$message = '';
		
		$class = '';
		
		if ( $this->request->getVar('submit') )
		{
			
			$code = generateRandomString();
			
			$state = $UserModel->lostpassword($this->request->getVar('email') );
			
			if ($state)
			{
				
				$ResetpasswordModel->lostpassword($this->request->getVar('email'), $code);
				
				$data = [];
				
				$object = $UserModel->getObjectByEmail($this->request->getVar('email'));
				
				$data['username'] = $object['firstname'].' '.$object['lastname'];
				
				$data['password'] = '<a href="'.v_base_url('user/resetpassword?code='.$code).'" target="_blank">'.VLang::__('CLICK_HERE_TO_RESET').'</a>';
				
				$data['receiver'] = $this->request->getVar('email');
				
				ob_start();
				
				include(FCPATH . '../app/Views/front-end/mails/reset-password.php');
				
				$message = ob_get_clean();
				
				$Mailer = new \App\Libraries\Mailer();
				
				$Mailer->sendMail($this->request->getVar('email'), 'Reset Your Password', $message );
				
				$message = VLang::__('LOSTPASSWORD_SENT');
				
				$class = '';
				
			}
			else
			{
				
				$message = VLang::__('LOSTPASSWORD_DOES_NOT_EXIST');
				
				$class = 'lostpassword-message-error';
				
			}
		
		}
		
        helper(['form', 'Common']);
		
        $data = ['title'=>'Lost password', 'message'=>$message, 'class'=>$class];
		
        echo view('front-end/login/lostpassword', $data);
		
    }
		
    public function login()
    {
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
        helper(['form', 'Common']);
		
        $data = ['system_title'=>'Login'];
		
        echo view('front-end/login/login', $data);
		
    }
	
	public function resetpassword()
    {
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
        helper(['form', 'Common']);
		
		if ( $this->request->getVar('submit') )
		{
			
			$ResetpasswordModel = new ResetpasswordModel(); 
			
			$reset = $ResetpasswordModel->select(['code'=>$this->request->getVar('code')]);
			
			if ( count($reset) > 0)
			{
				
				$UserModel->resetpassword($reset[0]['email'], $this->request->getVar('password'));
				
				$ResetpasswordModel->deleteItemWhere(['email'=>$reset[0]['email']]);
				
				v_redirect('user/login');
				
			}
			
		}
		
        $data = [
		
			'details' => $UserModel->getObject(),
			
			'system_title'=>'Reset password'
			
		];
		
        echo view('front-end/login/resetpassword', $data);
		
    }
	
	public function signup()
    {
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
        helper(['form', 'Common']);
		
        $data = [
		
			'details' => $UserModel->getObject(),
			
			'system_title'=>'Signup'
			
		];
		
        echo view('front-end/login/signup', $data);
		
    }
	public function doLogin()
	{
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
		helper(['Common']);
		
		$username = $this->request->getVar('username');
		
		$password = $this->request->getVar('password');
		
		if ( $username != '' && $password != '' )
		{
			
			if ( $UserModel->loginAuth($username, $password) ){
				
				if (!empty($this->request->getVar('return_url')))
				{
					
					header("Location: ".base64_decode($this->request->getVar('return_url')));
		
					exit;
		
				}
				else
				{
				
					v_redirect('');
					
				}
				
			}
			
		}
		
		v_redirect('user/login');
		
	}
  
    public function store($id = 0)
    {
		
		$UserModel = new UserModel(); 
		
		if ( $UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
        helper(['form', 'Common']);
		
		if ( $this->request->getVar('submit') )
		{
			
			$data = [
				
				'id'       => $this->request->getVar('id'),
			
				'user_type'=> $this->request->getVar('user_type'),
				
				'firstname'=> $this->request->getVar('firstname'),
				
				'lastname' => $this->request->getVar('lastname'),
				
				'phone'    => '+'.$this->request->getVar('countryCode').$this->request->getVar('phone'),
				
				'email'    => $this->request->getVar('email'),
				
				'signup_date' => date("Y-m-d"),
				
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
				
				'state'=> 1
				
			];
			
			if($this->validate($UserModel->validationRules))
			{
				
				if ($data['user_type'] == 1)
				{
					
					$data['user_type'] = 2;
					
				}
				
				if ($data['user_type'] != 2 && $data['user_type'] != 3)
				{
					
					$data['user_type'] = 3;
					
				}
				
				$insertID = $UserModel->store($data);
				
				v_redirect('user/login');
				
			}
			else
			{
				
				$ndata = [
					
					'details' => $data,
					
					'title'=>'Edit setting'
				
				];
				
				echo view('front-end/login/signup', $ndata);
			}
			
		}
		else
		{
			
			$this->signup();			
			
		}
		
    }
	
	public function edit()
    {
		
        helper(['form', 'Common']);
		
		$UserModel = new UserModel(); 
		
		if ( !$UserModel->isLogin( ) )
		{
			
			v_redirect('');
			
		}
		
		$UserModel = new UserModel();
		
		if ( $this->request->getVar('submit') )
		{
			
			$data = [
				
				'id'       => session()->get('id'),
				
				'firstname'=> $this->request->getVar('firstname'),
				
				'lastname' => $this->request->getVar('lastname'),
				
				'phone'    => '+'.$this->request->getVar('countryCode').$this->request->getVar('phone'),
				
				'email'    => $this->request->getVar('email'),
				
				'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
				
			];
			
			if($this->validate($UserModel->validationRulesUpdate))
			{
				
				addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
				
				$object = $UserModel->get( session()->get('id') );
				
				$data['email'] = $object['email'];
				
				$data['id'] = $object['id'];				
				
				$UserModel->store($data);
				
				if ($_REQUEST["imagePath"] != '')
				{
					
					$imagePath = decode_string($_REQUEST["imagePath"]);
					
					$file = explode('/', $imagePath);
					
					$file = $file[count($file)-1];
					
					if ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.png') )
					{
						
						unlink(FCPATH . '../public/images/users/'.session()->get('id').'.png');
						
					}
					
					if ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpg') )
					{
						
						unlink(FCPATH . '../public/images/users/'.session()->get('id').'.jpg');
						
					}
					
					if ( is_file(FCPATH . '../public/images/users/'.session()->get('id').'.jpeg') )
					{
						
						unlink(FCPATH . '../public/images/users/'.session()->get('id').'.jpeg');
						
					}
					
					copy($imagePath, FCPATH . '../public/images/users/'.$file);
					
				}
				
				$ndata = [
		
					'subview' => 'user/edit.php',
					
					'details' => $UserModel->get( session()->get('id') ),
					
					'title'=>'Edit user'
				
				];
				
				$ndata['details'] = array_merge($ndata['details'], $data);
				
				echo view('front-end/main', $ndata);
				
			}
			else
			{
				
				$object = $UserModel->get( session()->get('id') );
				
				$ndata = [
		
					'subview' => 'user/edit.php',
					
					'details' => $object,
					
					'title'=>'Edit user'
				
				];
				
				$ndata['details'] = array_merge($ndata['details'], $data);
				
				$ndata['details']['email'] = $object['email'];
				
				$ndata['details']['id'] = $object['id'];
				
				echo view('front-end/main', $ndata);
				
			}
		}
		else
		{
			
			$data = [
		
				'subview' => 'user/edit.php',
				
				'details' => $UserModel->get( session()->get('id') ),
				
				'title'=>'Edit user'
			
			];
			
			echo view('front-end/main', $data);
			
		}
		
    }
	
	public function uploadimage()
	{
		
		if ( is_file(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.png') )
		{
			
			unlink(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.png');
			
		}
		
		if ( is_file(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.jpg') )
		{
			
			unlink(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.jpg');
			
		}
		
		if ( is_file(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.jpeg') )
		{
			
			unlink(dirname(dirname(dirname(__FILE__))).'/public/images/tmp/user/'.session()->get('id').'.jpeg');
			
		}

		uploadFile(session()->get('id'), 'photo', 'tmp/user');
		
		if ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.png') )
		{
			
			$link = dirname(dirname(dirname(__FILE__))) . '/public/images/tmp/user/'.session()->get('id').'.png';
			
		}
		
		if ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.jpg') )
		{
			
			$link = dirname(dirname(dirname(__FILE__))) . '/public/images/tmp/user/'.session()->get('id').'.jpg';
			
		}
		
		if ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.jpeg') )
		{
			
			$link = dirname(dirname(dirname(__FILE__))) . '/public/images/tmp/user/'.session()->get('id').'.jpeg';
			
		}
		
		if ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.png') )
		{
			
			$user = v_base_url('public/images/tmp/user/'.session()->get('id').'.png?time='.date("Y-m-d H:i:s"));
			
		}
		elseif ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.jpg') )
		{
			
			$user = v_base_url('public/images/tmp/user/'.session()->get('id').'.jpg?time='.date("Y-m-d H:i:s"));
			
		}
		elseif ( is_file(FCPATH . '../public/images/tmp/user/'.session()->get('id').'.jpeg') )
		{
			
			$user = v_base_url('public/images/tmp/user/'.session()->get('id').'.jpeg?time='.date("Y-m-d H:i:s"));
			
		}
		else
		{
			
			$user = v_base_url('public/images/default.jpg');
			
		}
		
		echo json_encode([
		
			'user'=>$user,
			
			'link'=>encode_string($link)
			
		]);
		
		die();
		
	}
	
	public function logout()
	{
		
		session()->destroy();
		
		v_redirect('');
		
	}
}