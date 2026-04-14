<div class="container my-5">
  <!-- Footer -->
  <footer
          class="text-center text-lg-start text-white"
          >
    <!-- Grid container -->
    <div class="container p-4 pb-0 thecup-footer">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              <?php VLang::__e('THECUP_FOOTER_COMPANYNAME');?>
            </h6>
            <p>
              <a class="text-white-tangline"><?php VLang::__e('THECUP_FOOTER_COMPANYDESCRIPTION');?></a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold"><?php VLang::__e('THECUP_FOOTER_MENU_ABOUT_TITLE');?></h6>
            <p>
              <a class="text-white" href="<?php echo v_base_url('#');?>"><?php VLang::__e('UNICART_MENU_ABOUT');?></a>
            </p>
			<?php $usermodel = new \App\Models\UserModel();?>
			<?php if (!$usermodel->isLogin()):?>
            <p>
              <a class="text-white" href="<?php echo v_base_url('user/login');?>"><?php VLang::__e('UNICART_MENU_LOGIN');?></a>
            </p>
			<?php endif;?>
			<p>
              <a class="text-white" href="<?php echo v_base_url('#');?>"><?php VLang::__e('UNICART_MENU_PRIVACY');?></a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold"><?php VLang::__e('THECUP_FOOTER_MENU_STORES_TITLE');?></h6>
			<p>
              <a class="text-white" href="<?php echo v_base_url('#');?>"><?php VLang::__e('UNICART_MENU_TOPPRODUCT');?></a>
            </p>
			<p>
              <a class="text-white" href="<?php echo v_base_url('#');?>"><?php VLang::__e('UNICART_MENU_FAVOURITY');?></a>
            </p>
          </div>

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold"><?php VLang::__e('THECUP_FOOTER_CONTACT');?></h6>
            <p>
              <a class="text-white-tangline"><i class="fas fa-home mr-3"></i> Ha Noi, Viet Nam.</a>
            </p>
            <p>
              <a class="text-white-tangline"><i class="fas fa-envelope mr-3"></i> support@unicart.vn</a>
            </p>
            <p>
              <a class="text-white-tangline"><i class="fas fa-phone mr-3"></i> +84334551584</a>
            </p>
          </div>
          <!-- Grid column -->
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-3">

      <!-- Section: Copyright -->
      <section class="p-3 pt-0">
        <div class="row d-flex align-items-center">
          <!-- Grid column -->
          <div class="col-md-7 col-lg-8 text-center text-md-start">
            <!-- Copyright -->
            <div class="text-white-bottom">
              © 2026 Copyright: unicart.vn</div>
            <!-- Copyright -->
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
            <!-- Facebook -->
            <a
               class="btn btn-outline-light btn-floating m-1 text-white"
               role="button"
               href="#"><i class="fab fa-facebook-f"></i
               ></a>

            <!-- Instagram -->
            <a
               class="btn btn-outline-light btn-floating m-1 text-white"
               role="button"
                href="#"><i class="fab fa-instagram"></i
              ></a>
          </div>
          <!-- Grid column -->
        </div>
      </section>
      <!-- Section: Copyright -->
    </div>
    <!-- Grid container -->
  </footer>
  <!-- Footer -->
</div>
<link href="<?php echo v_base_url('public/Scroll-To-Top-Plugin-jQuery-Scrolls/jqueryscripttop.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo v_base_url('public/Scroll-To-Top-Plugin-jQuery-Scrolls/scrolls.js');?>"></script>
<script type="text/javascript">
	scroller.init();
</script>