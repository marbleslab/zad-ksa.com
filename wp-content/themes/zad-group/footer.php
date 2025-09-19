<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zadgroup
 */

global $current_language;
// Get the language from the cookie if available, otherwise default to 'en'
$current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en'; 
$lang = $current_language;  // Assign it to $lang as well

?>
   <footer class="bg-black pt-3 site-footer" id="colophon" >
      <button id="scrollToTopBtn" onclick="scrollToTop()">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/topbtn.png" alt="placeholder" class="" />
      </button>
      <div class="container py-3">
        <!-- <div class="text-center">
          <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/footerLogo.png" alt="placeholder" class="" />
        </div> -->
		<div class="site-footer-branding text-center">
			<?php
			// Get the footer logo from the customizer
			$footer_logo = get_theme_mod( 'footer_logo' );

			// Display the footer logo if set, otherwise fallback to site title
			if ( $footer_logo ) :
				?>
				<a href="<?php echo esc_url( home_url( '/' ). '?lang=' . $lang ); ?>" rel="home">
					<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="footer-logo">
				</a>
				<?php
			else :
				// Fallback to site title if no logo is set
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php
			endif;
			?>
		</div>

        <div
          class="row w-100 mx-auto align-items-center  justify-content-between"
        >
          <div class="col-sm-3 col-6 order-sm-1 order-2">
            <div
              class="d-flex flex-column justify-content-center text-center gap-4"
            >
               <a href="<?php echo esc_url( home_url( '/join-us' ). '?lang=' . $lang ); ?>"  class="text-white text-decoration-none"><?php echo custom_translate('join_us'); ?></a>
              <a href="<?php echo esc_url( home_url( '/privacy-policy' ). '?lang=' . $lang ); ?>" class="text-white text-decoration-none"
                ><?php echo custom_translate('privacy_policy'); ?></a
              >
            
            </div>
          </div>
          <div class="col-sm-5 order-sm-2 order-1 mb-sm-0 mb-5">
            <div class="text-white d-flex gap-3 justify-content-center pb-4">
              <!-- <a href="https://www.instagram.com/marbleslabksa/"><img src="<?php //echo get_template_directory_uri(); ?>/assets/images/insta.png" alt="social" /></a>
              <a href="https://www.tiktok.com/@marbleslabksa"><img src="<?php //echo get_template_directory_uri(); ?>/assets/images/tiktok.png" alt="social" /></a> -->
              <a href="https://www.linkedin.com/company/zad-ksa/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.png" alt="social" /></a>
             
              <a href=" https://www.google.com/maps/place/Zad+Holding+Co./@21.5243894,39.1570074,21z/data=!4m12!1m5!3m4!2zMjHCsDMxJzI3LjYiTiAzOcKwMDknMjUuOSJF!8m2!3d21.5243239!4d39.1571804!3m5!1s0x15c3cf8b0518fa8f:0xd1b8ea7967ffb07b!8m2!3d21.5242978!4d39.1571717!16s%2Fg%2F11g6rf3ghl?entry=ttu&g_ep=EgoyMDI0MTIxMS4wIKXMDSoASAFQAw%3D%3D" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/location.png" alt="social" /></a>
            </div>
            <!-- <p class="form-text text-center fs-20 text-dark-gray">
              Subscribe for the weekly newsletter
            </p>
            <div class="contact-form subscribeForm">
              <form class="d-flex flex-column gap-3">
                <div class="row w-100 mx-auto justify-content-center">
                  <div class="form-group col-md-9 px-0">
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Your e-mail*"
                      required
                    />
                  </div>
                  <div class="form-group col-md-2 px-sm-3 px-0 mt-sm-0 mt-3">
                    <div class="">
                      <button
                        type="submit"
                        class="btn btn-orange fs-20 subscribeBtn rounded-sm-0"
                      >
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Join_us_now.svg" alt="" />
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div> -->
          </div>
          <div class="col-sm-3 col-6 order-sm-3 order-3">
            <div
              class="d-flex flex-column justify-content-center text-center gap-4"
            >
             <a href="<?php echo esc_url( home_url( '/about-us' ). '?lang=' . $lang ); ?>" class="text-white text-decoration-none"><?php echo custom_translate('about_us');?></a>
              <a href="#" data-bs-toggle="modal" data-bs-target="#contactUsForm" class="text-white text-decoration-none"><?php echo custom_translate('contact_us');?></a>
              <a href="<?php echo esc_url( home_url( '/gallery' ) . '?lang=' . $lang); ?>" class="text-white text-decoration-none"><?php echo custom_translate('gallery');?></a>
            </div>
          </div>
        </div>
        <p class="form-text text-center fs-14 text-dark-gray pt-2 mb-0" >@<span id="currentYear"></span></p>
       

        <script>
          document.getElementById("currentYear").textContent = new Date().getFullYear();
        </script>

      </div>
      <!-- Button trigger modal -->


      <!-- Modal join us form -->
      <div class="modal fade" id="joinusForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="joinusFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
          <div class="modal-content joinformSec bg-primary">
        <div class="text-end p-2"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
          
            <div class="modal-body">
            
            <div
              class="container d-flex flex-column justify-content-center align-items-center"
            >
              <div class="w-100">
                <h3 class="mb-4 fw-bold text-black text-center">
                  Ready to Join the ZAD Family?
                </h3>
                <p class="m-0 fs-24 text-black lh-sm text-center px-sm-5 mx-sm-5">
                  we're always lookng for talended individuals to join our team.
                  <strong>Apply now!</strong>
                </p>

                <div class="form-title mt-4 text-start d-flex">
                  <div></div>
                  <div>
                    <span class="d-block text-dark-gray">How to apply:</span>

                    <span>
                      Fill out this application form OR Send your resume to
                      <a href="mailto:recruiting@zad-ksa.com"
                        >recruiting@zad-ksa.com</a
                      ></span
                    >
                  </div>
                </div>
              
                <?php echo do_shortcode('[contact-form-7 id="e834dfb" title="join us form"]');?>
                <div class="privacy-policy text-white text-center ">
                  By submitting the form you agree to
                  <a href="#" class="text-white">Privacy & Policy</a>
                </div>
              </div>
            </div>
          
            </div>
            
          </div>
        </div>
      </div>

