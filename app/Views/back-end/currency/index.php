<?php echo showMessages(); ?>
<div class="col-12 grid-margin">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php VLang::__e('CURRENCIES_TABLE_TITLE');?></h4>
		<div class="table-responsive">	
<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search search-form" action="<?php echo v_base_url('admin/currencies');?>" method="get">
<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('admin/currency/edit');?>"><?php VLang::__e('PAYMENT_LISTING_ADDNEW');?></a>
<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('admin/currency/sync_exchanges');?>">Sync</a>
  <input type="text" class="form-control" name="query" placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" value="<?php echo $this->data['query'];?>">
  <button type="submit" class="btn btn-primary mb-2 search-button"><?php VLang::__e('USER_LISTING_SUBMIT');?></button>
</form>
<?php $App = new \Config\App();$AppConfig = new \Config\AppConfig();?>
<?php $exchange_for = isset($_REQUEST['exchange_for'])?$_REQUEST['exchange_for']:'AUD';?>
<select name="exchange_for" class="form-control" style="float: right; width: 150px;margin-top: 9px;" onChange="window.location.href='<?php echo v_base_url('admin/currencies');?>?exchange_for='+this.value;">
	<?php foreach($this->data['list'] as $currency):?>
		<?php if ($currency['state'] == 1):?>
		<?php if ($exchange_for == $currency['code']):?>
			<option value="<?php echo $currency['code'];?>" selected="selected"><?php echo VLang::__(strtoupper($currency['code']));?></option>
		<?php else:?>
			<option value="<?php echo $currency['code'];?>" ><?php echo VLang::__(strtoupper($currency['code']));?></option>
		<?php endif;?>
		<?php endif;?>
	<?php endforeach;?>			
</select>
<table class="table table-striped">
	<thead>
		<tr>
			<th><?php echo VLang::__('CURRENCY_CODE');?></th>
			<th><?php echo VLang::__('CURRENCY_SYMBOL');?></th>
			<th><?php echo VLang::__('CURRENCY_EXCHANGE_FOR').$exchange_for;?></th>
			<th><?php echo VLang::__('CURRENCY_SYNC');?></th>
			<th><?php echo VLang::__('CURRENCY_STATE');?></th>
			<th ><?php echo VLang::__('PAYMENT_LISTING_ACTION');?></th>
		</tr>
	</thead>
	<tbody>
	<?php $CurrencyModel = new \App\Models\AdminCurrencyModel(); $exchanges = (array)json_decode($CurrencyModel->select(array('code'=>$exchange_for))[0]['exchange']);?>
	<?php if(count($this->data['list'])): foreach($this->data['list'] as $currency): ?>	
	<tr>
		<td><a href="<?php echo v_base_url('admin/currency/edit/' . $currency['id']); ?>"><?php echo $currency['code'];?></a></td>
		<td><a href="<?php echo v_base_url('admin/currency/edit/' . $currency['id']); ?>"><?php echo $currency['symbol'];?></a></td>
		<td><?php echo isset($exchanges[$currency['code']])?$exchanges[$currency['code']].$currency['code']:'';?></td>
		<td><a href="<?php echo v_base_url('admin/currency/sync/'.$currency['id']);?>"><?php echo VLang::__('CURRENCY_SYNC');?></a></td>
		<td><?php echo ($currency['state'] == 1)?'<a href="'.v_base_url('admin/currency/state?id='.$currency['id'].'&state=0').'"><div class="badge badge-outline-success">'.VLang::__('CURRENCY_ON').'</div></a>':'<a href="'.v_base_url('admin/currency/state?id='.$currency['id'].'&state=1').'"><div class="badge badge-outline-danger">'.VLang::__('CURRENCY_OFF').'</div></a>';?></td>
		<td><a href="<?php echo v_base_url('admin/currency/delete/' . $currency['id']); ?>" class="badge badge-outline-danger"><?php echo VLang::__('PAYMENT_LISTING_ACTION_DELETE');?></a></td>
	</tr>
	<?php endforeach; ?>
	<?php else: ?>
	<tr>
		<td colspan="5"><?php echo VLang::__('USER_TABLE_NODATA');?></td>
	</tr>
	<?php endif; ?>	
	</tbody>
</table>
<?= str_replace('index.php/', '', $this->data['pager']->links()); ?>
</div>
</div>
</div>
</div>