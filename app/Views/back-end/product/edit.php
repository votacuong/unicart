<?php 
$AppConfig = new \Config\AppConfig();
$googleMapApi = $AppConfig->google_api_key;
$googleMapApi = "key=" . $googleMapApi . "&sensor=false&libraries=places";
$googleMapApiURL = 'https://maps.googleapis.com/maps/api/js?v=3.exp&'.$googleMapApi.'&callback=initLocaltion';
echo showMessages(); 
?>
<script src="<?php echo v_base_url('public/back-end/assets/js/product.js');?>"></script>
<script type="text/javascript">
var latitude = '<?php echo $this->data['details']['latitude'];?>', longitude = '<?php echo $this->data['details']['longitude'];?>';
var icon = '<?php echo v_base_url('public/front-end/images/pin.png');?>';
var upload = false;
</script>
<script src="<?php echo $googleMapApiURL ;?>"></script>
<div class="col-12 grid-margin stretch-card">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title">
		<?php if ( $this->data['details']['id'] > 0 ):?>
		<?php VLang::__e('PRODUCT_EDITPRODUCT'); echo $this->data['details']['name'];?>
		<?php else:?>
		<?php VLang::__e('PRODUCT_NEWPRODUCT');?>
		<?php endif;?>
		</h4>
		<?= \Config\Services::validation()->listErrors(); ?>
		<form class="forms-sample" method="post" action="<?php echo v_base_url('admin/product/edit/'.$this->data['details']['id']);?>" enctype="multipart/form-data" >
		  <div class="form-group">
			<label for="name"><?php VLang::__e('PRODUCT_NAME');?></label>
			<input type="text" class="form-control" id="name" placeholder="<?php VLang::__e('PRODUCT_NAME');?>" name="name" value="<?php echo $this->data['details']['name'];?>">
		  </div>
		  <div class="form-group">
			<label for="description"><?php VLang::__e('PRODUCT_DESCRIPTION');?></label>
			<textarea type="text" style="height:300px;" class="form-control" id="description" placeholder="<?php VLang::__e('PRODUCT_DESCRIPTION');?>" name="description"><?php echo $this->data['details']['description'];?></textarea>
		  </div>
		  <div class="form-group">
			<label for="price"><?php VLang::__e('PRODUCT_PRICE');?></label>
			<input type="text" class="form-control" id="price" placeholder="<?php VLang::__e('PRODUCT_PRICE');?>" name="price" value="<?php echo $this->data['details']['price'];?>">
		  </div>                                                            
		  <div class="form-group">
			<label for="sku"><?php VLang::__e('PRODUCT_SKU');?></label>
			<input type="sku" class="form-control" id="sku" placeholder="<?php VLang::__e('PRODUCT_SKU');?>" name="sku" value="<?php echo $this->data['details']['sku'];?>">
		  </div>
		  <div class="form-group">
			<label for="address"><?php VLang::__e('PRODUCT_ADDRESS');?></label>
			<input type="text" class="form-control" id="address" placeholder="<?php VLang::__e('PRODUCT_ADDRESS');?>" name="address" value="<?php echo $this->data['details']['address'];?>">
			<div id="map"></div>
		  </div>
		  <div class="form-group">
			<label><?php VLang::__e('PRODUCT_PHOTO');?></label>
			<input type="file" name="photo" class="file-upload-default" id="photo">
			<div class="input-group col-xs-12">
			  <input type="text" class="form-control file-upload-info" disabled="" placeholder="<?php VLang::__e('PRODUCT_PHOTO_IMAGE');?>">
			  <span class="input-group-append">
				<button class="file-upload-browse btn btn-primary" type="button" onCLick="jQuery('#photo').click();"><?php VLang::__e('PRODUCT_PHOTO_IMAGE');?></button>
			  </span>
			</div>
		  </div>
		  <div class="form-group">
			<label for="state"><?php VLang::__e('PRODUCT_STATE');?></label>
			<select class="form-control" id="state" name="state">
			  <option value="1" <?php if ($this->data['details']['state'] == 1){ echo 'selected="selected"';}?>><?php VLang::__e('PRODUCT_STATE_ON');?></option>
			  <option value="0" <?php if ($this->data['details']['state'] == 0){ echo 'selected="selected"';}?>><?php VLang::__e('PRODUCT_STATE_OFF');?></option>
			</select>
		  </div>
		  <input type="hidden" name="latitude" id="latitude" value="<?php echo $this->data['details']['latitude'];?>" />
		  <input type="hidden" name="longitude" id="longitude" value="<?php echo $this->data['details']['longitude'];?>" />
		  <input type="submit" name="submit" class="btn btn-primary mr-2" value="<?php VLang::__e('USER_EDITUSER_SUBMIT');?>" />
		  <a class="btn btn-dark" href="<?php echo v_base_url('admin/products');?>"><?php VLang::__e('USER_EDITUSER_CANCEL');?></a>
		</form>
	  </div>
	</div>
  </div>