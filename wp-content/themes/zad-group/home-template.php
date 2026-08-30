<?php
/**
 * Template Name: Home-Template
 */

get_header();

global $current_language;
$current_language = !empty($current_language) ? $current_language : 'en';
$page_id = get_the_ID();

if (!function_exists('zad_home_slide_value')) {
    /** Return a localized slide value, with English as the fallback. */
    function zad_home_slide_value($slide, $field, $language) {
        $localized_field = $field . '_ar';
        if ($language === 'ar' && !empty($slide[$localized_field])) {
            return $slide[$localized_field];
        }
        return $slide[$field] ?? '';
    }
}

if (!function_exists('zad_render_home_brand_slider')) {
    /** Render one of the four independently managed Home brand sliders. */
    function zad_render_home_brand_slider($slides, $config, $language) {
        if (empty($slides) || !is_array($slides)) {
            return;
        }

        $slider_id = $config['id'];
        $stats = [
            ['orders', 'per_week'],
            ['ice_cream_orders', 'ice_cream_per_year'],
            ['stores', 'stores_desc'],
            ['cake_orders', 'cake_per_year'],
            ['dishes', 'dish_title'],
            ['event', 'event_text'],
            ['rating', 'rating_desc'],
            ['review', 'review_desc'],
        ];
        ?>
        <section class="brand-slider-section <?php echo esc_attr($config['section_class']); ?>">
            <div
                id="<?php echo esc_attr($slider_id); ?>"
                class="carousel slide carousel-fade brand-slider"
                data-bs-touch="true"
                aria-label="<?php echo esc_attr($config['label']); ?>"
            >
                <div class="carousel-inner">
                    <?php foreach ($slides as $index => $slide) :
                        // Brand colors are intentionally fixed to the supplied
                        // references; admin fields control content and imagery.
                        $slide_color = $config['background'];
                        $title = zad_home_slide_value($slide, 'title', $language);
                        $description = zad_home_slide_value($slide, 'description', $language);
                        $sub_description = zad_home_slide_value($slide, 'sub_description', $language);
                    ?>
                        <div class="carousel-item<?php echo $index === 0 ? ' active' : ''; ?>">
                            <article
                                class="brand-slide-card"
                                style="--brand-slide-bg: <?php echo esc_attr($slide_color); ?>; --brand-slide-ink: <?php echo esc_attr($config['ink']); ?>; --brand-slide-accent: <?php echo esc_attr($config['accent']); ?>;"
                            >
                                <div class="brand-slide-media">
                                    <?php if (!empty($slide['image'])) : ?>
                                        <img
                                            src="<?php echo esc_url($slide['image']); ?>"
                                            alt="<?php echo esc_attr($title ?: $config['label']); ?>"
                                            class="brand-slide-image"
                                        />
                                    <?php else : ?>
                                        <div class="brand-slide-image-placeholder" aria-hidden="true"></div>
                                    <?php endif; ?>
                                </div>

                                <div class="brand-slide-copy">
                                    <?php if (!empty($slide['single_image'])) : ?>
                                        <img src="<?php echo esc_url($slide['single_image']); ?>" alt="" class="brand-slide-logo" />
                                    <?php endif; ?>

                                    <?php if ($title !== '') : ?>
                                        <h3><?php echo esc_html($title); ?></h3>
                                    <?php endif; ?>

                                    <?php if ($description !== '') : ?>
                                        <p class="brand-slide-description"><?php echo nl2br(esc_html($description)); ?></p>
                                    <?php endif; ?>

                                    <?php if ($sub_description !== '') : ?>
                                        <p class="brand-slide-subdescription"><?php echo nl2br(esc_html($sub_description)); ?></p>
                                    <?php endif; ?>

                                    <div class="brand-slide-stats">
                                        <?php foreach ($stats as $stat) :
                                            $stat_value = zad_home_slide_value($slide, $stat[0], $language);
                                            $stat_label = zad_home_slide_value($slide, $stat[1], $language);
                                            if ($stat_value === '' && $stat_label === '') {
                                                continue;
                                            }
                                        ?>
                                            <div class="brand-slide-stat">
                                                <?php if ($stat_value !== '') : ?><strong><?php echo esc_html($stat_value); ?></strong><?php endif; ?>
                                                <?php if ($stat_label !== '') : ?><span><?php echo esc_html($stat_label); ?></span><?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <?php
                                    $button_text = zad_home_slide_value($slide, 'button_text', $language);
                                    $has_actions = !empty($slide['button_link']) || !empty($slide['instagram_link']);
                                    if ($has_actions) :
                                    ?>
                                        <div class="brand-slide-actions">
                                            <?php if (!empty($slide['button_link'])) : ?>
                                                <a class="brand-slide-button" href="<?php echo esc_url($slide['button_link']); ?>">
                                                    <?php echo esc_html($button_text ?: __('Learn more', 'zag-group')); ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($slide['instagram_link'])) : ?>
                                                <a class="brand-slide-social" href="<?php echo esc_url($slide['instagram_link']); ?>" target="_blank" rel="noopener">
                                                    <i class="bi bi-instagram" aria-hidden="true"></i>
                                                    <span><?php echo esc_html($config['social_label']); ?></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($slides) > 1) : ?>
                    <div class="brand-slider-controls">
                        <div class="carousel-indicators">
                            <?php foreach ($slides as $index => $slide) : ?>
                                <button
                                    type="button"
                                    data-bs-target="#<?php echo esc_attr($slider_id); ?>"
                                    data-bs-slide-to="<?php echo esc_attr($index); ?>"
                                    class="<?php echo $index === 0 ? 'active' : ''; ?>"
                                    aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                    aria-label="<?php echo esc_attr(sprintf(__('Slide %d', 'zag-group'), $index + 1)); ?>"
                                ></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="brand-slider-arrows">
                            <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo esc_attr($slider_id); ?>" data-bs-slide="prev" aria-label="<?php esc_attr_e('Previous slide', 'zag-group'); ?>">
                                <i class="bi bi-chevron-left" aria-hidden="true"></i>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#<?php echo esc_attr($slider_id); ?>" data-bs-slide="next" aria-label="<?php esc_attr_e('Next slide', 'zag-group'); ?>">
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
?>

