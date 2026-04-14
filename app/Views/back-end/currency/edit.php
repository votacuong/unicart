<?php echo showMessages(); ?>
<div class="col-12 grid-margin stretch-card">
<div class="card">
<div class="card-body">
<h3><?php $App = new \Config\App();echo empty($this->data['details']['id']) ? VLang::__('CURRENCY_EDIT_ADDNEW') : VLang::__('CURRENCY_EDIT_EDIT') . $this->data['details']['code']; ?></h3>
<form class="forms-sample" method="post" action="<?php echo v_base_url('admin/currency/edit/'.$this->data['details']['id']);?>">
<table class="table">
	<tr>
		<td><?php echo VLang::__('CURRENCY_CODE');?><br />
		<input type="text" class="form-control" id="code" placeholder="<?php VLang::__e('CURRENCY_CODE');?>" name="code" value="<?php echo $this->data['details']['code'];?>">
		</td>
	</tr>
	<tr>
		<td><?php echo VLang::__('CURRENCY_SYMBOL');?><br />
		<input type="text" class="form-control" id="symbol" placeholder="<?php VLang::__e('CURRENCY_SYMBOL');?>" name="symbol" value="<?php echo $this->data['details']['symbol'];?>">
		</td>
	</tr>
	<tr>
		<td><?php echo VLang::__('CURRENCY_STATE');?><br />
		<select name="state" class="form-control">
			<option value="1" <?php if ($this->data['details']['state'] == 1){echo 'selected="selected"';}?>><?php echo VLang::__('CURRENCY_ON');?></option>
			<option value="0" <?php if ($this->data['details']['state'] == 0){echo 'selected="selected"';}?>><?php echo VLang::__('CURRENCY_OFF');?></option>
		</select>
		</td>
	</tr>
	<tr>
	    <td>
		<input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('USER_EDITUSER_SUBMIT');?>" />
		<input type="button" name="<?php echo VLang::__('USER_EDITUSER_CANCEL');?>" value="<?php echo VLang::__('USER_EDITUSER_CANCEL');?>" onClick="window.location.href='<?php echo v_base_url('admin/currencies');?>';" class="btn btn-danger">
		</td>
	</tr>
</table>
</form>
</div>
</div>
</div>