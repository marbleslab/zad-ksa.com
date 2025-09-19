<?php
/**
 * Template Name: Franchise Page
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';
 // banner
$banners = get_option('banner_images', []);
$franchise_rows = get_post_meta(get_the_ID(), 'franchise_rows', true);
$franchise_title = get_post_meta(get_the_ID(), '_franchise_title', true);
$franchise_desc = get_post_meta(get_the_ID(), '_franchise_desc', true);
$franchise_title_ar = get_post_meta(get_the_ID(), '_franchise_title_ar', true);
$franchise_desc_ar = get_post_meta(get_the_ID(), '_franchise_desc_ar', true);
 
 $franchise_banner = null;

 foreach ($banners as $banner) {
    
     if ($banner['page'] === 'franchise' && $banner['position'] === 'hero') {
       $franchise_hero_banner = $banner['url'];
   }
 }
?>


<section class=" position-relative">
  <img class="w-100" src="<?php echo  $franchise_hero_banner ?>" alt="">
  <div class="container z-1 position-relative">
    <div
      class="main-section d-flex justify-content-center align-items-center"
    >
    <?php 
      // Display the title and description if they exist
      if (!empty($franchise_title) || !empty($franchise_desc)) {
        ?>
        <div class="main-section-text text-center  py-5">
       
        <?php if (!empty($franchise_title)): ?>
                <h2 class="fw-bold mb-0"><?php echo esc_html(($current_language === 'ar') ? $franchise_title_ar : $franchise_title ); ?></h2>
            <?php endif; ?>
        
        <?php if (!empty($franchise_desc)): ?>
                <p class="m-0 fs-21 text-dark lh-sm pt-3"><?php echo esc_textarea(($current_language === 'ar') ? $franchise_desc_ar : $franchise_desc); ?></p>
            <?php endif; ?>
      </div>
        
        <?php
      }
    ?>
      
    </div>
  </div>
</section>
<section>
  <div class="container">
  <?php

if (!empty($franchise_rows) && is_array($franchise_rows)) {
    foreach ($franchise_rows as $index => $row) {
        // Add 'row-reverse-column' class for every second row
        $row_class = ($index % 2 === 1) ? 'flex-sm-row-reverse   ' : ''; 
        ?>
        <div class="row w-100 mx-auto justify-content-between bg-white franchisecard <?php echo esc_attr($row_class); ?>">
           
            <div class="col-sm-6">
                <div class="h-100 <?php if ($index === 0) {
                      echo ''; // No class for index 0
                  } elseif ($index === 1) {
                      echo 'w-450'; // Add 'w-450' for index 1
                  } elseif (in_array($index, [2, 3])) {
                      echo 'w-400'; // Add 'w-400' for index 2 and 3
                  }  ?>
                ">
                    <h5 class="fs-mb-25 fw-bold text-black lh-sm text-capitalize"> 
                      <?php echo esc_html(($current_language === 'ar') ? $row['title_ar']  : $row['title']); ?>
                    </h5>
                    <p class="m-0 fs-21 text-dark-gray lh-sm">
                      <?php echo esc_textarea(($current_language === 'ar') ? $row['description_ar'] :  $row['description']); ?>
                    </p>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="imagediv">
                    <?php if (!empty($row['image'])): ?>
                        <img class="w-100" src="<?php echo esc_url($row['image']); ?>" alt="Franchise Image">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }
}
?>

  </div>
</section>
 
<section class="joinformSec bg-primary py-5 mt-3">
   

  <!-- Swiper JS -->


  <!-- Initialize Swiper -->

    <div
      class="container d-flex flex-column justify-content-center align-items-center"
    >
      <div class="w-840 franchiseform">
        <h3 class="mb-4 fw-bold text-black text-center">
        <?php echo custom_translate('add_information'); ?>
        </h3>
        
        <?php echo do_shortcode('[contact-form-7 id="3f196c4" title="franchise form"]');?>
        
      </div>
    </div>
</section>
<?php
get_footer(); 
?>
