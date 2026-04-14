<?php echo showMessages(); ?>
<div class="col-12 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title">
		<?php if ( $this->data['details']['id'] > 0 ):?>
		<?php VLang::__e('PAYMENT_EDIT'); echo $this->data['details']['id'];?>
		<?php else:?>
		<?php VLang::__e('PAYMENT_NEW');?>
		<?php endif;?>
		</h4>
		<?= \Config\Services::validation()->listErrors(); ?>
		<form class="forms-sample" method="post" action="<?php echo v_base_url('admin/payment/edit/'.$this->data['details']['id']);?>" enctype="multipart/form-data" >
			<div class="form-group">
			<label for="order_id"><?php VLang::__e('PAYMENT_ORDERID');?></label>
			<input type="text" class="form-control" id="order_id" placeholder="<?php VLang::__e('PAYMENT_ORDERID');?>" name="order_id" value="<?php echo $this->data['details']['order_id'];?>">
		  </div>
		  <div class="form-group">
			<label for="name"><?php VLang::__e('PAYMENT_CUSTOMER');?></label>
			<?php
			$user = new \App\Models\AdminUserModel();
			$customers = $user->select(['user_type'=>3]);
			?>
			<select name="customer_id" class="form-control" >
			<?php foreach($customers as $customer):?>
			<?php if ( $customer['id'] == $this->data['details']['customer_id'] ):?>
			<option value="<?php echo $customer['id'];?>" selected="selected"><?php echo $customer['firstname'].' '.$customer['lastname'];?></option>
			<?php else:?>
			<option value="<?php echo $customer['id'];?>"><?php echo $customer['firstname'].' '.$customer['lastname'];?></option>
			<?php endif;?>
			<?php endforeach;?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="time_add"><?php VLang::__e('PAYMENT_TIME');?></label>
			<input type="text" class="form-control" id="time_add" placeholder="<?php VLang::__e('PAYMENT_TIME');?>" name="time_add" value="<?php echo $this->data['details']['time_add'];?>">
		  </div>
		  <div class="form-group">
			<label for="total"><?php VLang::__e('PAYMENT_TOTAL');?></label>
			<input type="text" class="form-control" id="total" placeholder="<?php VLang::__e('PAYMENT_TOTAL');?>" name="total" value="<?php echo $this->data['details']['total'];?>">
		  </div>
		  <div class="form-group">
			<label for="status"><?php VLang::__e('PAYMENT_STATUS');?></label>
			<select class="form-control" id="status" name="status">
			  <option value="not-complete" <?php if ($this->data['details']['status'] == 'not-complete'){ echo 'selected="selected"';}?>><?php VLang::__e('PAYMENT_STATUS_NOTCOMPLETED');?></option>
			  <option value="completed" <?php if ($this->data['details']['status'] == 'completed'){ echo 'selected="selected"';}?>><?php VLang::__e('PAYMENT_STATUS_COMPLETED');?></option>
			</select>
		  </div>
		  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('USER_EDITUSER_SUBMIT');?>" />
		  <a class="btn btn-dark" href="<?php echo v_base_url('admin/payments');?>"><?php VLang::__e('USER_EDITUSER_CANCEL');?></a>
		</form>
	  </div>
	</div>
  </div>
<script type="text/javascript">
jQuery(document).ready(function(){
			
	$( "#time_add" ).datepicker({
		'dateFormat':'yy-mm-dd'
	});
});
</script>