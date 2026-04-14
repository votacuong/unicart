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
use App\Libraries\VLang;
  
class AdminUserController extends BaseController
{
	
	public function index()
    {

        helper(['form', 'Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $this->request->getVar('query') != '')
		{
				
			$list = $AdminUserModel->selectAll( ['firstname'=>$this->request->getVar('query'), 'lastname'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15);
				
			$data = [
				
				'subview' => 'user/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $list,
				
				'pager' => $AdminUserModel->pager,
				
				'title'=>'Users'
				
			];
			
		}
		else
		{
			$list = $AdminUserModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15);
				
			$data = [
				
				'subview' => 'user/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $list,
				
				'pager' => $AdminUserModel->pager,
				
				'title'=>'Users'
				
			];
		}
		
        echo view('back-end/main', $data);
		
    }
	
    public function signup()
    {
		
        helper(['form', 'Common']);
		
        $data = [];
		
        echo view('back-end/login/signup', $data);
		
    }
	
	public function doLogin()
	{
		
		helper(['Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		$username = $this->request->getVar('username');
		
		$password = $this->request->getVar('password');
		
		if ( $username != '' && $password != '' )
		{
			
			if ( $AdminUserModel->loginAuth($username, $password) )
			{
				
				v_redirect('admin/dashboard');
				
			}
			
		}
		
		addMessage( VLang::__('MESSAGES_LOGIN_WRONG'), 'warning' );
		
		v_redirect('admin/user/signup');
		
	}
  
    public function edit($id = 0)
    {
		
        helper(['form', 'Common']);
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $id > 0 )
		{
			
			if ( $this->request->getVar('submit') )
			{
				
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'user_type'=> $this->request->getVar('user_type'),
					
					'firstname'=> $this->request->getVar('firstname'),
					
					'lastname' => $this->request->getVar('lastname'),
					
					'phone'    => '+'.$this->request->getVar('countryCode').$this->request->getVar('phone'),
					
					'email'    => $this->request->getVar('email'),
					
					'state'    => $this->request->getVar('state'),
					
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
					
				];
				
				if($this->validate($AdminUserModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					$object = $AdminUserModel->get( $id );
					
					$data['email'] = $object['email'];
					
					$data['id'] = $object['id'];
					
					if ($_FILES['photo']["tmp_name"] != '')
					{
						
						if ( is_file(FCPATH . '../public/images/users/'.$data['id'].'.png') )
						{
							
							unlink(FCPATH . '../public/images/users/'.$data['id'].'.png');
							
						}
						
						if ( is_file(FCPATH . '../public/images/users/'.$data['id'].'.jpg') )
						{
							
							unlink(FCPATH . '../public/images/users/'.$data['id'].'.jpg');
							
						}
						
						if ( is_file(FCPATH . '../public/images/users/'.$data['id'].'.jpeg') )
						{
							
							unlink(FCPATH . '../public/images/users/'.$data['id'].'.jpeg');
							
						}
						
					}
					
					uploadFile($id, 'photo', 'users');
					
					$AdminUserModel->store($data);
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $AdminUserModel->get( $id ),
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				else
				{
					
					$object = $AdminUserModel->get( $id );
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					$ndata['details']['email'] = $object['email'];
					
					$ndata['details']['id'] = $object['id'];
					
					echo view('back-end/main', $ndata);
					
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'user/edit.php',
					
					'details' => $AdminUserModel->get( $id ),
			
					'title'=>'Edit user'
				
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
				
					'user_type'=> $this->request->getVar('user_type'),
					
					'firstname'=> $this->request->getVar('firstname'),
					
					'lastname' => $this->request->getVar('lastname'),
					
					'phone'    => $this->request->getVar('phone'),
					
					'email'    => $this->request->getVar('email'),
					
					'state'    => $this->request->getVar('state'),
					
					'signup_date' => date("Y-m-d"),
					
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
					
				];
				
				if($this->validate($AdminUserModel->validationRules))
				{
					
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminUserModel->store($data);
					
					uploadFile($insertID, 'photo', 'users');
					
					v_redirect('admin/user/edit/'.$insertID);
					
				}
				else
				{
					
					$ndata = [
			
						'subview' => 'user/edit.php',
						
						'details' => $AdminUserModel->get( $id ),
			
						'title'=>'Edit user'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'user/edit.php',
					
					'details' => $AdminUserModel->getObject( ),
			
					'title'=>'Edit user'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
    }
	
	public function delete($id = 0)
	{
		
		$AdminUserModel = new AdminUserModel();
		
		if ( $id == 1 )
		{
			
			addMessage( VLang::__('MESSAGES_DONT_HAVE_PERMISSION'), 'danger' );
			
		}
		else if( $id > 0 )
		{			
		
			$AdminPaymentModel = new AdminPaymentModel(); 
			
			$AdminOrderModel = new AdminOrderModel();
			
			$AdminPaymentModel->deleteItemWhere( [ 'customer_id' => $id ]);
			
			$AdminOrderModel->deleteItemWhere( [ 'customer_id' => $id ]);
			
			$AdminUserModel->deleteItem( $id );
			
			addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
			
		}		
		
		v_redirect('admin/users');
		
	}
	
	public function state()
	{
		
		$AdminUserModel = new AdminUserModel();
		
		$AdminUserModel->updateField($this->request->getVar('id'), 'state', $this->request->getVar('state'));
		
		v_redirect('admin/users');
		
	}
	
	public function search()
	{
		
		header('Content-Type: text/html; charset=utf-8');
		
		$AdminUserModel = new AdminUserModel();
		
		$query = $this->request->getVar('query');
		
		die(json_encode($AdminUserModel->selectAll( $query, 'firstname', 'asc')->paginate(15)));
		
	}
	
	public function logout()
	{
		
		session()->destroy();
		
		v_redirect('admin/dashboard');
		
	}
  
}