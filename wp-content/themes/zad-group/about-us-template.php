<?php
/**
 * Template Name: About-us-Template
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
global $current_language;
$current_language = !empty($current_language) ? $current_language : 'en';
$lang = $current_language;
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

  // The dedicated About image is now used as the full-width top banner.
  // Existing banner-manager content remains the fallback, so no migration is
  // required on sites that have not filled the dedicated field yet.
  $about_top_banner = get_post_meta($page_id, '_about_hero_background_image', true);

  foreach ($banners as $banner) {
     
      if ($banner['page'] === 'about' && $banner['position'] === 'bottom') {
          $about_bottom_banner = $banner['url'];
      }
      
  }

  if (empty($about_top_banner)) {
      $about_top_banner = !empty($about_bottom_banner)
          ? $about_bottom_banner
          : get_template_directory_uri() . '/assets/images/cornerBannerimg.png';
  }

?>


  <section class="about-full-banner position-relative">
    <img
      src="<?php echo esc_url($about_top_banner); ?>"
      alt="<?php echo esc_attr(get_the_title()); ?>"
      class="about-full-banner__image"
    />
    <div class="about-full-banner__overlay">
      <h1 class="text-center text-black fw-bold cornerimgText">
        <?php echo esc_html(custom_translate('from_all_passion')); ?><br />
        <span class="text-primary"><?php echo esc_html(custom_translate('be_part_our_story')); ?></span>
      </h1>
    </div>
  </section>

<?php if ( is_active_sidebar( 'below-sidebar' ) ) : ?>

    <div id="secondary-below-sidebar" class="widget-area about-mission-cards">
        <?php dynamic_sidebar( 'below-sidebar' ); ?>
    </div><!-- #secondary-below-sidebar -->
<?php endif; ?>

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
          <div class="swiper mySwiper history-main-swiper" aria-label="<?php echo esc_attr($our_history_small_title_field_content); ?>">
            <div class="swiper-wrapper history-main-wrapper">
            <?php foreach ($slides as $slide) :
              // Backward compatibility: move the old single image into the new
              // images array at render time without requiring a data migration.
              $history_images = [];
              if (!empty($slide['images']) && is_array($slide['images'])) {
                  $history_images = array_values(array_filter($slide['images']));
              }
              if (!empty($slide['image']) && !in_array($slide['image'], $history_images, true)) {
                  array_unshift($history_images, $slide['image']);
              }

              $history_title = ($current_language === 'ar' && !empty($slide['title_ar']))
                  ? $slide['title_ar']
                  : ($slide['title'] ?? '');
            ?>
              <div class="swiper-slide history-card-slide" style="--history-image-count: <?php echo max(1, count($history_images)); ?>;">
                <article class="history-card">
                  <div class="history-year-rail">
                    <h1 class="m-0 text-primary text-center"><?php echo esc_html($slide['year']); ?></h1>
                  </div>

                  <div class="history-card-body">
                    <?php if (!empty($history_images)) : ?>
                      <div class="history-images-row" aria-label="<?php echo esc_attr($history_title); ?>">
                        <?php foreach ($history_images as $history_image) : ?>
                          <figure class="history-image-tile">
                            <img
                              src="<?php echo esc_url($history_image); ?>"
                              alt="<?php echo esc_attr($history_title); ?>"
                              class="timeimag"
                              loading="lazy"
                            />
                          </figure>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>

                    <div class="content history-card-content">
                      <h4 class="text-white fw-bold fs-24"><?php echo esc_html($history_title); ?></h4>
                      <p class="text-white fs-18">
                        <?php
                          $history_description = ($current_language === 'ar' && !empty($slide['description_ar']))
                              ? $slide['description_ar']
                              : ($slide['description'] ?? '');
                          echo esc_html($history_description);
                        ?>
                      </p>
                    </div>
                  </div>
                </article>
              </div>
              <?php endforeach; ?>
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
