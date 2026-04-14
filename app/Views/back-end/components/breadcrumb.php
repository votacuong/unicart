<?php
$App = new \Config\App();
Helper(['Common']);
$currUrl = str_replace($App->baseURL.'/', '', getUrl());
$etx = explode('?', $currUrl);
$etx = explode('/', $etx[0]);
$newUrl = $App->baseURL.'/admin';
?>
<div class="col-lg-12 grid-margin breadcrumb-panel">
	<div class="card">
		<div class="card-body">
			<nav aria-label="breadcrumb">
			  <button type="button" class="mdi mdi-home breadcrumb-home"></button>
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo $App->baseURL;?>/admin"><?php VLang::__e('BREADCRUMB_HOME');?></a></li>
				<?php foreach($etx as $key => $value ):?>
				<?php if ( $value != 'admin' && $value != 'index.php'):?>
				<?php $newUrl .= '/'.$value;?>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo $newUrl;?>"><?php echo ucfirst($value);?></a></li>
				<?php endif;?>
				<?php endforeach;?>
			  </ol>
			</nav>
		</div>
	</div>
</div>