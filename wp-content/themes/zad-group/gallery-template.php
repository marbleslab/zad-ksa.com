<?php
/**
 * Template Name: Gallery-Template
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';
$page_id = get_the_ID();
?>
  <section class="gallery-parent">
    <div class="container">
        <div class="py-4">
            <h3 class="text-center text-black fw-bold"><?php echo custom_translate('our_life_photos'); ?></h3>
        </div>
        <?php
          // Query 'gallery_item' custom post type

          $args = array(
              'post_type' => 'gallery_item',
              'posts_per_page' => -1,
              'order' => 'DESC',
              'orderby' => 'date'
          );
          $gallery_query = new WP_Query($args);

            if ($gallery_query->have_posts()) {
              echo '<div class="row w-100 mx-auto gallerRow1">';

                $item_count = 0; // Counter to track the number of items

                while ($gallery_query->have_posts()) {
                  $gallery_query->the_post();
                  $gallery_images = get_post_meta(get_the_ID(), 'gallery_images', true);
                  
                    if (!empty($gallery_images)) {
                      $cover_image_url = esc_url($gallery_images[0]['url']);
                      $arabic_title = get_post_meta(get_the_ID(), 'arabic_title', true);
                      if ($item_count  == 0) {
                          // First image to display in col-sm-8
                          ?>
                          <div class="col-sm-8">
                              <div class="gallaryimagebox" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                  data-title="<?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title(); ?>"
                                  data-images='<?php echo wp_json_encode(array_column($gallery_images, 'url')); ?>'>
                                  <img src="<?php echo $cover_image_url; ?>" alt="<?php the_title(); ?>" class="w-100" />
                                  <!-- <h2 class="galleryText text-white fw-semibold"><?php //the_title(); ?></h2> -->
                                  
                                    <h2 class="arabic-title galleryText text-white fw-semibold"> <?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title();?></h2>
                                  
                              </div>
                          </div>
                          <?php
                      } elseif ($item_count == 1 || $item_count == 2) {
                          // Second and third images to display in col-sm-4
                          if ($item_count === 1) {
                              echo '<div class="col-sm-4 d-flex flex-column">  <div class="h-100 d-flex flex-column justify-content-between galleryCol2">';
                          } 
                          ?>
                              <div class="gallaryimagebox" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                  data-title="<?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title(); ?>"
                                  data-images='<?php echo wp_json_encode(array_column($gallery_images, 'url')); ?>'>
                                  <img src="<?php echo $cover_image_url; ?>" alt="<?php the_title(); ?>" class="w-100" />
                                  <?php $arabic_title = get_post_meta(get_the_ID(), 'arabic_title', true);?>
                                  <h2 class="arabic-title galleryText text-white fw-semibold"> <?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title();?></h2>
                              </div>
                          <?php
                          if ($item_count === 2) {
                              echo '</div> </div>'; // Close col-sm-4 for the smaller images
                          }
                      } else {
                          // From item 3 onward, display in col-sm-6
                          ?>
                          <div class="col-sm-6 my-sm-4 my-2">
                              <div class="gallaryimagebox" data-bs-toggle="modal" data-bs-target="#galleryModal"
                                  data-title="<?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title(); ?>"
                                  data-images='<?php echo wp_json_encode(array_column($gallery_images, 'url')); ?>'>
                                  <img src="<?php echo $cover_image_url; ?>" alt="<?php the_title(); ?>" class="w-100" />
                                  <?php $arabic_title = get_post_meta(get_the_ID(), 'arabic_title', true);?>
                                    <h2 class="arabic-title galleryText text-white fw-semibold"> <?php echo $current_language === 'ar'? esc_html($arabic_title) :  the_title();?></h2>
                              </div>
                          </div>
                          <?php
                      }
                      $item_count++;
                    }
                }

                echo '</div>'; // Close the row div

            } else {
                echo '<p>No gallery items found.</p>';
            }

          wp_reset_postdata();
        ?>
      <!-- Single Reusable Modal -->
      <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header py-2">
                      <h6 class="modal-title fs-4" id="galleryModalLabel"></h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <!-- Carousel -->
                      <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner" id="carouselImages"></div>
                          <!-- Carousel controls -->
                          <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                              <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> -->
                              <span class=""><i class="bi bi-chevron-left"></i></span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                              <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
                              <span class=""><i class="bi bi-chevron-right"></i></span>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section>


<?php
get_footer(); 
?>