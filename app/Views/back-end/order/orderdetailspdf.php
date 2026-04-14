<script src="<?php echo v_base_url('public/front-end/js/html2pdf.bundle.js');?>"></script>
<script src="<?php echo v_base_url('public/front-end/js/generatePDF-backend.js?time='.time());?>"></script>
<?php
$Currency = new \App\Libraries\Currency();
$AppConfig = new \Config\AppConfig();
?>
<div class="col-12 grid-margin">
<div class="card">
	<div class="card-body order-detail" style="background:#191c24;">
		<div class="container order-logo">
			<img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>"/>
		</div>
		<h4 class="card-title"><?php VLang::__e('ORDER_DETAILS');?><?php echo $this->data['id'];?></h4>
		<div class="order-detail-pdf">
			<i class="pdf" onClick="javascript:generatePDF();"></i>
		</div>
		<div class="container text-center">
			<div class="row">
				<div class="col-sm-6 col-md-5 col-lg-6">
					<h4 class="invoice"><?php 
						$UserModel = new \App\Models\UserModel();
						$user = $UserModel->get($this->data['details']->customer_id);
						VLang::__e('ORDER_DETAILS_INVOCE');
					?></h4>
					<label class="store-name"><?php echo $user['firstname'].' '.$user['lastname'];?></label>
					<label class="store-name"><?php echo $user['phone'];?></label>
					<label class="store-name"><?php echo $user['email'];?></label>
				</div>
				<div class="col-sm-6 col-md-5 offset-md-2 col-lg-6 offset-lg-0">
					<label class="store-name"><?php VLang::__e('ORDER_DETAILS_ORDERNUMBER');?><?php echo $this->data['id'];?></label>
					<label class="store-name"><?php VLang::__e('ORDER_DETAILS_ORDERDATE');?><?php echo $this->data['details']->time_add;?></label>
					<label class="store-name"><?php VLang::__e('ORDER_DETAILS_ORDERPAYMENTMETHOD');?></label>
				</div>
			</div>
			<div class="row">
			<?php 
			$carts = (array)json_decode($this->data['details']->cart);
			$product = new \App\Models\AdminProductModel();
			?>
			<table class="table order-details">
			<thead>
			  <tr>
				<th><?php VLang::__e('ORDER_DETAILS_PRODUCT');?><img src="<?php echo v_base_url('public/front-end/images/home-logo.png');?>" style="float: right;width:30px;height:auto;"/></th>
				<th><?php VLang::__e('ORDER_DETAILS_QUANLITY');?></th>
				<th><?php VLang::__e('ORDER_DETAILS_PRICE');?></th>
			  </tr>
			</thead>
			<tbody>
			<?php $totalprice = 0;?>
			<?php foreach($carts as $key => $cart):?>
			<?php $key = explode('_', $key)[0];?>
			<tr>
				<td>
				<?php $productd = $product->get($key);?>
				<?php echo $productd['name'];?>
				</td>
				<td>
				<?php echo $cart->quanlity;?>
				</td>
				<td>
				<?php echo $productd['price']*$cart->quanlity,' '.$AppConfig->system_currency;?> <?php 
				$totalprice += $productd['price']*$cart->quanlity;
				?>
				</td>
			</tr>
			<?php endforeach;?>
			</tbody>
			</table>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 offset-md-4 total-right">
				<div class="container text-center">
				    <div class="row">
						<div class="col-sm-5 col-md-6"><?php VLang::__e('ORDER_DETAILS_SUBTOTAL');?></div>
						<div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"><?php echo $AppConfig->system_currency;?> <?php echo round($totalprice*$Currency->__getExchange($AppConfig->system_currency), 2);?></div>
					</div>
				</div>
				
				</div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4 offset-md-4 total-right">
				<div class="container text-center">
				    <div class="row">
						<div class="col-sm-5 col-md-6"><?php VLang::__e('ORDER_DETAILS_TOTAL');?></div>
						<div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0"><?php echo $AppConfig->system_currency;?> <?php echo round($totalprice*$Currency->__getExchange($AppConfig->system_currency), 2);?></div>
					</div>
				</div>
				
				</div>
			</div>
		</div>
	</div>
</div>
</div>