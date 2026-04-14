<script type="text/javascript">
function deleteUser(userId)
{
	jQuery('<div class="dialog-delete"><?php echo VLang::__e('USER_LISTING_DELETE_DIALOG');?></div>').dialog({
	  buttons: { 
			OK: function() { 
			    window.location.href="<?php echo v_base_url('admin/order/delete/');?>"+userId;
			},
			Cancel: function(){
				$(this).dialog("close"); 
			}
		}
	});
}
</script>
<?php echo showMessages(); $AppConfig = new \Config\AppConfig();?>
<div class="col-12 grid-margin">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php VLang::__e('ORDER_LISTING');?></h4>
		<div class="table-responsive">		
		<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search search-form" action="<?php echo v_base_url('admin/orders');?>" method="get">
		<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('admin/order/edit');?>"><?php VLang::__e('ORDER_LISTING_ADDNEW');?></a>
		  <input type="text" class="form-control" name="query" placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" value="<?php echo $this->data['query'];?>">
		  <button type="submit" class="btn btn-primary mb-2 search-button"><?php VLang::__e('USER_LISTING_SUBMIT');?></button>
		</form>
		  <table class="table">
			<thead>
			  <tr>
				<th><?php VLang::__e('ORDER_LISTING_ORDER_ID');?> <?php if( orderby('id') == true){ echo '<a href="'.urlOrder('id', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('id', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('ORDER_LISTING_CUSTOMER_ID');?> <?php if( orderby('customer_id') == true){ echo '<a href="'.urlOrder('customer_id', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('customer_id', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('ORDER_LISTING_AMOUNT');?></th>
				<th><?php VLang::__e('ORDER_LISTING_TIMEADD');?> <?php if( orderby('time_add') == true){ echo '<a href="'.urlOrder('time_add', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('time_add', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('ORDER_LISTING_ORDERDETAILS');?></th>
				<th><?php VLang::__e('ORDER_LISTING_ACTION');?></th>
			  </tr>
			</thead>
			<tbody>
				<?php
				$user = new \App\Models\AdminUserModel();
				$payment = new \App\Models\AdminPaymentModel();
				?>
				<?php foreach($this->data['list'] as $key => $obj):?>
				<tr>
				<td>
					<a class="nav-link" href="<?php echo v_base_url('admin/order/edit/'.$obj['id']);?>"><?php echo $obj['id'];?></a>
				</td>
				<td>
				  <?php 
				  if ( session()->get('user_type') == 2 )
				  {
					  echo $obj['id'];
				  }else{
					  
					  $userdetails = $user->get($obj['customer_id']);
					  if ( isset($userdetails['id'])){
						  $customer_name = $userdetails['firstname'].' '.$userdetails['lastname'];
					  }else{
						  $customer_name = 'None';
					  }
					  ?>
					  <a class="nav-link" href="<?php echo v_base_url('admin/user/edit/'.$obj['customer_id']);?>"><?php echo $customer_name;?></a>
				  <?php } ?>
				</td>
				<td> <?php
					$pay = $payment->select(['order_id'=>$obj['id']]);
					if (is_array($pay) && count($pay) > 0){
						echo $pay[0]['total'].' '.$AppConfig->system_currency;
					}else{
						echo '0'.' '.$AppConfig->system_currency;
					}
					?> 
				</td>
				<td> <?php echo $obj['time_add'];?> </td>
				<td>
					<a class="nav-link" href="<?php echo v_base_url('admin/order/orderdetailspdf/'.$obj['id']);?>"><?php VLang::__e('ORDER_LISTING_ORDERDETAILS');?></a>
				</td>
				<td>
				  <div class="badge badge-outline-danger" onClick="javascript:deleteUser('<?php echo $obj['id'];?>');"><?php VLang::__e('ORDER_LISTING_DELETE');?></div>
				</td>
				</tr>
				<?php endforeach;?>
			  
			</tbody>
		  </table>
			<?= str_replace('index.php/', '', $this->data['pager']->links()); ?>
		</div>
	  </div>
	</div>
  </div>