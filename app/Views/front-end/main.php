<?php
include(dirname(__FILE__).'/components/head.php');
?>
<body>
	<?php include(dirname(__FILE__).'/components/navbar.php'); ?>
	<section class="py-5">
		<div class="container px-4 px-lg-5 mt-5 thecup-container">
			<div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center">
				<?php 
				  if (!empty($this->data['subview']))
				  {
						include(dirname(__FILE__).'/'.$this->data['subview']); 
				  }
				  ?>
			</div>
		</div>
	</section>
	<!-- Footer-->
	<footer class="py-5 bg-dark">
		<?php
		include(dirname(__FILE__).'/components/footer.php');
		?>
	</footer>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery.get('<?php echo v_base_url('cart/maintain');?>', function(){});
			jQuery.get('<?php echo v_base_url('currency-sync');?>', function(){});
		});
	</script>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-XXXXX-Y', 'auto');
		ga('send', 'pageview');
	</script>
  </body>
</html>