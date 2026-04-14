<?php 
echo showMessages(); ?>
<div class="card h-100 thecup-container">
  <div class="card-body">
	
	<form class="forms-sample" method="post" action="<?php echo v_base_url('activities/edit');?>" onSubmit="">
	<h4 class="card-title">
	<?php VLang::__e('ACTIVITIES_LANGUAGE');?>
	</h4>
	  <?php
	   $languages = array('0'=>'English', '1'=>'Vietnamese');
	  ?>
	  <?php foreach($languages as $language):?>
		<div class="col-auto activities-config">
		<label for="<?php echo $language;?>">
		<input type="radio" name="language[]" value="<?php echo $language;?>" id="<?php echo $language;?>" <?php if ($this->data['details']['language'] == $language){ echo 'checked="checked"';}?>><?php echo $language;?></label>
	  </div>
	<?php endforeach;?>
	
	<?php
	$AdminCurrencyModel = new \App\Models\AdminCurrencyModel();
	$currencies = $AdminCurrencyModel->select(['state'=>1]);
	?>
	<h4 class="card-title">
	<?php VLang::__e('ACTIVITIES_CURRENCY');?>
	</h4>
	   <?php foreach($currencies as $currency):?>
		<div class="col-auto activities-config">
		<label for="<?php echo $currency['code'];?>">
		<input type="radio" name="currency[]" value="<?php echo $currency['code'];?>" id="<?php echo $currency['code'];?>" <?php if ($this->data['details']['currency'] == $currency['code']){ echo 'checked="checked"';}?>><?php echo $currency['code'];?></label>
	  </div>
	<?php endforeach;?>
	  <div class="col-auto form-bottom">
	  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('USER_EDITUSER_SUBMIT');?>" />
	  <a class="btn btn-dark" href="<?php echo v_base_url('');?>"><?php VLang::__e('USER_EDITUSER_CANCEL');?></a>
	  </div>
	</form>
  </div>
</div>