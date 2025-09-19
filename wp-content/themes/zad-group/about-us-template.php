<?php
/**
 * Template Name: About-us-Template
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';
  $page_id = get_the_ID();
  

  // Fetch translations
  $mission_small_title_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_small_title_field_ar', true) : get_post_meta($page_id, '_mission_small_title_field_en', true);
  $mission_heading_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_heading_field_ar', true) : get_post_meta($page_id, '_mission_heading_field_en', true);
  $mission_sub_heading_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_sub_heading_field_ar', true) : get_post_meta($page_id, '_mission_sub_heading_field_en', true);

  // our people section
  $people_small_title_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_small_title_field_ar', true) : get_post_meta($page_id, '_people_small_title_field_en', true);
  $people_heading_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_heading_field_ar', true) : get_post_meta($page_id, '_people_heading_field_en', true);
  $people_sub_heading_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_sub_heading_field_ar', true) : get_post_meta($page_id, '_people_sub_heading_field_en', true);
  

  // our hsitory
  $our_history_small_title_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_our_history_small_title_field_ar', true) : get_post_meta($page_id, '_our_history_small_title_field_en', true);
  $timeline_title_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_timeline_title_field_ar', true) : get_post_meta($page_id, '_timeline_title_field_en', true);

  // banner
  $banners = get_option('banner_images', []);
 
  $about_bottom_banner = null;

  foreach ($banners as $banner) {
     
      if ($banner['page'] === 'about' && $banner['position'] === 'bottom') {
          $about_bottom_banner = $banner['url'];
      }
      
  }

?>


<?php if ( is_active_sidebar( 'below-sidebar' ) ) : ?>

    <div id="secondary-below-sidebar" class="widget-area">
        <?php dynamic_sidebar( 'below-sidebar' ); ?>
    </div><!-- #secondary-below-sidebar -->
<?php endif; ?>


  <section class="position-relative">
    <h1 class="text-center text-black fw-bold cornerimgText">
    <?php echo custom_translate('from_all_passion'); ?><br />
      <span class="text-primary"><?php echo custom_translate('be_part_our_story'); ?></span>
    </h1>
    <img src="<?php if (!empty($about_bottom_banner)) { echo esc_url($about_bottom_banner); }?>" alt="" class="w-100" />

    <div class="container position-relative">
      <div class="joinimgbtn">
        <a href="<?php echo esc_url( home_url( '/join-us' ) ); ?>"
          ><img src="<?php echo get_template_directory_uri(); ?>/assets/images/joinnowimg.png" alt="" class=""
        /></a>
      </div>
    </div>
  </section>
  <section class="timeline-slider bg-black py-5">
    <div class="container text-center pb-4 pt-5">
      <p class="text-yellow fs-5 fw-bold"> <?php echo esc_html( $our_history_small_title_field_content); ?></p>
      <h3 class="m-0 text-white"> <?php echo esc_html( $timeline_title_field_content); ?></h3>
    </div>
    <div class="orangbar pb-4">
      <?php
        // Get the meta box data for the current page
        $slides = get_post_meta(get_the_ID(), 'timeline_slider_images', true);
        if (!empty($slides)) : ?>
          <div class="swiper mySwiper pt-5">
            <div class="timslideControl border-top border-color-orange">
              <div class="container position-relative">
                <div class="swiper-button-next arrow">
                  <i class="bi bi-arrow-right"></i>
                </div>
                <div class="swiper-button-prev arrow">
                  <i class="bi bi-arrow-left"></i>
                </div>
              </div>
            </div>
            <div class="swiper-wrapper container p-0">
            <?php foreach ($slides as $slide) : ?>
              <div class="swiper-slide">
                <div
                  class="row pt-5 align-items-center justify-content-center w-100 mx-auto"
                >
                  <div class="col-3 yearline px-0">
                    <h1 class="m-0 text-primary text-center"><?php echo esc_html($slide['year']); ?></h1>
                  </div>
                  <div class="col-sm-6 col-8 px-0">
                  
                    <?php if (!empty($slide['image'])) : ?>
                        <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>"  class="d-block timeimag"/>
                    <?php endif; ?>
                  </div>
                  <div class="col-sm-4 col-3"></div>
                  <div class="col-sm-6 col-8 ps-0">
                    <div class="content pt-3">
                      <h4 class="text-white fw-bold fs-24"> <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?></h4>
                      <p class="text-white fs-18">
                      
                      <?php echo esc_html( $current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            
              <div class="swiper-slide"></div>
            </div>
          </div>
      <?php endif; ?>
    </div>
  </section>
 <!-- Modal -->
 <div class="modal fade" id="introvideo2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="introvideo2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="introvideo2Label">Intro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- <video id="introVideoM" controls style="width:100%;" class="d-block">
              <source src="<?php //echo esc_url($intro_video_url); ?>" type="video/mp4">
              Your browser does not support the video tag.
          </video> -->
          <?php
            $video_introUrl2 = get_post_meta(get_the_ID(), '_join_video_aboutintrolink_field', true);

            // if (strpos($video_introUrl2, 'youtu.be') !== false || strpos($video_introUrl2, 'youtube.com') !== false) {
            //     // Convert to embed URL
            //     $embed_homeurl2 = str_replace('watch?v=', 'embed/', str_replace('youtu.be/', 'www.youtube.com/embed/', $video_introUrl2));
            //     echo '<iframe width="100%" height="414" src="' . esc_url($embed_homeurl2) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            // } else {
            //     echo '<video controls style="width:100%;">
            //               <source src="' . esc_url($video_introUrl2) . '" type="video/mp4">
            //               Your browser does not support the video tag.
            //           </video>';
            // }
          ?>
          <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/creativeIntro.png">
            <source src="<?php if (!empty($video_introUrl2)) { echo esc_url($video_introUrl2);} ?>" type="video/mp4">
            
          </video>
        </div>
        <div class="modal-footer">
          <button type="button" id="closevidModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>

<?php
get_footer(); 
?>