<?php 
namespace App\Controllers;  


use App\Models\AdminProductModel;
use App\Libraries\VLang;
  
class AdminProductController extends BaseController
{
	
	public function index()
    {

        helper(['form', 'Common']);
		
		$AdminProductModel = new AdminProductModel();
		
		if ( $this->request->getVar('query') != '')
		{
			
			$data = [
				
				'subview' => 'product/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminProductModel->selectAll( ['name'=>$this->request->getVar('query')], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminProductModel->pager,
				
				'title'=>'Products'
				
			];
			
		}
		else
		{
			
			$data = [
				
				'subview' => 'product/index.php',
				
				'query'   => $this->request->getVar('query'),
				
				'list' => $AdminProductModel->selectAll( [], $this->request->getVar('order'), $this->request->getVar('orderby') )->paginate(15),
				
				'pager' => $AdminProductModel->pager,
				
				'title'=>'Products'
				
			];
			
		}
		
        echo view('back-end/main', $data);
		
    }
	
  
    public function edit($id = 0)
    {
		
        helper(['form', 'Common']);
		
		$AdminProductModel = new AdminProductModel();
		
		if ( $id > 0 )
		{
			
			if ( $this->request->getVar('submit') )
			{
				
				$data = [
					
					'id'       => $this->request->getVar('id'),
				
					'name'=> $this->request->getVar('name'),
					
					'description'=> $this->request->getVar('description'),
					
					'sku' => $this->request->getVar('sku'),
					
					'price'    => $this->request->getVar('price'),
					
					'address'    => $this->request->getVar('address'),
					
					'latitude'    => $this->request->getVar('latitude'),
					
					'longitude'    => $this->request->getVar('longitude'),
					
					'state'    => $this->request->getVar('state')
					
				];
				
				if($this->validate($AdminProductModel->validationRulesUpdate))
				{
					
					addMessage( VLang::__('MESSAGES_UPDATE_SUCCESSFULY') );
					
					uploadFile($id, 'photo', 'product');
					
					$data['id'] = $id;
					
					$AdminProductModel->store($data);
					
					$ndata = [
			
						'subview' => 'product/edit.php',
						
						'details' => $AdminProductModel->get( $id ),
			
						'title'=>'Edit product'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				else
				{
					
					$object = $AdminProductModel->get( $id );
					
					$ndata = [
			
						'subview' => 'product/edit.php',
						
						'details' => $object,
			
						'title'=>'Edit product'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
					
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'product/edit.php',
					
					'details' => $AdminProductModel->get( $id ),
			
					'title'=>'Edit product'
				
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
				
					'name'=> $this->request->getVar('name'),
					
					'description'=> $this->request->getVar('description'),
					
					'sku' => $this->request->getVar('sku'),
					
					'price'    => $this->request->getVar('price'),
					
					'address'    => $this->request->getVar('address'),
					
					'latitude'    => $this->request->getVar('latitude'),
					
					'longitude'    => $this->request->getVar('longitude'),
					
					'state'    => $this->request->getVar('state')
					
				];
				
				if($this->validate($AdminProductModel->validationRules))
				{
					
					addMessage( VLang::__('MESSAGES_SAVE_SUCCESSFULY') );
					
					$insertID = $AdminProductModel->store($data);
					
					uploadFile($insertID, 'photo', 'product');
					
					v_redirect('admin/product/edit/'.$insertID);
					
				}
				else
				{
					
					$ndata = [
			
						'subview' => 'product/edit.php',
						
						'details' => $AdminProductModel->get( $id ),
			
						'title'=>'Edit product'
					
					];
					
					$ndata['details'] = array_merge($ndata['details'], $data);
					
					echo view('back-end/main', $ndata);
				}
				
			}
			else
			{
				
				$data = [
			
					'subview' => 'product/edit.php',
					
					'details' => $AdminProductModel->getObject( ),
			
					'title'=>'Edit product'
				
				];
				
				echo view('back-end/main', $data);
				
			}
			
		}
		
    }
	
	public function delete($id = 0)
	{
		
		$AdminProductModel = new AdminProductModel();
		
		$AdminProductModel->deleteItem( $id );
			
		addMessage( VLang::__('MESSAGES_DELETE_SUCCESS') );
		
		v_redirect('admin/products');
		
	}
	
	public function state()
	{
		
		$AdminProductModel = new AdminProductModel();
		
		$AdminProductModel->updateField($this->request->getVar('id'), 'state', $this->request->getVar('state'));
		
		v_redirect('admin/products');
		
	}
	
	public function search()
	{
		
		header('Content-Type: text/html; charset=utf-8');
		
		$AdminProductModel = new AdminProductModel();
		
		$query = $this->request->getVar('query');
		
		die(json_encode($AdminProductModel->selectAll( ['name'=>$query], 'name', 'asc')->paginate(15)));
		
	}
  
}