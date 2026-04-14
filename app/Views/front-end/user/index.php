<script type="text/javascript">
function deleteUser(userId)
{
	jQuery('<div class="dialog-delete"><?php echo VLang::__e('USER_LISTING_DELETE_DIALOG');?></div>').dialog({
	  buttons: { 
			OK: function() { 
			    window.location.href="<?php echo v_base_url('user/delete/');?>"+userId;
			},
			Cancel: function(){
				$(this).dialog("close"); 
			}
		}
	});
}
</script>
<?php echo showMessages(); ?>
<div class="col-12 grid-margin">
	<div class="card">
	  <div class="card-body">
		<h4 class="card-title"><?php VLang::__e('USER_LISTING');?></h4>
		<div class="table-responsive">		
		<form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search search-form" action="<?php echo v_base_url('user');?>" method="get">
		<a class="nav-link btn btn-success create-new-button" href="<?php echo v_base_url('user/edit');?>"><?php VLang::__e('USER_LISTING_NEWUSER');?></a>
		  <input type="text" class="form-control" name="query" placeholder="<?php VLang::__e('USER_LISTING_SEARCH');?>" value="<?php echo $this->data['query'];?>">
		  <button type="submit" class="btn btn-primary mb-2 search-button"><?php VLang::__e('USER_LISTING_SUBMIT');?></button>
		</form>
		  <table class="table">
			<thead>
			  <tr>
				<th><?php VLang::__e('LEAD_LISTING_PHOTO');?></th>
				<?php if (session()->get('user_type') == 1):?>
				<th><?php VLang::__e('USER_LISTING_PARENT');?> <?php if( orderby('parent_id') == true){ echo '<a href="'.urlOrder('parent_id', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('parent_id', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<?php endif;?>
				<th><?php VLang::__e('USER_LISTING_FIRSTNAME');?> <?php if( orderby('firstname') == true){ echo '<a href="'.urlOrder('firstname', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('firstname', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_LASTNAME');?> <?php if( orderby('lastname') == true){ echo '<a href="'.urlOrder('lastname', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('lastname', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_PHONE');?> <?php if( orderby('phone') == true){ echo '<a href="'.urlOrder('phone', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('phone', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('LEAD_EDIT_ADDRESS');?> <?php if( orderby('address') == true){ echo '<a href="'.urlOrder('address', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('address', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('DEPARTMENT');?></th>
				<th><?php VLang::__e('USER_LISTING_EMAIL');?> <?php if( orderby('email') == true){ echo '<a href="'.urlOrder('email', 'desc').'"><i class="mdi mdi-arrow-down order-by"></i></a>';}else{ echo '<a href="'.urlOrder('email', 'asc').'"><i class="mdi mdi-arrow-up order-by"></i></a>';}?></th>
				<th><?php VLang::__e('USER_LISTING_USERTYPE');?></th>
				<th><?php VLang::__e('USER_LISTING_PACKAGE');?></th>
				<th><?php VLang::__e('USER_LISTING_DAILY');?></th>
				<th><?php VLang::__e('USER_LISTING_ENDATE');?></th>
				<th><?php VLang::__e('USER_LISTING_STATE');?></th>
				<th><?php VLang::__e('USER_LISTING_ACTION');?></th>
			  </tr>
			</thead>
			<tbody>
			  
				<?php foreach($this->data['list'] as $key => $obj):?>
				<tr>
				<td> 
					<?php 
					if ( is_file(FCPATH . '../public/images/users/'.$obj['id'].'.png') ):?>
						<img src="<?php echo v_base_url('public/images/users/'.$obj['id'].'.png');?>" />
					<?php else:?>
						<img src="<?php echo v_base_url('public/images/default.jpg');?>" />
					<?php endif;
					?>
				</td>
				<?php if (session()->get('user_type') == 1):?>
				<td>
					<?php 
					$user = new \App\Models\AdminUserModel();
					$userdetails = $user->get($obj['parent_id']);
					if ( isset($userdetails['id']) ):
					?>
				  <a class="nav-link" href="<?php echo v_base_url('admin/user/edit/'.$userdetails['id']);?>"><?php echo $userdetails['firstname'].' '.$userdetails['lastname'];?></a>
				  <?php endif;?>
				</td>
				<?php endif;?>
				<td>
				  <a class="nav-link" href="<?php echo v_base_url('user/edit/'.$obj['id']);?>"><?php echo $obj['firstname'];?></a>
				</td>
				<td> <?php echo $obj['lastname'];?> </td>
				<td> <?php echo $obj['phone'];?> </td>
				<td> <?php echo $obj['address'];?> </td>
				<td> <?php 
					$departments = explode(',', $obj['departments']);
					if (count($departments) > 0)
					{
						$de = [];
						$AdminDepartmentModel = new \App\Models\AdminDepartmentModel();
						foreach($departments as $department)
						{
							$ob = $AdminDepartmentModel->get($department);
							if ( isset($ob['name'])){
								$de[] = '<a class="nav-link" href="'.v_base_url('department/edit/'.$ob['id']).'">'.$ob['name'].'</a>';
							}
						}
						echo implode(PHP_EOL, $de);
					}
				?> 
				</td>
				<td> <?php echo $obj['email'];?> </td>
				<td>
				  <?php if ($obj['user_type'] == 1){
					  VLang::__e('USER_EDITUSER_USERTYPE_ADMINISTRATOR');
				  }else if($obj['user_type'] == 2){
					  VLang::__e('USER_EDITUSER_USERTYPE_OWNER');
				  }else{
					  VLang::__e('USER_EDITUSER_USERTYPE_WORKER');
				  }?>
				</td>
				
				<td> 
					<?php 
						if ( $obj['user_type'] == 2)
						{
							$package = new \App\Models\AdminPackageModel();
							$name = $package->select(['id'=>$obj['role_id']]);
							if ( count($name) > 0 ){
							?>
							<a class="nav-link" href="<?php echo v_base_url('package/edit/'.$obj['role_id']);?>"><?php echo $name[0]['name'];?></a>
							<?php
						}else{
							echo $obj['role_id'];
						}
					}else{
						$user = new \App\Models\AdminUserModel();
						$userdetails = $user->get( $obj['parent_id'] );
						if ( isset($userdetails['id'] ))
						{
							$package = new \App\Models\AdminPackageModel();
							$name = $package->select(['id'=>$userdetails['role_id']]);
							if ( count($name) > 0 ){
							?>
							<a class="nav-link" href="<?php echo v_base_url('package/edit/'.$userdetails['role_id']);?>"><?php echo $name[0]['name'];?></a>
							<?php
						}
						}
					}
					?> 
				</td>
				<td>
				<?php if ($obj['user_type'] == 3):
				$user = new \App\Models\AdminUserModel();
						$userdetails = $user->get( $obj['parent_id'] );
				?>
				<?php if ($userdetails['auto_charge'] == 1){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE');
				  }else if ($userdetails['auto_charge'] == 2){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_FREE');
				  }else if($userdetails['role_id'] == 13){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_YEAR');
				  }else{
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_NO');
				  }?>
				<?php else:?>
				  <?php if ($obj['auto_charge'] == 1){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE');
				  }else if ($obj['auto_charge'] == 2){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_FREE');
				  }else if($obj['role_id'] == 13){
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_YEAR');
				  }else{
					  VLang::__e('USER_EDITUSER_AUTOCHARGE_NO');
				  }?>
				  <?php endif;?>
				</td>
				<td> 
				<?php if ($obj['user_type'] == 3):
				$userdetails = $user->get( $obj['parent_id'] );?>
				<?php 
				$subscription = new \App\Models\AdminSubscriptionModel();
				$subscription = $subscription->select(['user_id'=>$userdetails['id'],'package_id'=>$userdetails['role_id']]);
				if ( count($subscription) > 0)
				{
					echo $subscription[count($subscription)-1]['time_end'];
				}
				else
				{
					echo 'none';
				}
				?> 
				<?php else:?>
				<?php 
				$subscription = new \App\Models\AdminSubscriptionModel();
				$subscription = $subscription->select(['user_id'=>$obj['id'],'package_id'=>$obj['role_id']]);
				if ( count($subscription) > 0)
				{
					echo $subscription[count($subscription)-1]['time_end'];
				}
				else
				{
					echo 'none';
				}
				?> 
				<?php endif;?>
				</td>
				<td> <?php 
				   if ($obj['state'] == 1):?>
					<div class="form-check form-check-primary">
						<a class="nav-link" href="<?php echo v_base_url('user/state?id='.$obj['id'].'&state=0');?>">
							<div class="badge badge-outline-success"><?php VLang::__e('USER_LISTING_STATE_ON');?></div>
						</a>
					</div>
				<?php else:?>
				<div class="form-check form-check-danger">
				    <a class="nav-link" href="<?php echo v_base_url('user/state?id='.$obj['id'].'&state=1');?>">
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
			<?= $this->data['pager']->links() ?>
		</div>
	  </div>
	</div>
  </div>