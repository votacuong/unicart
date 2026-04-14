<script type="text/javascript">
function deleteItem(userId)
{
	jQuery('<div class="dialog-delete"><?php echo VLang::__e('USER_LISTING_DELETE_DIALOG');?></div>').dialog({
	  buttons: { 
			OK: function() { 
			    window.location.href="<?php echo v_base_url('admin/product/delete/');?>"+userId;
			},
			Cancel: function(){
				$(this).dialog("close"); 
			}
		}
	});
}
</script>
<?php echo showMessages(); $AppConfig = new \Config\AppConfig(); ?>
<div class="col-12 grid-margin">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php VLang::__e('PRODUCT_LISTING');?></h4>
		<div class="table-responsive">		
		<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search search-form" action="<?php echo v_base_url('admin/products');?>" method="get">
		<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('admin/product/edit');?>"><?php VLang::__e('PRODUCT_LISTING_ADDNEW');?></a>
		  <input type="text" class="form-control" name="query" placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" value="<?php echo $this->data['query'];?>">
		  <button type="submit" class="btn btn-primary mb-2 search-button"><?php VLang::__e('USER_LISTING_SUBMIT');?></button>
		</form>
		  <table class="table">
			<thead>
			  <tr>
			    <th><?php VLang::__e('PRODUCT_LISTING_PHOTO');?></th>
				<th><?php VLang::__e('PRODUCT_LISTING_NAME');?> <?php if( orderby('name') == true){ echo '<a href="'.urlOrder('name', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('name', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('PRODUCT_LISTING_PRICE');?> <?php if( orderby('price') == true){ echo '<a href="'.urlOrder('price', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('price', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('PRODUCT_LISTING_SKU');?> <?php if( orderby('sku') == true){ echo '<a href="'.urlOrder('sku', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('sku', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>				
				<th><?php VLang::__e('PRODUCT_LISTING_STATE');?></th>
				<th><?php VLang::__e('PRODUCT_LISTING_ACTION');?></th>
			  </tr>
			</thead>
			<tbody>
			  
				<?php foreach($this->data['list'] as $key => $obj):?>
				<tr>
				<td> 
					<?php 
					if ( is_file(FCPATH . '../public/images/product/'.$obj['id'].'.gif') ):?>
						<img class="card-img-top" src="<?php echo v_base_url('public/images/product/'.$obj['id'].'.gif?time='.date("Y-m-d"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/product/'.$obj['id'].'.png') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/product/'.$obj['id'].'.png?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/product/'.$obj['id'].'.jpg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/product/'.$obj['id'].'.jpg?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/product/'.$obj['id'].'.jpeg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/product/'.$obj['id'].'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
					<?php else:?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/default.jpg');?>" />
					<?php endif;
					?>
				</td>
				<td>
				  <a class="nav-link" href="<?php echo v_base_url('admin/product/edit/'.$obj['id']);?>"><?php echo $obj['name'];?></a>
				</td>
				<td> <?php echo $obj['price'].' '.$AppConfig->system_currency;?> </td>
				<td> <?php echo $obj['sku'];?> </td>
				<td> <?php 
				   if ($obj['state'] == 1):?>
					<div class="form-check form-check-primary">
						<a class="nav-link" href="<?php echo v_base_url('admin/product/state?id='.$obj['id'].'&state=0');?>">
							<div class="badge badge-outline-success"><?php VLang::__e('PRODUCT_LISTING_STATE_ON');?></div>
						</a>
					</div>
				<?php else:?>
				<div class="form-check form-check-danger">
				    <a class="nav-link" href="<?php echo v_base_url('admin/product/state?id='.$obj['id'].'&state=1');?>">
						<div class="badge badge-outline-danger"><?php VLang::__e('PRODUCT_LISTING_STATE_OFF');?></div>					
				    </a>
				</div>
				<?php endif;?></td>
				<td>
				  <div class="badge badge-outline-danger" onClick="javascript:deleteItem('<?php echo $obj['id'];?>');"><?php VLang::__e('PRODUCT_LISTING_DELETE');?></div>
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