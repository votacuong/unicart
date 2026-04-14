<?php echo showMessages(); ?>
<div class="col-12 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title">
		<?php VLang::__e('SETTINGS');?>
		</h4>

		<form class="forms-sample" method="post" action="<?php echo v_base_url('admin/settings');?>">
		  <div class="form-group">
			<label for="system_language"><?php VLang::__e('SETTING_SYSTEMLANGUAGE');?></label>
			<select class="form-control" name="system_language" id="system_language">
				<option value="English" <?php if( $this->data['details']->system_language == 'English'){ echo 'selected="selected"';}?>>English</option>
				<option value="Vietnamese" <?php if( $this->data['details']->system_language == 'Vietnamese'){ echo 'selected="selected"';}?>>Vietnamese</option>
			</select>
		  </div>
		  <?php
			$AdminCurrencyModel = new \App\Models\AdminCurrencyModel();
			$currencies = $AdminCurrencyModel->select(['state'=>1]);
			?>
		  <div class="form-group">
			<label for="system_currency"><?php VLang::__e('SETTING_CURRENCY');?></label>
			<select class="form-control" name="system_currency" id="system_currency">
				<?php foreach($currencies as $currency):?>
				<option value="<?php echo $currency['code'];?>" <?php if( $this->data['details']->system_currency == $currency['code']){ echo 'selected="selected"';}?>><?php echo $currency['code'];?></option>
				<?php endforeach;?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="google_api_key"><?php VLang::__e('SETTING_GOOGLE_APIKEY');?></label>
			<input type="text" class="form-control" id="google_api_key" placeholder="<?php VLang::__e('SETTING_GOOGLE_APIKEY');?>" name="google_api_key" value="<?php echo $this->data['details']->google_api_key;?>">
		  </div>
		  <div class="form-group">
			<label for="stripe_mode"><?php VLang::__e('SETTING_STRIPE_MODE');?></label>
			<select class="form-control" name="stripe_mode" id="stripe_mode">
				<option value="live" <?php if( $this->data['details']->stripe_mode == 'live'){ echo 'selected="selected"';}?>>Live</option>
				<option value="test" <?php if( $this->data['details']->stripe_mode == 'test'){ echo 'selected="selected"';}?>>Test</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="stripeclientid"><?php VLang::__e('SETTING_STRIPE_CLIENTID');?></label>
			<input type="text" class="form-control" id="stripeclientid" placeholder="<?php VLang::__e('SETTING_STRIPE_CLIENTID');?>" name="stripeclientid" value="<?php echo $this->data['details']->stripeclientid;?>">
		  </div>
		  <div class="form-group">
			<label for="stripesecretkey_test"><?php VLang::__e('SETTING_STRIPE_SECRETKEY');?></label>
			<input type="text" class="form-control" id="stripesecretkey_test" placeholder="<?php VLang::__e('SETTING_STRIPE_SECRETKEY');?>" name="stripesecretkey_test" value="<?php echo $this->data['details']->stripesecretkey_test;?>">
		  </div>
		  <div class="form-group">
			<label for="stripepublickey_test"><?php VLang::__e('SETTING_STRIPE_PUBLICKEY');?></label>
			<input type="text" class="form-control" id="stripepublickey_test" placeholder="<?php VLang::__e('SETTING_STRIPE_PUBLICKEY');?>" name="stripepublickey_test" value="<?php echo $this->data['details']->stripepublickey_test;?>">
		  </div>
		  <div class="form-group">
			<label for="stripesecretkey_live"><?php VLang::__e('SETTING_STRIPE_SECRETKEY_LIVE');?></label>
			<input type="text" class="form-control" id="stripesecretkey_live" placeholder="<?php VLang::__e('SETTING_STRIPE_SECRETKEY_LIVE');?>" name="stripesecretkey_live" value="<?php echo $this->data['details']->stripesecretkey_live;?>">
		  </div>
		  <div class="form-group">
			<label for="stripepublickey_live"><?php VLang::__e('SETTING_STRIPE_PUBLICKEY_LIVE');?></label>
			<input type="text" class="form-control" id="stripepublickey_live" placeholder="<?php VLang::__e('SETTING_STRIPE_PUBLICKEY_LIVE');?>" name="stripepublickey_live" value="<?php echo $this->data['details']->stripepublickey_live;?>">
		  </div>
		  <div class="form-group">
			<label for="mailfrom"><?php VLang::__e('SETTING_MAILFROM');?></label>
			<input type="text" class="form-control" id="mailfrom" placeholder="<?php VLang::__e('SETTING_MAILFROM');?>" name="mailfrom" value="<?php echo $this->data['details']->mailfrom;?>">
		  </div>
		  <div class="form-group">
			<label for="google_app_password"><?php VLang::__e('SETTING_GOOGLE_APP_PASSWORD');?></label>
			<input type="text" class="form-control" id="google_app_password" placeholder="<?php VLang::__e('SETTING_GOOGLE_APP_PASSWORD');?>" name="google_app_password" value="<?php echo $this->data['details']->google_app_password;?>">
		  </div>

		  <div class="form-group">
			<label for="google_app_password"><?php echo VLang::__('CURRENCY_APIKEY');?></label>
			<input type="text" class="form-control" name="currency_apikey" value="<?php echo $this->data['details']->currency_apikey;?>"/>
			<br />
			<a href="https://www.exchangerate-api.com/docs/php-currency-api" target="_blank">GET KEY</a>
          </div>
		  
		  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('SETTING_SUBMIT');?>" />
		  <a class="btn btn-dark" href="<?php echo v_base_url('admin/dashboard');?>"><?php VLang::__e('SETTING_CANCEL');?></a>
		</form>
	  </div>
	</div>
  </div>