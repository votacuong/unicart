<?php 
namespace App\Controllers;  


class AdminDashboardController extends BaseController
{
	
	public function index()
    {
        helper(['form', 'Common']);
		
        $data = [
		
			'subview'=>'dashboard/index.php',
			
			'title'=>'Dashboard'
			
		];
		
        echo view('back-end/main', $data);
    }
}
?>