<!-- Modal contact us form -->
   <!-- Modal -->
      <div class="modal fade" id="contactUsForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contactUsFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content bg-dark-gray">
            <div class="text-end p-2"> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>   
                <div class="modal-body">
                  <div class="container">
                    <div class="row w-100 mx-auto justify-content-between">
                        <div class="col-sm-4">
                            <div>
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/lovecard.png" alt="placeholder" />
                              <h3 class="text-black fw-bold"> <?php echo custom_translate('contact_us'); ?></h3>
                              <div class="row w-100 mx-auto">
                                <div class="col-sm-6 px-0">
                                  <p class="fw-bold"><?php echo custom_translate('head_Office'); ?></p>
                                </div>
                                <div class="col-sm-6">
                                  <p><?php echo custom_translate('address'); ?></p>
                                </div>
                              </div>
                              <div class="row w-100 mx-auto">
                                <div class="col-sm-6 px-0">
                                  <p class="fw-bold"><?php echo custom_translate('phone_number'); ?></p>
                                </div>
                                <div class="col-sm-6">
                                  <p>9200 11480</p>
                                </div>
                              </div>
                            </div>
                        </div>
                      <div class="col-sm-7">
                        <div class="contact-form">
                        
                            <?php echo do_shortcode('[contact-form-7 id="8e55cfc" title="Contact form 1"]');?>
                            <p class="form-text text-center fs-14 text-dark-gray">
                               <?php echo custom_translate('submittingPolicy'); ?>
                            </p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
      </div>

    </footer>
<script>
document.addEventListener("DOMContentLoaded", function() {
  let zoomLevel = 1;
  const maxZoom = 2.5;
  const minZoom = 1;
  const zoomStep = 0.25;
  var mainContent = document.querySelector('.site');

  function applyZoom() {
    if (mainContent) {
      mainContent.style.transform = `scale(${zoomLevel})`;
      mainContent.style.transformOrigin = "top left";
      mainContent.style.transition = "transform 0.2s";
    }
    // Show floating controls when zoomed in/out
    floatingControls.style.display = (zoomLevel !== 1) ? "flex" : "none";
  }

  // Header controls (already in your HTML)
  var plusBtn = document.getElementById("zoomInBtn");
  var minusBtn = document.getElementById("zoomOutBtn");
  var resetBtn = document.getElementById("zoomResetBtn");

  // Create floating controls (hidden by default)
  var floatingControls = document.createElement('div');
  floatingControls.id = "floating-zoom-controls";
  floatingControls.style.position = "fixed";
  floatingControls.style.bottom = "91%";
  floatingControls.style.right = "30px";
  floatingControls.style.zIndex = "10001";
  floatingControls.style.display = "none";
  floatingControls.style.gap = "6px";
  floatingControls.style.background = "#fff";
  floatingControls.style.borderRadius = "8px";
  floatingControls.style.boxShadow = "0 2px 8px #0002";
  floatingControls.style.padding = "4px";
  floatingControls.style.pointerEvents = "auto";
  floatingControls.innerHTML = `
    <button id="floatingZoomInBtn" style="padding:4px 12px; background:#ff6e21; color:#222; border:none; border-radius:4px; font-size:14px; cursor:pointer;">＋</button>
    <button id="floatingZoomOutBtn" style="padding:4px 12px; background:#ff6e21; color:#222; border:none; border-radius:4px; font-size:14px; cursor:pointer;">－</button>
    <button id="floatingZoomResetBtn" style="padding:4px 16px; background:#222; color:#fff; border:none; border-radius:4px; font-size:14px; cursor:pointer;">Reset</button>
  `;
  document.body.appendChild(floatingControls);

  // Both header and floating controls use same logic
  function zoomIn() {
    if (zoomLevel < maxZoom) {
      zoomLevel += zoomStep;
      applyZoom();
    }
  }
  function zoomOut() {
    if (zoomLevel > minZoom) {
      zoomLevel -= zoomStep;
      applyZoom();
    }
  }
  function zoomReset() {
    zoomLevel = 1;
    applyZoom();
  }

  // Wire up both sets of controls
  [plusBtn, document.getElementById("floatingZoomInBtn")].forEach(btn => btn && (btn.onclick = zoomIn));
  [minusBtn, document.getElementById("floatingZoomOutBtn")].forEach(btn => btn && (btn.onclick = zoomOut));
  [resetBtn, document.getElementById("floatingZoomResetBtn")].forEach(btn => btn && (btn.onclick = zoomReset));
});
</script>




<?php wp_footer(); ?>

</body>
</html>
