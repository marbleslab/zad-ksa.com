<?php
/**
 * Template Name: Recruitment Page
 */
get_header();
$current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';

// Banner
$banners = get_option('banner_images', []);

$recruitment_hero_banners = [];

foreach ($banners as $banner) {
    if ($banner['page'] === 'recuritment' && $banner['position'] === 'hero') {
        $recruitment_hero_banners[] = $banner['url'];
    }
}

?>

<section class="position-relative" id="rec-sec">
    <div class="container z-1 position-relative">
        <div class="swiper-container recruitment overflow-hidden rounded-3">
            <div class="swiper-wrapper pbottom-0">
                
                
                <?php foreach ($recruitment_hero_banners as $banner_url): ?>
    <div class="swiper-slide">
        <img class="w-100 rounded-3 rsh-240 magnifier-container" src="<?php echo $banner_url; ?>" alt="Recruitment Hero Banner" id="section-image" width="100%" height="100%">
    </div>
<?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container z-1 position-relative">
        <div class="main-section d-flex justify-content-center align-items-center">
            <div class="main-section-text text-center py-5">
                <p class="m-0 fs-3 text-dark lh-sm pt-3">
                    <?php echo custom_translate('recruitment-desc'); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let magnifierGlass = document.getElementById("magnifier-glass");

    // Select all slider images
    let images = document.querySelectorAll(".swiper-slide img");

    images.forEach(function (image) {
        image.addEventListener("mousemove", function (e) {
            let rect = image.getBoundingClientRect(); // Get image dimensions
            let x = e.clientX - rect.left; // Mouse X position relative to the image
            let y = e.clientY - rect.top; // Mouse Y position relative to the image

            // Ensure the mouse is within the image bounds
            if (x < 0 || y < 0 || x > rect.width || y > rect.height) {
                magnifierGlass.style.display = "none"; // Hide magnifier if outside the image
                return;
            }

                  });

        image.addEventListener("mouseleave", function () {
            magnifierGlass.style.display = "none"; // Hide magnifier when mouse leaves
        });
    });

    // Swiper Initialization
    var swiper = new Swiper(".recruitment", {
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});

</script>


<?php get_footer(); ?>