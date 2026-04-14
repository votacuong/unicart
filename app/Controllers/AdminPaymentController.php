<?php 
namespace App\Controllers;  


use App\Models\AdminPaymentModel;
use App\Libraries\VLang;
  
class AdminPaymentController extends BaseController
{
	
	public function index()
    {
		
        helper(['form', 'Common']);
		
		$AdminPaymentModel = new AdminPaymentModel();
		
		if ( $this->request->getVar('query') != '')
		{
			$data = [
				
				'subview' => 'payment/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminPaymentModel->selectAll( ['order_id'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminPaymentModel->pager,
				
				'title'=>'Payments'
				
			];
		}
		else
		{
			$data = [
				
				'subview' => 'payment/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminPaymentModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminPaymentModel->pager,
				
				'title'=>'Payments'
				
			];
		}
		
        echo view('back-end/main', $data);
		
    }
	
  
    public function edit($id = 0)
    {
		
        helper(['form', 'Common']);
		
		$AdminPaymentModel = new AdminPaymentModel();
		
		if ( $id > 0 )
		{
			if ( $this->request->getVar('submit') )
			{
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'order_id'=> $this->request->getVar('order_id'),
					
					'customer_id'=> $this->request->getVar('customer_id'),
				
					'total'=> $this->request->getVar('total'),
					
					'time_add'=> $this->request->getVar('time_add'),
					
					'status'=> $this->request->getVar('status')
					
				];
				
				if($this->validate($AdminPaymentModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					$data['id'] = $id;
					
					$AdminPaymentModel->store($data);
					
					$ndata = [
			
						'subview' => 'payment/edit.php',
						
						'details' => $AdminPaymentModel->get( $id ),
			
						'title'=>'Edit payment'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}else{
					
					$object = $AdminPaymentModel->get( $id );
					
					$ndata = [
			
						'subview' => 'payment/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit payment'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'payment/edit.php',
					
					'details' => $AdminPaymentModel->get( $id ),
			
					'title'=>'Edit payment'
				
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
				
					'order_id'=> $this->request->getVar('order_id'),
					
					'customer_id'=> $this->request->getVar('customer_id'),
				
					'total'=> $this->request->getVar('total'),
					
					'time_add'=> $this->request->getVar('time_add'),
					
					'status'=> $this->request->getVar('status')
					
				];
				
				if($this->validate($AdminPaymentModel->validationRules))
				{
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminPaymentModel->store($data);
					
					v_redirect('admin/payment/edit/'.$insertID);
					
				}else{
					
					$ndata = [
			
						'subview' => 'payment/edit.php',
						
						'details' => $AdminPaymentModel->get( $id ),
			
						'title'=>'Edit payment'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'payment/edit.php',
					
					'details' => $AdminPaymentModel->getObject( ),
			
					'title'=>'Edit payment'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
    }
	
	public function delete($id = 0)
	{
		
		$AdminPaymentModel = new AdminPaymentModel();
		
		$AdminPaymentModel->deleteItem( $id );
			
		addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
		
		v_redirect('admin/payments');
		
	}
  
}