<?php
/**
 * Template Name: Join us-Template
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
// $page_id = get_the_ID();
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';

// Get the page ID
$page_id = get_the_ID();
 $join_hero_text = ($current_language === 'ar') ? get_post_meta($page_id, '_join_hero_title_field_ar', true) : get_post_meta($page_id, '_join_hero_title_field_en', true);
 $join_card_title1 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_title1_field_ar', true) : get_post_meta($page_id, '_join_card_title1_field_en', true);
 $join_card_desc1 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_desc1_field_ar', true) : get_post_meta($page_id, '_join_card_desc1_field_en', true);

 $join_card_title2 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_title2_field_ar', true) : get_post_meta($page_id, '_join_card_title2_field_en', true);
 $join_card_desc2 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_desc2_field_ar', true) : get_post_meta($page_id, '_join_card_desc2_field_en', true);

 $join_card_title3 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_title3_field_ar', true) : get_post_meta($page_id, '_join_card_title3_field_en', true);
 $join_card_desc3 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_card_desc3_field_ar', true) : get_post_meta($page_id, '_join_card_desc3_field_en', true);

 $join_video_title1 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_video_title1_field_ar', true) : get_post_meta($page_id, '_join_video_title1_field_en', true);
 $join_video_desc1 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_video_desc1_field_ar', true) : get_post_meta($page_id, '_join_video_desc1_field_en', true);

 $join_video_title2 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_video_title2_field_ar', true) : get_post_meta($page_id, '_join_video_title2_field_en', true);
 $join_video_desc2 = ($current_language === 'ar') ? get_post_meta($page_id, '_join_video_desc2_field_ar', true) : get_post_meta($page_id, '_join_video_desc2_field_en', true);

 // Get the video title and URL
 
 $join_video1_url = get_post_meta(get_the_ID(), '_join_video1_upload_field', true);
 $company_video1_url = get_post_meta(get_the_ID(), '_company_video1_upload_field', true);
  // banner
  $banners = get_option('banner_images', []);
 
 
  $join_hero_banner = null;

  foreach ($banners as $banner) {
     
      if ($banner['page'] === 'join-us' && $banner['position'] === 'hero') {
        $join_hero_banner = $banner['url'];
    }
  }
 
 
?>
   <section
      class="herosectionjoin position-relative"
      style="background-image: url(<?php if (!empty($join_hero_banner)) { echo esc_url($join_hero_banner); }?>"
    >
      <div class="container z-1 position-relative">
        <div
          class="main-section d-flex justify-content-center align-items-center"
        >
          <div class="main-section-text text-center py-5">
            <h1 class="fw-bold herotitle mb-0"><?php echo esc_html($join_hero_text); ?></h1>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row w-100 mx-auto justify-content-between joinCardRow">
          <div class="col-sm-3 bg-white joinCard">
            <div class="h-100">
              <h5 class="mb-4 fw-bold text-black"> <?php echo esc_html($join_card_title1); ?></h5>
              <p class="m-0 fs-24 text-dark-gray lh-sm">
                
                <?php echo esc_html($join_card_desc1); ?>
              </p>
            </div>
          </div>
          <div class="col-sm-3 bg-white joinCard">
            <div class="h-100">
              <h5 class="mb-4 fw-bold text-black"> <?php echo esc_html($join_card_title2); ?></h5>
              <p class="m-0 fs-24 text-dark-gray lh-sm">
                
                <?php echo esc_html($join_card_desc2); ?>
              </p>
            </div>
          </div>
          <div class="col-sm-3 bg-white joinCard">
            <div class="h-100">
              <h5 class="mb-4 fw-bold text-black">
                 <?php echo esc_html($join_card_title3); ?>
              </h5>
              <p class="m-0 fs-24 text-dark-gray lh-sm">
                
                <?php echo esc_html($join_card_desc3); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
 

    <section class="joinVidSec">
      <div class="container">
        <div class="row w-100 mx-auto align-items-center pb-5 mobcolRevrs">
          <div class="col-sm-7 p-0">
            <!-- <img
              src="<?php //echo get_template_directory_uri(); ?>/assets/images/creativeIntro.png"
              alt="creative intro"
              class="w-100"
            /> -->

            <div class="video-container" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/creativeIntro.png)">
             <!-- <video id="myVideo2" src="<?php //echo esc_html($company_video1_url); ?> " controls></video>
              <button class="play-button2" id="plybtn2" onclick="playVideo2()">
                <img
                src="<?php //echo get_template_directory_uri(); ?>/assets/images/play.png"
                alt="creative intro"
                class="w-100"
                />
              </button> -->

              <?php
            $video_url2 = get_post_meta(get_the_ID(), '_join_video_link2_field', true);

            // if (strpos($video_url2, 'youtu.be') !== false || strpos($video_url2, 'youtube.com') !== false) {
            //     // Convert to embed URL
            //     $embed_url2 = str_replace('watch?v=', 'embed/', str_replace('youtu.be/', 'www.youtube.com/embed/', $video_url2));
            //     echo '<iframe width="100%" height="414" src="' . esc_url($embed_url2) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            // } else {
            //     echo '<video controls style="width:100%;">
            //               <source src="' . esc_url($video_url2) . '" type="video/mp4">
            //               Your browser does not support the video tag.
            //           </video>';
            // }
            ?>
             <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/creativeIntro.png">
                <source src="<?php echo esc_url($video_url2) ?>" type="video/mp4">
            </video>
            </div>
          </div>
          <div class="col-sm-5 ps-sm-5 p-0">
            <div class="ps-sm-4 p-0">
              <h3 class="mb-2 fw-bold text-black">
                
                <?php echo esc_html($join_video_title1); ?>
              </h3>
              <p class="m-0 fs-24 text-dark-gray lh-sm">
             
                <?php //echo esc_html($join_video_desc1); ?>
              </p>
            </div>
          </div>
        </div>
        <div class="row w-100 mx-auto align-items-center pt-5 gap-sm-0 gap-4">
          <div class="col-sm-5 pe-sm-5 p-0">
            <div class="pe-sm-4 p-0">
              <h3 class="mb-2 fw-bold">  <?php echo esc_html($join_video_title2); ?></h3>
              <p class="m-0 fs-24 text-dark-gray lh-sm">
                  <?php //echo esc_html($join_video_desc2); ?>
              </p>
            </div>
          </div>
          
          <div class="col-sm-7 p-0">
            <!-- <img
              src="<?php //echo get_template_directory_uri(); ?>/assets/images/meetTeam.png"
              alt="creative intro"
              class="w-100"
            /> -->


             <div class="video-container" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/images/teamvid.png)">
              <?php
              // $video_url = get_post_meta(get_the_ID(), '_join_video_link1_field', true);?>

              <!-- <video id="myVideo" src="<?php //echo esc_url($video_url) ?>" controls></video> -->
  
              <!-- <button class="play-button" id="plybtn" onclick="playVideo()">
                <img
                src="<?php //echo get_template_directory_uri(); ?>/assets/images/play.png"
                alt="creative intro"
                class="w-100"
                />
              </button> -->
                <?php
                $video_url = get_post_meta(get_the_ID(), '_join_video_link1_field', true);

                // if (strpos($video_url, 'youtu.be') !== false || strpos($video_url, 'youtube.com') !== false) {
                //     // Convert to embed URL
                //     $embed_url = str_replace('watch?v=', 'embed/', str_replace('youtu.be/', 'www.youtube.com/embed/', $video_url));
                //     echo '<iframe width="100%" height="414" src="' . esc_url($embed_url) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                // } else {
                //     echo '<video controls style="width:100%;">
                //               <source src="' . esc_url($video_url) . '" type="video/mp4">
                //               Your browser does not support the video tag.
                //           </video>';
                // }
                ?>
                <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/meetTeam.png">
                  <source src="<?php echo esc_url($video_url) ?>" type="video/mp4">
                  
              </video>
            </div> 

          </div>
        </div>
      </div>
    </section>
  
    <section class="joinformSec bg-primary py-5">
      <div
        class="container d-flex flex-column justify-content-center align-items-center"
      >
        <div class="w-840">
          <h3 class="mb-4 fw-bold text-black text-center">
          <?php echo custom_translate('ready_to_Join'); ?>
          </h3>
          <p class="m-0 fs-24 text-black lh-sm text-center px-sm-5 mx-sm-5 mb-3">
          <?php echo custom_translate('join_our_team'); ?>
            <strong><?php echo custom_translate('apply_now'); ?></strong>
          </p>

          <!-- <div class="form-title mt-4 text-start d-flex">
            <div></div>
            <div>
              <span class="d-block text-dark-gray"><?php //echo custom_translate('how_to_apply'); ?></span>

              <span>
              <?php //echo custom_translate('fill_application'); ?>
                <a href="mailto:recruiting@zad-ksa.com"
                  >recruiting@zad-ksa.com</a
                ></span
              >
            </div>
          </div> -->
         
          <?php echo do_shortcode('[contact-form-7 id="e834dfb" title="join us form"]');?>
          <div class="privacy-policy text-white text-center ">
            <?php echo custom_translate('submittingPolicy'); ?>
          </div>
        </div>
      </div>
    </section>
<?php
get_footer(); 
?>