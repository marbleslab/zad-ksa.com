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

  // The About hero can now use a dedicated full-width background image.
  // Keep the bundled artwork as a safe fallback for existing installations.
  $about_hero_background = get_post_meta($page_id, '_about_hero_background_image', true);
  $about_hero_has_custom_background = !empty($about_hero_background);
  if (empty($about_hero_background)) {
      $about_hero_background = get_template_directory_uri() . '/assets/images/aboutHeroImg.png';
  }

  foreach ($banners as $banner) {
     
      if ($banner['page'] === 'about' && $banner['position'] === 'bottom') {
          $about_bottom_banner = $banner['url'];
      }
      
  }

?>


<?php if ( is_active_sidebar( 'below-sidebar' ) ) : ?>

    <div
      id="secondary-below-sidebar"
      class="widget-area<?php echo $about_hero_has_custom_background ? ' has-custom-about-hero-background' : ''; ?>"
      style="--about-hero-background-image: url('<?php echo esc_url($about_hero_background); ?>');"
    >
        <?php dynamic_sidebar( 'below-sidebar' ); ?>
    </div><!-- #secondary-below-sidebar -->
<?php endif; ?>


  <section class="position-relative">
    <h1 class="text-center text-black fw-bold cornerimgText">
    <?php echo custom_translate('from_all_passion'); ?><br />
      <span class="text-primary"><?php echo custom_translate('be_part_our_story'); ?></span>
    </h1>
    <img src="<?php if (!empty($about_bottom_banner)) { echo esc_url($about_bottom_banner); }?>" alt="" class="w-100" />
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
          <div class="swiper mySwiper pt-5" aria-label="<?php echo esc_attr($our_history_small_title_field_content); ?>">
            <div class="timslideControl border-top border-color-orange">
              <div class="container position-relative">
                <button type="button" class="swiper-button-next history-main-next arrow" aria-label="<?php esc_attr_e('Next history item', 'zag-group'); ?>">
                  <i class="bi bi-arrow-right"></i>
                </button>
                <button type="button" class="swiper-button-prev history-main-prev arrow" aria-label="<?php esc_attr_e('Previous history item', 'zag-group'); ?>">
                  <i class="bi bi-arrow-left"></i>
                </button>
              </div>
            </div>
            <div class="swiper-wrapper container p-0">
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
              <div class="swiper-slide">
                <div
                  class="row pt-5 align-items-center justify-content-center w-100 mx-auto"
                >
                  <div class="col-3 yearline px-0">
                    <h1 class="m-0 text-primary text-center"><?php echo esc_html($slide['year']); ?></h1>
                  </div>
                  <div class="col-sm-6 col-8 px-0">
                    <?php if (!empty($history_images)) : ?>
                      <div class="swiper historyImageSwiper">
                        <div class="swiper-wrapper">
                          <?php foreach ($history_images as $history_image) : ?>
                            <div class="swiper-slide">
                              <img
                                src="<?php echo esc_url($history_image); ?>"
                                alt="<?php echo esc_attr($history_title); ?>"
                                class="d-block timeimag"
                                loading="lazy"
                              />
                            </div>
                          <?php endforeach; ?>
                        </div>

                        <?php if (count($history_images) > 1) : ?>
                          <button type="button" class="history-image-nav history-image-prev" aria-label="<?php esc_attr_e('Previous image', 'zag-group'); ?>">
                            <i class="bi bi-chevron-left"></i>
                          </button>
                          <button type="button" class="history-image-nav history-image-next" aria-label="<?php esc_attr_e('Next image', 'zag-group'); ?>">
                            <i class="bi bi-chevron-right"></i>
                          </button>
                          <div class="swiper-pagination history-image-pagination"></div>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-sm-4 col-3"></div>
                  <div class="col-sm-6 col-8 ps-0">
                    <div class="content pt-3">
                      <h4 class="text-white fw-bold fs-24"> <?php echo esc_html($history_title); ?></h4>
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
                </div>
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
