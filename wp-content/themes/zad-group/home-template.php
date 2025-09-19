<?php
/**
 * Template Name: Home-Template
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';

?>

  <?php if ( is_active_sidebar( 'below-sidebar2' ) ) : ?>
    <div id="secondary-below-sidebar" class="widget-area">
        <?php dynamic_sidebar( 'below-sidebar2' ); ?>
    </div>
  <?php endif; ?>
  <?php

?>




  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="introvideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="introvideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="introvideoLabel">Intro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- <video id="introVideoM" controls style="width:100%;" class="d-block">
            <source src="<?php //echo esc_url($intro_video_url); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video> -->
        <?php
          $video_introUrl = get_post_meta(get_the_ID(), '_join_video_homeintrolink_field', true);

          // if (strpos($video_introUrl, 'youtu.be') !== false || strpos($video_introUrl, 'youtube.com') !== false) {
          //     // Convert to embed URL
          //     $embed_url = str_replace('watch?v=', 'embed/', str_replace('youtu.be/', 'www.youtube.com/embed/', $video_introUrl));
          //     echo '<iframe width="100%" height="414" src="' . esc_url($embed_url) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
          // } else {
          //     echo '<video controls style="width:100%;">
          //               <source src="' . esc_url($video_introUrl) . '" type="video/mp4">
          //               Your browser does not support the video tag.
          //           </video>';
          // }
        ?>
      <video controls poster="<?php echo get_template_directory_uri(); ?>/assets/images/creativeIntro.png">
      <source src="<?php echo esc_url($video_introUrl) ?>" type="video/mp4">
      </video>
        </div>
        <div class="modal-footer">
         
          
        </div>
      </div>
    </div>
  </div>
  <section>
    <?php 
      $our_concept_small_text = ($current_language === 'ar') ? get_post_meta($page_id, '_our_concept_small_title_field_ar', true) : get_post_meta($page_id, '_our_concept_small_title_field_en', true);
      $our_concept_heading_text = ($current_language === 'ar') ? get_post_meta($page_id, '_our_concept_heading_field_ar', true) : get_post_meta($page_id, '_our_concept_heading_field_en', true);
      $our_concept_sub_heading_text = ($current_language === 'ar') ? get_post_meta($page_id, '_our_concept_sub_heading_field_ar', true) : get_post_meta($page_id, '_our_concept_sub_heading_field_en', true);
    ?>
    <div class="container py-5">
      <div class="text-center py-5">
        
        <h3 class=" text-yellow fw-bold"><?php echo esc_html( $our_concept_small_text); ?></h3>
        <p class="fs-4 text-black fw-bold"><?php echo esc_html($our_concept_heading_text); ?></p>

        <p class="fs-24 text-black mt-3 px-sm-5 mx-sm-5">
          <?php echo esc_html( $our_concept_sub_heading_text); ?>
        </p>
      </div>
    </div>
  </section>

  
  <section class="homeslider mb-5 pb-5">
    <div class="container">
      <?php 
      // Get the meta box data for the current page
      $slides = get_post_meta(get_the_ID(), 'homeslider1_slider_images', true);

      if (!empty($slides)) : ?>

      <div id="customSlider" class="carousel slide carousel-fade">
        <div class="carousel-inner">

        <?php
          $item_count = 0;
          foreach ($slides as $index => $slide) : 
        ?>
          <div class="carousel-item  <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="slider-content1 d-flex align-items-center" style="background-color: <?php echo isset($slide['color']) ? esc_attr($slide['color']) : '#ffffff'; ?>;">
              <div class="row w-100 mx-auto">
                <div class="col-sm-6 px-0">
                
                  <?php if (!empty($slide['image'])) : ?>
                    <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>"  class="slider-img w-100"/>
                  <?php endif; ?>
              
                </div>
                <?php if($index === 1){ ?>
                  <div class="col-sm-6 mobSliderCol">
                    <div class="sidebarrightText mt-sm-5 gap-sm-5">
                      <h2 class="text-white fw-bold m-0"><?php echo esc_html($current_language === 'ar' ? $slide['title_ar'] : $slide['title'] ); ?></h2>

                      <div class="d-flex justify-content-between gap-3">
                        <div class="w-50">
                          <h5 class="text-white fw-bold"> <?php echo esc_html( $slide['orders'] ); ?></h5>
                          <p class="m-0 fs-20 text-white"><?php echo esc_html( $current_language === 'ar' ? $slide['per_week_ar'] : $slide['per_week']); ?></p>
                        </div>
                        <div class="w-50">
                          <h5 class="text-white fw-bold"><?php echo esc_html( $current_language === 'ar' ? $slide['ice_cream_orders_ar'] : $slide['ice_cream_orders'] ); ?></h5>
                          <p class="m-0 fs-20 text-white">
                          <?php echo esc_html( $current_language === 'ar' ? $slide['ice_cream_per_year_ar'] : $slide['ice_cream_per_year']); ?>
                          </p>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between gap-3">
                        <div class="w-50">
                          <h5 class="text-white fw-bold"><?php echo esc_html( $slide['stores'] ); ?></h5>
                          <p class="m-0 fs-20 text-white">
                          <?php echo esc_html( $current_language === 'ar' ? $slide['stores_desc_ar'] : $slide['stores_desc']); ?>
                          </p>
                        </div>
                        <div class="w-50">
                          <h5 class="text-white fw-bold"><?php echo esc_html( $current_language === 'ar' ? $slide['cake_orders_ar'] : $slide['cake_orders']); ?></h5>
                          <p class="m-0 fs-20 text-white">
                          <?php echo esc_html( $current_language === 'ar' ? $slide['cake_per_year_ar'] : $slide['cake_per_year']); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } else if($index === 2) {?>
                  <div class="col-sm-6 mobSliderCol">
                    <div class="sidebarrightText mt-3">
                         <?php if (!empty($slide['single_image'])) : ?>
                        <div class="slide-single-image">
                            <img src="<?php echo esc_url($slide['single_image']); ?>" alt="<?php echo esc_attr($slide['title']); ?> - Single Image" class="w-100" style='height: 106px;object-fit: contain;'>
                        </div>
                      <?php endif; ?>
                      <?php if (!empty($slide['title'] || $slide['title_ar'])) : ?>
                      <h2 class="text-white fw-bold m-0">
                      <?php endif; ?>
                      <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?>
                      </h2>
                      <p class="m-0 fs-24 text-white fw-bold">
                      <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                      </p>
                      <p class="m-0 fs-24 text-white">
                      <?php echo esc_html($current_language === 'ar' ? $slide['sub_description_ar'] : $slide['sub_description']); ?>
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Display Button if available -->
                          <?php if (!empty($slide['button_link'])) { ?>
                            <a href="<?php echo esc_url($slide['button_link']); ?>">
                              <button class="btn fs-20 text-white visitSiteBtn lh-sm rounded-3">
                                <?php echo esc_html($current_language === 'ar' ? $slide['button_text_ar'] : $slide['button_text'] ); ?>
                              </button>
                            </a>
                          <?php } ?>
                          
                        </div>
                        <div class="fs-20 text-white">
                          
                          <?php if (!empty($slide['instagram_link'])) { ?>
                              <a href="<?php echo esc_url($slide['instagram_link']); ?>" class="text-white text-decoration-none instabtn" target="_blank">
                              <i class="bi bi-instagram me-2"></i
                              ><?php echo custom_translate('instamarble'); ?>
                              </a>
                          <?php } ?>

                        </div>
                        <div class="fs-20 text-white">
                          <a href="https://www.tiktok.com/@marbleslabksa" class="text-white text-decoration-none instabtn" target="_blank">
                          <i class="bi bi-tiktok me-2"></i
                          ><?php echo custom_translate('tiktokmarble'); ?>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <?php } else if($index === 3) {?>
                  <div class="col-sm-6 mobSliderCol">
                    <div class="sidebarrightText mt-3">
                      <h2 class="text-white fw-bold m-0">
                      <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?>
                      </h2>
                      <p class="m-0 fs-24 text-white fw-bold">
                      <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                      </p>
                      <p class="m-0 fs-24 text-white">
                      <?php echo esc_html($current_language === 'ar' ? $slide['sub_description_ar'] : $slide['sub_description']); ?>
                      </p>
                      <div class="d-flex gap-5 align-items-center">
                        <div>
                            <!-- Display Button if available -->
                          <?php if (!empty($slide['button_link'])) { ?>
                            <a href="<?php echo esc_url($slide['button_link']); ?>"  >
                              <button class="btn fs-20 text-white visitSiteBtn lh-sm rounded-3">
                                <?php echo esc_html($current_language === 'ar' ? $slide['button_text_ar'] : $slide['button_text'] ); ?>
                              </button>
                            </a>
                          <?php } ?>
                          
                        </div>
                        
                        
                      </div>
                    </div>
                  </div>
                <?php } else { ?>
                  <div class="col-sm-6 mobSliderCol">
                    <div class="sidebarrightText">
                      
                      <?php if (!empty($slide['single_image'])) : ?>
                        <div class="slide-single-image">
                            <img src="<?php echo esc_url($slide['single_image']); ?>" alt="<?php echo esc_attr($slide['title']); ?> - Single Image" class="w-100">
                        </div>
                      <?php endif; ?>
            
                      <h3 class="text-white fw-bold m-0">
                        <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?>
                      </h3>
                      <p class="m-0 fs-24 text-white">
                        <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                      </p>
                    
                    </div>
                  </div>
                <?php }?>
              </div>
            </div>
          </div>
          <?php endforeach; 
            $item_count++;?>
          <!-- Add more carousel items here if needed -->
        </div>

        <!-- Carousel controls -->
        <div class="row w-100 mx-auto controlrow">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <div class="controlss">
              <div class="sliderbsControl">
                <button
                  class="carousel-control-prev"
                  type="button"
                  data-bs-target="#customSlider"
                  data-bs-slide="prev"
                >
                  <span class="">
                    <i class="bi bi-chevron-left"></i>
                  </span>
                </button>
                <button
                  class="carousel-control-next"
                  type="button"
                  data-bs-target="#customSlider"
                  data-bs-slide="next"
                >
                  <span class=""><i class="bi bi-chevron-right"></i></span>
                </button>
              </div>
              <div class="dotsbtn">
                <div class="carousel-indicators">
                <?php foreach ($slides as $index => $slide) : ?>
                  <button
                    type="button"
                    data-bs-target="#customSlider"
                    data-bs-slide-to="<?php echo $index; ?>"
                    class="<?php echo $index === 0 ? 'active' : ''; ?>"
                    aria-current="true"
                    aria-label="Slide 1"
                  ></button>
                <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <section class="homeslider2 my-5 py-5">
    <div class="container">
    <?php 
      // Get the meta box data for the current page
      $slides2 = get_post_meta(get_the_ID(), 'homeSlider2_slider_images', true);

      if (!empty($slides2)) : ?>
      <div id="customSlider2" class="carousel slide carousel-fade">
        <div class="carousel-inner">
        <?php
          $item_count2 = 0;
          foreach ($slides2 as $index => $slide) : 
        ?>
          <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
            <div class="slider-content1 d-flex align-items-center" style="background-color: <?php echo isset($slide['color']) ? esc_attr($slide['color']) : '#ffffff'; ?>;">
              <div class="row w-100 mx-auto secondSlide">
                <div class="col-sm-6 px-0">
                  <?php if (!empty($slide['image'])) : ?>
                    <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>"  class="slider-img w-100"/>
                  <?php endif; ?>
                </div>
                <?php if($index === 1){ ?>
                  <div class="col-sm-6 mobSliderCol">
                  <div class="sidebarrightText mt-sm-5 gap-sm-5">
                    <h2 class="text-white fw-bold m-0">
                    <?php //echo custom_translate('not_only_restaurant'); ?>
                    <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?>
                    </h2>
                    <p class="m-0 fs-20 text-white pe-5">
                    <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                    </p>
                    <div
                      class="d-flex align-items-center  gap-3"
                    >
                    <div>
                      <h5 class="m-0 text-white fw-bold"> <?php echo esc_html( $slide['dishes'] ); ?></h5>
                      <p class="text-white fs-6 m-0">
                      <?php echo esc_html($current_language === 'ar' ? $slide['dish_title_ar'] : $slide['dish_title']); ?>
                      </p>
                      </div>
                      <div>
                        <h5 class="m-0 text-white fw-bold"><?php echo esc_html( $slide['event'] ); ?></h5>
                        <p class="text-white fs-6 m-0"> <?php echo esc_html($current_language === 'ar' ? $slide['event_text_ar'] : $slide['event_text']); ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } else if($index === 2) {?>
                  <div class="col-sm-6 mobSliderCol">
                  <div class="sidebarrightText mt-3">
                    <h2 class="text-white fw-bold m-0">    <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?></h2>
                    <p class="m-0 fs-24 text-white">
                      <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                    </p>

                    <div class="d-flex gap-sm-5 gap-3">
                      <div class="w-50">
                        <h5 class="text-white m-0 fw-bold">
                            <!-- <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/Rating46.png" />  -->
                            <?php echo esc_html($current_language === 'ar' ? $slide['rating_ar'] : $slide['rating']); ?>
                        </h5>
                        <p class="m-0 fs-20 text-white">
                        <?php echo esc_html($current_language === 'ar' ? $slide['rating_desc_ar'] : $slide['rating_desc']); ?>
                        </p>
                      </div>
                      <div class="w-50">
                        <h5 class="text-white fw-bold"><?php echo esc_html($current_language === 'ar' ? $slide['review_ar'] : $slide['review']); ?></h5>
                        <p class="m-0 fs-20 text-white"><?php echo esc_html($current_language === 'ar' ? $slide['review_desc_ar'] : $slide['review_desc']); ?></p>
                      </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="w-50 w-ar-35">
                        <?php if (!empty($slide['button_link'])) { ?>
                          <a href="<?php echo esc_url($slide['button_link']); ?>"  >
                            <button class="btn fs-20 text-white visitSiteBtn lh-sm rounded-3">
                              <?php echo esc_html($current_language === 'ar' ? $slide['button_text_ar'] : $slide['button_text'] ); ?>
                            </button>
                          </a>
                        <?php } ?>
                      </div>
                      <div class="fs-20 text-white w-50 w-ar-35">
                        <?php if (!empty($slide['instagram_link'])) { ?>
                          <a href="<?php echo esc_url($slide['instagram_link']); ?>" class="text-white text-decoration-none instabtn" target="_blank">
                          <i class="bi bi-instagram me-2"></i
                          ><?php echo custom_translate('instameez'); ?>
                          </a>
                        <?php } ?>
                      </div>

                      <div class="fs-20 text-white">
                        <a href="https://www.tiktok.com/@meezstreet" class="text-white text-decoration-none instabtn d-flex" target="_blank">
                        <i class="bi bi-tiktok me-2"></i
                        ><?php echo custom_translate('tiktokmeez'); ?>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                  <div class="col-sm-6 mobSliderCol">
                  <div class="sidebarrightText pe-3">
                    <?php if (!empty($slide['single_image'])) : ?>
                    <img
                      src="<?php echo esc_url($slide['single_image']); ?>"
                      alt="logobanner"
                      class="logobanner2"
                    />
                    <?php endif; ?>
                    <h2 class="text-white fw-bold m-0"> <?php echo esc_html( $current_language === 'ar' ? $slide['title_ar'] : $slide['title']); ?></h2>
                    <p class="m-0 fs-24 text-white">
                    <?php echo esc_html($current_language === 'ar' ? $slide['description_ar'] : $slide['description']); ?>
                    </p>
                    <div class="d-flex gap-3 align-items-center">
                      <!-- <h5 class="m-0 text-white fw-bold">85</h5>
                      <p class="text-white fs-6 m-0">
                        Unique Dishes, Fresh from Our Kitchen to Your Table.
                      </p> -->
                    </div>
                  </div>
                </div>
                <?php }?>
                
              </div>
            </div>
          </div>
          <?php endforeach; 
            $item_count2++;?>
          <!-- <div class="carousel-item">
            <div class="slider-content2 d-flex align-items-center">
              <div class="row w-100 mx-auto secondSlide">
                <div class="col-sm-6 px-0">
                  <img
                    src="<?php //echo get_template_directory_uri(); ?>/assets/images/slide2-2.png"
                    alt="Ice Cream"
                    class="slider-img w-100"
                  />
                </div>
                <div class="col-sm-6 mobSliderCol">
                  <div class="sidebarrightText mt-sm-5 gap-sm-5">
                    <h2 class="text-white fw-bold m-0">
                    <?php echo custom_translate('not_only_restaurant'); ?>
                    </h2>
                    <p class="m-0 fs-20 text-white pe-5">
                    <?php echo custom_translate('not_only_resaourant_desc'); ?>
                    </p>
                    <div
                      class="d-flex align-items-center  gap-3"
                    >
                    <div>
                      <h5 class="m-0 text-white fw-bold">85</h5>
                      <p class="text-white fs-6 m-0">
                      <?php echo custom_translate('unique_dishes'); ?>
                      </p>
                      </div>
                      <div>
                        <h5 class="m-0 text-white fw-bold">47</h5>
                        <p class="text-white fs-6 m-0"><?php echo custom_translate('events_per_month'); ?></p>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- <div class="carousel-item">
            <div class="slider-content3 d-flex align-items-center">
              <div class="row w-100 mx-auto secondSlide">
                <div class="col-sm-6 px-0">
                  <img
                    src="<?php //echo get_template_directory_uri(); ?>/assets/images/slide2-3.png"
                    alt="Ice Cream"
                    class="slider-img w-100"
                  />
                </div>
                <div class="col-sm-6 mobSliderCol">
                  <div class="sidebarrightText mt-3">
                    <h2 class="text-white fw-bold m-0"><?php //echo custom_translate('excellent_choice'); ?></h2>
                    <p class="m-0 fs-24 text-white">
                    <?php //echo custom_translate('excellent_choice_desc'); ?>
                    </p>

                    <div class="d-flex gap-sm-5 gap-3">
                      <div class="w-50">
                        <h5 class="text-white m-0 fw-bold">
                            <img src="<?php //echo get_template_directory_uri(); ?>/assets/images/Rating46.png" /> 
                          4,3-4,7
                        </h5>
                        <p class="m-0 fs-20 text-white">
                        <?php //echo custom_translate('stars_rating_google'); ?>
                        </p>
                      </div>
                      <div class="w-50">
                        <h5 class="text-white fw-bold"><?php //echo custom_translate('10_k+'); ?></h5>
                        <p class="m-0 fs-20 text-white"><?php //echo custom_translate('reviews_left'); ?></p>
                      </div>
                    </div>
                    <div class="d-flex gap-sm-5 gap-3 align-items-center">
                      <div class="w-50">
                        <a href="https://www.marblestore.sa/">
                          <button
                            class="btn fs-20 text-white visitSiteBtn lh-sm rounded-3"
                          >
                          <?php //echo custom_translate('visit_our_website'); ?>
                          </button>
                        </a>
                      </div>
                      <div class="fs-20 text-white w-50">
                        <a
                          href="https://www.instagram.com/marbleslabksa/"
                          class="text-white text-decoration-none instabtn"
                          ><i class="bi bi-instagram me-2"></i
                          >marbleslabksa</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- Add more carousel items here if needed -->
        </div>

        <!-- Carousel controls -->
        <div class="row w-100 mx-auto controlrow">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <div class="controlss">
              <div class="sliderbsControl">
                <button
                  class="carousel-control-prev"
                  type="button"
                  data-bs-target="#customSlider2"
                  data-bs-slide="prev"
                >
                  <!-- <span
                    class="carousel-control-prev-icon"
                    aria-hidden="true"
                  ></span> -->
                  <span class=""><i class="bi bi-chevron-left"></i></span>
                </button>
                <button
                  class="carousel-control-next"
                  type="button"
                  data-bs-target="#customSlider2"
                  data-bs-slide="next"
                >
                  <!-- <span
                    class="carousel-control-next-icon"
                    aria-hidden="true"
                  ></span> -->
                  <span class=""><i class="bi bi-chevron-right"></i></span>
                </button>
              </div>
              <div class="dotsbtn">
                <div class="carousel-indicators">
                  
                  <?php foreach ($slides2 as $index => $slide) : ?>
                    <button
                      type="button"
                      data-bs-target="#customSlider2"
                      data-bs-slide-to="<?php echo $index; ?>"
                      class="<?php echo $index === 0 ? 'active' : ''; ?>"
                      aria-current="true"
                      aria-label="Slide 1"
                    ></button>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>
  <section class="bg-dark-gray py-2 pt-4 mt-5" >
    <div class="container py-1">
      <div class="row w-100 mx-auto justify-content-between">
        <div class="col-sm-4">
          <div>
            <i class="bi bi-envelope-arrow-up-fill fs-2 text-yellow"></i>
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
            <p class="form-text text-center fs-14 text-dark-gray mt-3">
               <?php echo custom_translate('submittingPolicy'); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
<?php
get_footer(); 
?>