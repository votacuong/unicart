<?php 
namespace App\Controllers;  


use App\Models\AdminOrderModel;
use App\Models\AdminItemModel;
use App\Models\AdminPaymentModel;
use App\Libraries\VLang;
  
class AdminOrderController extends BaseController
{
	
	public function index()
    {
		
        helper(['form', 'Common']);
		
		$AdminOrderModel = new AdminOrderModel();
		
		if ( $this->request->getVar('query') != '')
		{
			$data = [
				
				'subview' => 'order/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminOrderModel->selectAll( ['id'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby'))->paginate(15),
				
				'pager' => $AdminOrderModel->pager,
				
				'title'=>'Orders'
				
			];
		}
		else
		{
			$data = [
				
				'subview' => 'order/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminOrderModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby'))->paginate(15),
				
				'pager' => $AdminOrderModel->pager,
				
				'title'=>'Orders'
				
			];
		}
		
        echo view('back-end/main', $data);
		
    }
	public function orderdetailspdf($id)
	{
		
		helper(['form', 'Common']);
		
		$AdminOrderModel = new AdminOrderModel();
		
		$data = [
			
			'subview' => 'order/orderdetailspdf.php',
			
			'details' => $AdminOrderModel->getDetails($id),
			
			'id' => $id,
			
			'title'=>'Orders Details'
			
		];
		
        echo view('back-end/main', $data);
		
	}
    public function edit($id = 0)
    {
		
        helper(['form', 'Common']);
		
		$AdminOrderModel = new AdminOrderModel();
		
		if ( $id > 0 )
		{
			if ( $this->request->getVar('submit') )
			{
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'customer_id'=> $this->request->getVar('customer_id'),
					
					'time_add'=> $this->request->getVar('time_add')
					
				];
				
				if($this->validate($AdminOrderModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					$data['id'] = $id;
					
					$AdminOrderModel->store($data);
					
					$ndata = [
			
						'subview' => 'order/edit.php',
						
						'details' => $AdminOrderModel->get( $id ),
			
						'title'=>'Edit order'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}else{
					
					$object = $AdminOrderModel->get( $id );
					
					$ndata = [
			
						'subview' => 'order/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit order'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'order/edit.php',
					
					'details' => $AdminOrderModel->get( $id ),
			
					'title'=>'Edit order'
				
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
				
					'customer_id'=> $this->request->getVar('customer_id'),
					
					'time_add'=> $this->request->getVar('time_add')
					
				];
				
				if($this->validate($AdminOrderModel->validationRules))
				{
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminOrderModel->store($data);
					
					v_redirect('admin/order/edit/'.$insertID);
					
				}else{
					
					$ndata = [
			
						'subview' => 'order/edit.php',
						
						'details' => $AdminOrderModel->get( $id ),
			
						'title'=>'Edit order'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
			}
			else
			{
				
				$data = [
			
					'subview' => 'order/edit.php',
					
					'details' => $AdminOrderModel->getObject( ),
			
					'title'=>'Edit order'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
    }
	
	public function delete($id = 0)
	{
		
		$AdminOrderModel = new AdminOrderModel();
		
		$AdminOrderModel->deleteItem( $id );
		
		$AdminItemModel = new AdminItemModel();
		
		$AdminPaymentModel = new AdminPaymentModel();
		
		$AdminItemModel->deleteItemWhere(['order_id'=>$id]);
		
		$AdminPaymentModel->deleteItemWhere(['order_id'=>$id]);
			
		addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
		
		v_redirect('admin/orders');
		
	}
  
}