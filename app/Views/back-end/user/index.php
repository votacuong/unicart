<script type="text/javascript">
function deleteUser(userId)
{
	jQuery('<div class="dialog-delete"><?php echo VLang::__e('USER_LISTING_DELETE_DIALOG');?></div>').dialog({
	  buttons: { 
			OK: function() { 
			    window.location.href="<?php echo v_base_url('admin/user/delete/');?>"+userId;
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
		<h4 class="card-title"><?php VLang::__e('USER_LISTING');?></h4>
		<div class="table-responsive">		
		<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search search-form" action="<?php echo v_base_url('admin/users');?>" method="get">
		<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('admin/user/edit');?>"><?php VLang::__e('USER_LISTING_NEWUSER');?></a>
		  <input type="text" class="form-control" name="query" placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" value="<?php echo $this->data['query'];?>">
		  <button type="submit" class="btn btn-primary mb-2 search-button"><?php VLang::__e('USER_LISTING_SUBMIT');?></button>
		</form>
		  <table class="table">
			<thead>
			  <tr>
			    <th><?php VLang::__e('USER_LISTING_PHOTO');?></th>
				<th><?php VLang::__e('USER_LISTING_FIRSTNAME');?> <?php if( orderby('firstname') == true){ echo '<a href="'.urlOrder('firstname', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('firstname', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_LASTNAME');?> <?php if( orderby('lastname') == true){ echo '<a href="'.urlOrder('lastname', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('lastname', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_PHONE');?> <?php if( orderby('phone') == true){ echo '<a href="'.urlOrder('phone', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('phone', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_EMAIL');?> <?php if( orderby('email') == true){ echo '<a href="'.urlOrder('email', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('email', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_USERTYPE');?></th>
				<th><?php VLang::__e('USER_LISTING_STATE');?></th>
				<th><?php VLang::__e('USER_LISTING_ACTION');?></th>
			  </tr>
			</thead>
			<tbody>
				<?php $StoreModel = new \App\Models\StoreModel();?>
				<?php foreach($this->data['list'] as $key => $obj):?>
				<tr>
				<td> 
					<?php 
					
					if ( is_file(FCPATH . '../public/images/users/'.$obj['id'].'.png') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.$obj['id'].'.png?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/users/'.$obj['id'].'.jpg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.$obj['id'].'.jpg?time='.date("Y-m-d H:i:s"));?>" />
					<?php elseif ( is_file(FCPATH . '../public/images/users/'.$obj['id'].'.jpeg') ):?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/users/'.$obj['id'].'.jpeg?time='.date("Y-m-d H:i:s"));?>" />
					<?php else:?>
						<img class="profile-img" src="<?php echo v_base_url('public/images/default.jpg');?>" />
					<?php endif;
					?>
				</td>
				<td>
				  <a class="nav-link" href="<?php echo v_base_url('admin/user/edit/'.$obj['id']);?>"><?php echo $obj['firstname'];?></a>
				</td>
				<td> <?php echo $obj['lastname'];?> </td>
				<td> <?php echo $obj['phone'];?> </td>
				<td> <?php echo $obj['email'];?> </td> 
				<td>
				<?php 
				    if ( $obj['user_type'] != 1 ){
						VLang::__e('USER_LISTING_USERTYPE_OWNER');
					}else{
						VLang::__e('USER_LISTING_USERTYPE_ADMINISTRATOR');
					}
				?> 
				</td>
				<td> <?php 
				   if ($obj['state'] == 1):?>
					<div class="form-check form-check-primary">
						<a class="nav-link" href="<?php echo v_base_url('admin/user/state?id='.$obj['id'].'&state=0');?>">
							<div class="badge badge-outline-success"><?php VLang::__e('USER_LISTING_STATE_ON');?></div>
						</a>
					</div>
				<?php else:?>
				<div class="form-check form-check-danger">
				    <a class="nav-link" href="<?php echo v_base_url('admin/user/state?id='.$obj['id'].'&state=1');?>">
						<div class="badge badge-outline-danger"><?php VLang::__e('USER_LISTING_STATE_OFF');?></div>					
				    </a>
				</div>
				<?php endif;?></td>
				<td>
				  <div class="badge badge-outline-danger" onClick="javascript:deleteUser('<?php echo $obj['id'];?>');"><?php VLang::__e('USER_LISTING_DELETE');?></div>
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