<?php if (is_active_sidebar('below-sidebar2')) : ?>
    <div id="secondary-below-sidebar" class="widget-area">
        <?php dynamic_sidebar('below-sidebar2'); ?>
    </div>
<?php endif; ?>

<div class="modal fade" id="introvideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="introvideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="introvideoLabel"><?php esc_html_e('Intro', 'zag-group'); ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php esc_attr_e('Close', 'zag-group'); ?>"></button>
            </div>
            <div class="modal-body">
                <?php $video_intro_url = get_post_meta($page_id, '_join_video_homeintrolink_field', true); ?>
                <video controls poster="<?php echo esc_url(get_template_directory_uri() . '/assets/images/creativeIntro.png'); ?>">
                    <source src="<?php echo esc_url($video_intro_url); ?>" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
</div>

<section>
    <?php
    $our_concept_small_text = ($current_language === 'ar')
        ? get_post_meta($page_id, '_our_concept_small_title_field_ar', true)
        : get_post_meta($page_id, '_our_concept_small_title_field_en', true);
    $our_concept_heading_text = ($current_language === 'ar')
        ? get_post_meta($page_id, '_our_concept_heading_field_ar', true)
        : get_post_meta($page_id, '_our_concept_heading_field_en', true);
    $our_concept_sub_heading_text = ($current_language === 'ar')
        ? get_post_meta($page_id, '_our_concept_sub_heading_field_ar', true)
        : get_post_meta($page_id, '_our_concept_sub_heading_field_en', true);
    ?>
    <div class="container py-5">
        <div class="text-center py-5">
            <h3 class="text-yellow fw-bold"><?php echo esc_html($our_concept_small_text); ?></h3>
            <p class="fs-4 text-black fw-bold"><?php echo esc_html($our_concept_heading_text); ?></p>
            <p class="fs-24 text-black mt-3 px-sm-5 mx-sm-5"><?php echo esc_html($our_concept_sub_heading_text); ?></p>
        </div>
    </div>
</section>

<?php
$home_slides_1 = get_post_meta($page_id, 'homeslider1_slider_images', true);
$home_slides_2 = get_post_meta($page_id, 'homeSlider2_slider_images', true);
$home_slides_3 = get_post_meta($page_id, 'homeSlider3_slider_images', true);
$home_slides_4 = get_post_meta($page_id, 'homeSlider4_slider_images', true);

// Keep all four cards visible until the new Slider 3/4 admin sections are populated.
if (empty($home_slides_3)) {
    $home_slides_3 = !empty($home_slides_2) ? $home_slides_2 : $home_slides_1;
}
if (empty($home_slides_4)) {
    $home_slides_4 = $home_slides_3;
}

$home_slider_configs = [
    [
        'slides' => $home_slides_1,
        'id' => 'customSlider',
        'label' => 'Marble Slab',
        'section_class' => 'brand-slider-section--marble',
        'background' => '#d5a6bd',
        'ink' => '#271616',
        'accent' => '#9e1d64',
        'social_label' => 'marbleslabksa',
    ],
    [
        'slides' => $home_slides_2,
        'id' => 'customSlider2',
        'label' => 'Meez',
        'section_class' => 'brand-slider-section--meez',
        'background' => '#b6d7a8',
        'ink' => '#183326',
        'accent' => '#e84d20',
        'social_label' => 'meezstreet',
    ],
    [
        'slides' => $home_slides_3,
        'id' => 'customSlider3',
        'label' => 'Blak Peco',
        'section_class' => 'brand-slider-section--blakpeco',
        'background' => '#b7b7b7',
        'ink' => '#171717',
        'accent' => '#111111',
        'social_label' => 'blakpeco',
    ],
    [
        'slides' => $home_slides_4,
        'id' => 'customSlider4',
        'label' => 'Blak Peco',
        'section_class' => 'brand-slider-section--blakpeco',
        'background' => '#b7b7b7',
        'ink' => '#171717',
        'accent' => '#111111',
        'social_label' => 'blakpeco',
    ],
];
?>

<div class="container home-sliders-grid">
    <div class="row">
        <?php foreach ($home_slider_configs as $slider_config) : ?>
            <div class="col-lg-6 col-md-6 col-12 slider-grid-item">
                <?php zad_render_home_brand_slider($slider_config['slides'], $slider_config, $current_language); ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<section class="bg-dark-gray py-2 pt-4 mt-5">
    <div class="container py-1">
        <div class="row w-100 mx-auto justify-content-between">
            <div class="col-sm-4">
                <div>
                    <i class="bi bi-envelope-arrow-up-fill fs-2 text-yellow"></i>
                    <h3 class="text-black fw-bold"><?php echo esc_html(custom_translate('contact_us')); ?></h3>
                    <div class="row w-100 mx-auto">
                        <div class="col-sm-6 px-0"><p class="fw-bold"><?php echo esc_html(custom_translate('head_Office')); ?></p></div>
                        <div class="col-sm-6"><p><?php echo esc_html(custom_translate('address')); ?></p></div>
                    </div>
                    <div class="row w-100 mx-auto">
                        <div class="col-sm-6 px-0"><p class="fw-bold"><?php echo esc_html(custom_translate('phone_number')); ?></p></div>
                        <div class="col-sm-6"><p>9200 11480</p></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="8e55cfc" title="Contact form 1"]'); ?>
                    <p class="form-text text-center fs-14 text-dark-gray mt-3"><?php echo esc_html(custom_translate('submittingPolicy')); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer( ?>
