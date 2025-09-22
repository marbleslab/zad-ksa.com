<?php
/**
 * zadgroup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zadgroup
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function zag_group_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on zadgroup, use a find and replace
		* to change 'zag-group' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'zag-group', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'zag-group' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'zag_group_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'zag_group_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function zag_group_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'zag_group_content_width', 640 );
}
add_action( 'after_setup_theme', 'zag_group_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zag_group_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'zag-group' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'zag-group' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zag_group_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function zag_group_scripts() {
	// Enqueue styles
wp_enqueue_style( 'zag-group-style', get_stylesheet_uri(), array(), _S_VERSION );
wp_enqueue_style( 'bootstrap-icons', "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css", array(), _S_VERSION );
if (isset($_COOKIE['site_language']) && $_COOKIE['site_language'] == 'ar') {
	// Load RTL stylesheet for Arabic
	wp_enqueue_style( 'zad-bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap.rtl.min.css', array(), _S_VERSION );
} else {
	// Load default LTR stylesheet
	wp_enqueue_style( 'zad-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), _S_VERSION );
}

// Uncomment this line if you need to load the RTL version
// wp_enqueue_style( 'zad-bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap.rtl.min.css', array(), _S_VERSION );
wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), _S_VERSION ); // Swiper CSS
wp_enqueue_style( 'zad-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );

wp_style_add_data( 'zag-group-style', 'rtl', 'replace' );

// Enqueue scripts
wp_enqueue_script( 'zag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
wp_enqueue_script( 'zad-bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), _S_VERSION, true );
wp_enqueue_script( 'zad-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'zag_group_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



// =======+++
function custom_logo_customizer_settings( $wp_customize ) {

    // Add section for logo options
    $wp_customize->add_section( 'custom_logo_section', array(
        'title'       => __( 'Custom Logos', 'zad-group' ),
        'description' => 'Upload different logos for the homepage and other pages',
        'priority'    => 30,
    ));

    // Setting for homepage logo (white logo)
    $wp_customize->add_setting( 'homepage_logo' );
    
    // Control for homepage logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'homepage_logo', array(
        'label'    => __( 'Homepage Logo (White)', 'zad-group' ),
        'section'  => 'custom_logo_section',
        'settings' => 'homepage_logo',
    )));

    // Setting for other pages logo (black logo)
    $wp_customize->add_setting( 'other_pages_logo' );
    
    // Control for other pages logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'other_pages_logo', array(
        'label'    => __( 'Other Pages Logo (Black)', 'zad-group' ),
        'section'  => 'custom_logo_section',
        'settings' => 'other_pages_logo',
    )));
	// Setting for footer logo
    $wp_customize->add_setting( 'footer_logo' );

    // Control for footer logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label'    => __( 'Footer Logo', 'zad-group' ),
        'section'  => 'custom_logo_section',
        'settings' => 'footer_logo',
    )));
}
add_action( 'customize_register', 'custom_logo_customizer_settings' );

// Add the custom classes to menus

function add_menu_li_class($classes, $item, $args) {
    if (isset($args->li_class)) {
        $classes[] = $args->li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_li_class', 1, 3);
function add_menu_link_class($atts, $item, $args) {
    if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);








// Set the language based on user selection and load translation files

// function load_custom_translations() {
//     // Set the default language
//     $lang = 'en';

//     // Check if 'lang' is passed via URL or stored in a cookie
//     if (isset($_GET['lang'])) {
//         $lang = sanitize_text_field($_GET['lang']);
//         setcookie('site_language', $lang, time() + (86400 * 30), "/"); // Store for 30 days
//     } elseif (isset($_COOKIE['site_language'])) {
//         $lang = sanitize_text_field($_COOKIE['site_language']);
//     }

//     // Load the appropriate language JSON file
//     $language_file = get_template_directory() . "/languages/$lang.json";

//     if (file_exists($language_file)) {
//         $translations = file_get_contents($language_file);
//         $translations = json_decode($translations, true);

//         // Make the translations globally accessible
//         if ($translations) {
//             global $custom_translations;
//             $custom_translations = $translations;
//         }
//     }
// }
// add_action('init', 'load_custom_translations');

function load_custom_translations() {
    // Set the default language
    $lang = 'en';

    // Check if 'lang' is passed via URL or stored in a cookie
    if (isset($_COOKIE['site_language'])) {
        $lang = sanitize_text_field($_COOKIE['site_language']);
    }

    // Load the appropriate language JSON file
    $language_file = get_template_directory() . "/languages/$lang.json";

    if (file_exists($language_file)) {
        $translations = file_get_contents($language_file);
        $translations = json_decode($translations, true);

        // Make the translations globally accessible
        if ($translations) {
            global $custom_translations;
            $custom_translations = $translations;
        }
    }
}
add_action('init', 'load_custom_translations');


function custom_translate($key) {
    global $custom_translations;

    // Return the translation if it exists
    if (isset($custom_translations[$key])) {
        return $custom_translations[$key];
    }

    // Return the key as a fallback if no translation is found
    return $key;
}


// custom fields

// Function to add meta boxes conditionally for English and Arabic
function add_custom_meta_boxes_for_about_and_home() {
    global $post;

    // Get the page objects for About and Home pages dynamically by their slugs
    $about_page = get_page_by_path('about-us');
    $home_page = get_page_by_path('home');
    $join_us_page = get_page_by_path('join-us');

    // Add meta box for About page (Our Mission section) - English and Arabic
    if ($post->ID == $about_page->ID) {
        add_meta_box(
            'about_page_mission_field',
            'About Page - Our Mission (English & Arabic)',
            'render_about_page_meta_box',
            'page',
            'normal',
            'high'
        );
    }
    if ($post->ID == $join_us_page->ID) {
        add_meta_box(
            'joinus_page_mission_field',
            'Joinus Page',
            'render_joinus_page_meta_box',
            'page',
            'normal',
            'high'
        );
    }
	if ($post->ID == $about_page->ID) {  
        add_meta_box("person_images_meta", "Our Team Slider", "display_person_images_meta_box", "page", "normal", "high");
    }

    // Add meta box for Home page (Get to Know Us section) - English and Arabic
    if ($post->ID == $home_page->ID) {
        add_meta_box(
            'home_page_get_to_know_field',
            'Home Page - Get to Know Us (English & Arabic)',
            'render_home_page_meta_box',
            'page',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'add_custom_meta_boxes_for_about_and_home');

// Function to render the Our Mission field for the About page
function render_about_page_meta_box($post) {
    // Get the saved meta data for both English and Arabic
    $mission_small_title_content_en = get_post_meta($post->ID, '_mission_small_title_field_en', true);
    $mission_small_title_content_ar = get_post_meta($post->ID, '_mission_small_title_field_ar', true);
    // mission heading
    $mission_heading_content_en = get_post_meta($post->ID, '_mission_heading_field_en', true);
    $mission_heading_content_ar = get_post_meta($post->ID, '_mission_heading_field_ar', true);

    $mission_sub_heading_content_en = get_post_meta($post->ID, '_mission_sub_heading_field_en', true);
    $mission_sub_heading_content_ar = get_post_meta($post->ID, '_mission_sub_heading_field_ar', true);

    $our_history_small_title_content_en = get_post_meta($post->ID, '_our_history_small_title_field_en', true);
    $our_history_small_title_content_ar = get_post_meta($post->ID, '_our_history_small_title_field_ar', true);
    $timline_title_content_en = get_post_meta($post->ID, '_timline_title_field_en', true);
    $timline_title_content_ar = get_post_meta($post->ID, '_timline_title_field_ar', true);
    // our people small title
    $people_small_title_content_en = get_post_meta($post->ID, '_people_small_title_field_en', true);
    $people_small_title_content_ar = get_post_meta($post->ID, '_people_small_title_field_ar', true);

    // heading
    $people_heading_content_en = get_post_meta($post->ID, '_people_heading_field_en', true);
    $people_heading_content_ar = get_post_meta($post->ID, '_people_heading_field_ar', true);

    $people_sub_heading_content_en = get_post_meta($post->ID, '_people_sub_heading_field_en', true);
    $people_sub_heading_content_ar = get_post_meta($post->ID, '_people_sub_heading_field_ar', true);

    // Output the fields for English and Arabic
    ?>
        <h3>Our Mission Section</h3>
        <label for="join_video_aboutintrolink_field">Intro Video Link (YouTube, Vimeo, etc.):</label>
        <input type="url" id="join_video_aboutintrolink_field" name="join_video_aboutintrolink_field" value="<?php echo esc_attr(get_post_meta($post->ID, '_join_video_aboutintrolink_field', true)); ?>" style="width:100%;">
        <br><br>

        <!-- Our Mission Small Title -->
        <h4>Our Mission Small Title (English)</h4>
        <?php wp_editor($mission_small_title_content_en, 'mission_small_title_field_en', ['textarea_name' => 'mission_small_title_field_en']); ?>
        <h4>Our Mission Small Title (Arabic)</h4>
        <?php wp_editor($mission_small_title_content_ar, 'mission_small_title_field_ar', ['textarea_name' => 'mission_small_title_field_ar']); ?>

        <!-- Our Mission Heading -->
        <h4>Our Mission Heading (English)</h4>
        <?php wp_editor($mission_heading_content_en, 'mission_heading_field_en', ['textarea_name' => 'mission_heading_field_en']); ?>
        <h4>Our Mission Heading (Arabic)</h4>
        <?php wp_editor($mission_heading_content_ar, 'mission_heading_field_ar', ['textarea_name' => 'mission_heading_field_ar']); ?>

        <h4>Our Mission Sub Heading (English)</h4>
        <?php wp_editor($mission_sub_heading_content_en, 'mission_sub_heading_field_en', ['textarea_name' => 'mission_sub_heading_field_en']); ?>
        <h4>Our Mission Sub Heading (Arabic)</h4>
        <?php wp_editor($mission_sub_heading_content_ar, 'mission_sub_heading_field_ar', ['textarea_name' => 'mission_sub_heading_field_ar']); ?>

        <h3>Our People Section</h3>
        <h4>Our People Small Title (English)</h4>
        <?php wp_editor($people_small_title_content_en, 'people_small_title_field_en', ['textarea_name' => 'people_small_title_field_en']); ?>
        <h4>Our People Small Title (Arabic)</h4>
        <?php wp_editor($people_small_title_content_ar, 'people_small_title_field_ar', ['textarea_name' => 'people_small_title_field_ar']); ?>

        <h4>Our People Heading (English)</h4>
        <?php wp_editor($people_heading_content_en, 'people_heading_field_en', ['textarea_name' => 'people_heading_field_en']); ?>
        <h4>Our People Heading (Arabic)</h4>
        <?php wp_editor($people_heading_content_ar, 'people_heading_field_ar', ['textarea_name' => 'people_heading_field_ar']); ?>

        <h4>Our People Sub Heading (English)</h4>
        <?php wp_editor($people_sub_heading_content_en, 'people_sub_heading_field_en', ['textarea_name' => 'people_sub_heading_field_en']); ?>
        <h4>Our People Sub Heading (Arabic)</h4>
        <?php wp_editor($people_sub_heading_content_ar, 'people_sub_heading_field_ar', ['textarea_name' => 'people_sub_heading_field_ar']); ?>

        <h3>Our History</h3>
        <h4>Our History Small Title (English)</h4>
        <?php wp_editor($our_history_small_title_content_en, 'our_history_small_title_field_en', ['textarea_name' => 'our_history_small_title_field_en']); ?>
        <h4>Our History Small Title (Arabic)</h4>
        <?php wp_editor($our_history_small_title_content_ar, 'our_history_small_title_field_ar', ['textarea_name' => 'our_history_small_title_field_ar']); ?>

        <h4>Timeline Title (English)</h4>
        <?php wp_editor($timline_title_content_en, 'timeline_title_field_en', ['textarea_name' => 'timeline_title_field_en']); ?>
        <h4>Timeline Title (Arabic)</h4>
        <?php wp_editor($timline_title_content_ar, 'timeline_title_field_ar', ['textarea_name' => 'timeline_title_field_ar']); ?>
    <?php
}


// Function to render the Get to Know Us field for the Home page
function render_home_page_meta_box($post) {
    // Get the saved meta data for both English and Arabic
    $hero_small_title_content_en = get_post_meta($post->ID, '_hero_small_title_field_en', true);
    $hero_small_title_content_ar = get_post_meta($post->ID, '_hero_small_title_field_ar', true);

    $hero_heading_content_en = get_post_meta($post->ID, '_hero_heading_field_en', true);
    $hero_heading_content_ar = get_post_meta($post->ID, '_hero_heading_field_ar', true);

    $hero_sub_heading_content_en = get_post_meta($post->ID, '_hero_sub_heading_field_en', true);
    $hero_sub_heading_content_ar = get_post_meta($post->ID, '_hero_sub_heading_field_ar', true);

    $get_to_know_small_title_content_en = get_post_meta($post->ID, '_get_to_know_small_title_field_en', true);
    $get_to_know_small_title_content_ar = get_post_meta($post->ID, '_get_to_know_small_title_field_ar', true);

    $get_to_know_heading_content_en = get_post_meta($post->ID, '_get_to_know_heading_field_en', true);
    $get_to_know_heading_content_ar = get_post_meta($post->ID, '_get_to_know_heading_field_ar', true);

    $get_to_know_sub_heading_content_en = get_post_meta($post->ID, '_get_to_know_sub_heading_field_en', true);
    $get_to_know_sub_heading_content_ar = get_post_meta($post->ID, '_get_to_know_sub_heading_field_ar', true);
    // our concept section
    $our_concept_small_title_content_en = get_post_meta($post->ID, '_our_concept_small_title_field_en', true);
    $our_concept_small_title_content_ar = get_post_meta($post->ID, '_our_concept_small_title_field_ar', true);

    $our_concept_heading_content_en = get_post_meta($post->ID, '_our_concept_heading_field_en', true);
    $our_concept_heading_content_ar = get_post_meta($post->ID, '_our_concept_heading_field_ar', true);

    $our_concept_sub_heading_content_en = get_post_meta($post->ID, '_our_concept_sub_heading_field_en', true);
    $our_concept_sub_heading_content_ar = get_post_meta($post->ID, '_our_concept_sub_heading_field_ar', true);
   
    $total_workers = get_post_meta($post->ID, '_total_workers', true);

    $total_women = get_post_meta($post->ID, '_total_women', true);

    // Output the fields for English and Arabic
   ?>
    <!-- Get to Know Us Section -->

	<!-- Get to Know Us (English) -->
	<h3>Hero Section</h3>

		<!-- Get To  know Small Title -->
		<label for="hero_small_title_field_en">Hero Small Title (English):</label>
		
        <?php wp_editor($hero_small_title_content_en, 'hero_small_title_field_en', ['textarea_name' => 'hero_small_title_field_en']); ?>

		<br><br>

		<label for="hero_small_title_field_ar">Hero Small Title (Arabic):</label>
		
        <?php wp_editor($hero_small_title_content_ar, 'hero_small_title_field_ar', ['textarea_name' => 'hero_small_title_field_ar']); ?>

		<br><br>

        <!-- <label for="intro_video_upload_field">Upload Intro Video:</label>
        <input type="file" id="intro_video_upload_field" name="intro_video_upload_field" accept="video/*" style="width:100%;">
        <br><br> -->
        <label for="join_video_homeintrolink_field">Intro Video Link (YouTube, Vimeo, etc.):</label>
        <input type="url" id="join_video_homeintrolink_field" name="join_video_homeintrolink_field" value="<?php echo esc_attr(get_post_meta($post->ID, '_join_video_homeintrolink_field', true)); ?>" style="width:100%;">
        <br><br>

        <?php
        // $intro_video_url = get_post_meta($post->ID, '_intro_video_upload_field', true);
        // if ($intro_video_url) {
        //     echo "<video controls style='width:100%; margin-bottom: 10px;'>
        //             <source src='" . esc_url($intro_video_url) . "' type='video/mp4'>
        //             Your browser does not support the video tag.
        //         </video>";
        //     echo '<label for="remove_intro_video">Remove Intro Video:</label>';
        //     echo '<input type="checkbox" id="remove_intro_video" name="remove_intro_video" value="1">';
        // }
        ?>
        <br><br>

        <!-- Get To  know heading Title -->
		<label for="hero_heading_field_en">Hero heading Title (English):</label>
        <?php wp_editor($hero_heading_content_en, 'hero_heading_field_en', ['textarea_name' => 'hero_heading_field_en']); ?>

		<br><br>

		<label for="hero_heading_field_ar">Hero heading Title (Arabic):</label>
        <?php wp_editor($hero_heading_content_ar, 'hero_heading_field_ar', ['textarea_name' => 'hero_heading_field_ar']); ?>

		<br><br>


        <!-- Get To  know sub heading Title -->
		<label for="hero_sub_heading_field_en">Our get to know sub heading Title (English):</label>
        <?php wp_editor($hero_sub_heading_content_en, 'hero_sub_heading_field_en', ['textarea_name' => 'hero_sub_heading_field_en']); ?>

		<br><br>

		<label for="hero_sub_heading_field_ar">Our get to know sub heading Title (Arabic):</label>
        <?php wp_editor($hero_sub_heading_content_ar, 'hero_sub_heading_field_ar', ['textarea_name' => 'hero_sub_heading_field_ar']); ?>

		<br><br>


        <h3>Get to know section</h3>
        <!-- Get To  know Small Title -->
		<label for="get_to_know_small_title_field_en">Our get to know Small Title (English):</label>
        <?php wp_editor($get_to_know_small_title_content_en, 'get_to_know_small_title_field_en', ['textarea_name' => 'get_to_know_small_title_field_en']); ?>

		<br><br>

		<label for="get_to_know_small_title_field_ar">Our get to know Small Title (Arabic):</label>
        <?php wp_editor($get_to_know_small_title_content_ar, 'get_to_know_small_title_field_ar', ['textarea_name' => 'get_to_know_small_title_field_ar']); ?>

		<br><br>



        <!-- Get To  know heading Title -->
		<label for="get_to_know_heading_field_en">Our get to know heading Title (English):</label>
        <?php wp_editor($get_to_know_heading_content_en, 'get_to_know_heading_field_en', ['textarea_name' => 'get_to_know_heading_field_en']); ?>

		<br><br>

		<label for="get_to_know_heading_field_ar">Our get to know heading Title (Arabic):</label>
		
        <?php wp_editor($get_to_know_heading_content_ar, 'get_to_know_heading_field_ar', ['textarea_name' => 'get_to_know_heading_field_ar']); ?>

		<br><br>


        <!-- Get To  know sub heading Title -->
		<label for="get_to_know_sub_heading_field_en">Our get to know sub heading Title (English):</label>
        <?php wp_editor($get_to_know_sub_heading_content_en, 'get_to_know_sub_heading_field_en', ['textarea_name' => 'get_to_know_sub_heading_field_en']); ?>

		<br><br>

		<label for="get_to_know_sub_heading_field_ar">Our get to know sub heading Title (Arabic):</label>
		
        <?php wp_editor($get_to_know_sub_heading_content_ar, 'get_to_know_sub_heading_field_ar', ['textarea_name' => 'get_to_know_sub_heading_field_ar']); ?>

		<br><br>

        <label for="total_workers">Totoal workers:</label>
        <input type="text" id="total_workers" name="total_workers" style="width:100%;" value="<?php echo esc_attr($total_workers); ?>" />

		<br><br>

        <label for="total_women">Totoal womens:</label>
        <input type="text" id="total_women" name="total_women" style="width:100%;" value="<?php echo esc_attr($total_women); ?>" />

		<br><br>

        <!-- our concept section-->
         <h3>Our Concept</h3>
         <label for="our_concept_small_title_field_en">Our concept Small Title (English):</label>
		
        <?php wp_editor($our_concept_small_title_content_en, 'our_concept_small_title_field_en', ['textarea_name' => 'our_concept_small_title_field_en']); ?>

		<br><br>

		<label for="our_concept_small_title_field_ar">Our concept Small Title (Arabic):</label>
		
        <?php wp_editor($our_concept_small_title_content_ar, 'our_concept_small_title_field_ar', ['textarea_name' => 'our_concept_small_title_field_ar']); ?>

		<br><br>
        <!-- Get To  know heading Title -->
		<label for="our_concept_heading_field_en">Our concept heading Title (English):</label>
		
        <?php wp_editor($our_concept_heading_content_en, 'our_concept_heading_field_en', ['textarea_name' => 'our_concept_heading_field_en']); ?>

		<br><br>

		<label for="our_concept_heading_field_ar">Our concept heading Title (Arabic):</label>
		
        <?php wp_editor($our_concept_heading_content_ar, 'our_concept_heading_field_ar', ['textarea_name' => 'our_concept_heading_field_ar']); ?>

		<br><br>


        <!-- Get To  know sub heading Title -->
		<label for="our_concept_sub_heading_field_en">Our concept sub heading Title (English):</label>
		
        <?php wp_editor($our_concept_sub_heading_content_en, 'our_concept_sub_heading_field_en', ['textarea_name' => 'our_concept_sub_heading_field_en']); ?>

		<br><br>

		<label for="our_concept_sub_heading_field_ar">Our concept sub heading Title (Arabic):</label>
		
        <?php wp_editor($our_concept_sub_heading_content_ar, 'our_concept_sub_heading_field_ar', ['textarea_name' => 'our_concept_sub_heading_field_ar']); ?>

		<br><br>

   <?php
}

// joinus page
function render_joinus_page_meta_box($post) {
    // Get the saved meta data for both English and Arabic
    $join_hero_title_content_en = get_post_meta($post->ID, '_join_hero_title_field_en', true);
    $join_hero_title_content_ar = get_post_meta($post->ID, '_join_hero_title_field_ar', true);

    $join_card_title1_en = get_post_meta($post->ID, '_join_card_title1_field_en', true);
    $join_card_title1_ar = get_post_meta($post->ID, '_join_card_title1_field_ar', true);

    $join_card_desc1_en = get_post_meta($post->ID, '_join_card_desc1_field_en', true);
    $join_card_desc1_ar = get_post_meta($post->ID, '_join_card_desc1_field_ar', true);


    $join_card_title2_en = get_post_meta($post->ID, '_join_card_title2_field_en', true);
    $join_card_title2_ar = get_post_meta($post->ID, '_join_card_title2_field_ar', true);

    $join_card_desc2_en = get_post_meta($post->ID, '_join_card_desc2_field_en', true);
    $join_card_desc2_ar = get_post_meta($post->ID, '_join_card_desc2_field_ar', true);

    // card 3
    $join_card_title3_en = get_post_meta($post->ID, '_join_card_title3_field_en', true);
    $join_card_title3_ar = get_post_meta($post->ID, '_join_card_title3_field_ar', true);

    $join_card_desc3_en = get_post_meta($post->ID, '_join_card_desc3_field_en', true);
    $join_card_desc3_ar = get_post_meta($post->ID, '_join_card_desc3_field_ar', true);

    // video section
    $join_video_title1_en = get_post_meta($post->ID, '_join_video_title1_field_en', true);
    $join_video_title1_ar = get_post_meta($post->ID, '_join_video_title1_field_ar', true);

    $join_video_desc1_en = get_post_meta($post->ID, '_join_video_desc1_field_en', true);
    $join_video_desc1_ar = get_post_meta($post->ID, '_join_video_desc1_field_ar', true);

    // video 2
    $join_video_title2_en = get_post_meta($post->ID, '_join_video_title2_field_en', true);
    $join_video_title2_ar = get_post_meta($post->ID, '_join_video_title2_field_ar', true);

    $join_video_desc2_en = get_post_meta($post->ID, '_join_video_desc2_field_en', true);
    $join_video_desc2_ar = get_post_meta($post->ID, '_join_video_desc2_field_ar', true);
    // Output the fields for English and Arabic
   ?>
   <!-- Get to Know Us Section -->

	<!-- Get to Know Us (English) -->
	<h3>Hero Section</h3>

		<!-- Get To  know Small Title -->
		<label for="join_hero_title_field_en">Hero Title (English):</label>
		<textarea id="join_hero_title_field_en" name="join_hero_title_field_en" rows="2" style="width:100%;">
		<?php echo esc_textarea($join_hero_title_content_en); ?>
		</textarea>

		<br><br>
        <label for="join_hero_title_field_ar">Hero Title (Arabic):</label>
		<textarea id="join_hero_title_field_ar" name="join_hero_title_field_ar" rows="2" style="width:100%;">
		<?php echo esc_textarea($join_hero_title_content_ar); ?>
		</textarea>

		<br><br>

        <!-- cards -->
    <h3>Card Section</h3>

        <!-- Get To  know Small Title -->
        <label for="join_card_title1_field_en">Card Title-1 (English):</label>
        <textarea id="join_card_title1_field_en" name="join_card_title1_field_en" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title1_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_title1_field_ar">Card Title-1 (Arabic):</label>
        <textarea id="join_card_title1_field_ar" name="join_card_title1_field_ar" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title1_ar); ?>
        </textarea>

        <br><br>

        <label for="join_card_desc1_field_en">Card Description-1 (English):</label>
        <textarea id="join_card_desc1_field_en" name="join_card_desc1_field_en" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc1_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_desc1_field_ar">Card Description-1 (Arabic):</label>
        <textarea id="join_card_desc1_field_ar" name="join_card_desc1_field_ar" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc1_ar); ?>
        </textarea>

        <br><br>

        <!-- card 2 -->
        <!-- Get To  know Small Title -->
        <label for="join_card_title2_field_en">Card Title-2 (English):</label>
        <textarea id="join_card_title2_field_en" name="join_card_title2_field_en" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title2_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_title2_field_ar">Card Title-2 (Arabic):</label>
        <textarea id="join_card_title2_field_ar" name="join_card_title2_field_ar" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title2_ar); ?>
        </textarea>

        <br><br>

        <label for="join_card_desc2_field_en">Card Description-2 (English):</label>
        <textarea id="join_card_desc2_field_en" name="join_card_desc2_field_en" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc2_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_desc2_field_ar">Card Description-2 (Arabic):</label>
        <textarea id="join_card_desc2_field_ar" name="join_card_desc2_field_ar" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc2_ar); ?>
        </textarea>

        <br><br>

        <!-- card 3 -->
        <!-- Get To  know Small Title -->
        <label for="join_card_title3_field_en">Card Title-3 (English):</label>
        <textarea id="join_card_title3_field_en" name="join_card_title3_field_en" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title3_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_title3_field_ar">Card Title-3 (Arabic):</label>
        <textarea id="join_card_title3_field_ar" name="join_card_title3_field_ar" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_card_title3_ar); ?>
        </textarea>

        <br><br>

        <label for="join_card_desc3_field_en">Card Description-3 (English):</label>
        <textarea id="join_card_desc3_field_en" name="join_card_desc3_field_en" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc3_en); ?>
        </textarea>

        <br><br>
        <label for="join_card_desc3_field_ar">Card Description-3 (Arabic):</label>
        <textarea id="join_card_desc3_field_ar" name="join_card_desc3_field_ar" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_card_desc3_ar); ?>
        </textarea>

        <br><br>
        <!-- video section  -->
        <!-- video 1 -->
        <h3>Video Section</h3>

        <label for="join_video_title1_field_en">video Title-1 (English):</label>
        <textarea id="join_video_title1_field_en" name="join_video_title1_field_en" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_video_title1_en); ?>
        </textarea>

        <br><br>
        <label for="join_video_title1_field_ar">video Title-1 (Arabic):</label>
        <textarea id="join_video_title1_field_ar" name="join_video_title1_field_ar" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_video_title1_ar); ?>
        </textarea>

        <br><br>
        <label for="join_video_desc1_field_en">video Description-1 (English):</label>
        <textarea id="join_video_desc1_field_en" name="join_video_desc1_field_en" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_video_desc1_en); ?>
        </textarea>

        <br><br>
        <label for="join_video_desc1_field_ar">video Description-1 (Arabic):</label>
        <textarea id="join_video_desc1_field_ar" name="join_video_desc1_field_ar" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_video_desc1_ar); ?>
        </textarea>

        <br><br>
        <label for="join_video_link1_field">Meet Team Video Link (YouTube, Vimeo, etc.):</label>
        <input type="url" id="join_video_link1_field" name="join_video_link1_field" value="<?php echo esc_attr(get_post_meta($post->ID, '_join_video_link1_field', true)); ?>" style="width:100%;">
        <br><br>

        <label for="join_video_link2_field">Intro Video Link (YouTube, Vimeo, etc.):</label>
        <input type="url" id="join_video_link2_field" name="join_video_link2_field" value="<?php echo esc_attr(get_post_meta($post->ID, '_join_video_link2_field', true)); ?>" style="width:100%;">
        <br><br>

        <?php
        // $video_url = get_post_meta($post->ID, '_join_video_link1_field', true);

        // if ($video_url) {
        //     echo "<a href='" . esc_url($video_url) . "' target='_blank'>View Video</a>";

        //     // Add a checkbox to remove the video link
        //     echo '<label for="remove_join_video1">Remove Video:</label>';
        //     echo '<input type="checkbox" id="remove_join_video1" name="remove_join_video1" value="1">';
        // }
        ?>
        <!-- Video Upload -->
        <!-- <label for="join_video1_upload_field">Team Intro Upload Video:</label>
        <input type="file" id="join_video1_upload_field" name="join_video1_upload_field" accept="video/*" style="width:100%;">
        <br><br> -->

        <!-- Display Existing Video -->
       <?php
        // $join_video1_url = get_post_meta($post->ID, '_join_video1_upload_field', true);
        // if ($join_video1_url) {
        //     echo "<video controls style='width:100%; margin-bottom: 10px;'>
        //             <source src='" . esc_url($join_video1_url) . "' type='video/mp4'>
        //             Your browser does not support the video tag.
        //         </video>";

        //     // Add a checkbox to remove the video
        //     echo '<label for="remove_join_video1">Remove Video:</label>';
        //     echo '<input type="checkbox" id="remove_join_video1" name="remove_join_video1" value="1">';
        // }
        ?> 
        <br><br>
        <!-- video 2 -->
        <!-- <label for="company_video1_upload_field">Upload Company Video:</label>
        <input type="file" id="company_video1_upload_field" name="company_video1_upload_field" accept="video/*" style="width:100%;">
        <br><br> -->

        <?php
        // $company_video1_url = get_post_meta($post->ID, '_company_video1_upload_field', true);
        // if ($company_video1_url) {
        //     echo "<video controls style='width:100%; margin-bottom: 10px;'>
        //             <source src='" . esc_url($company_video1_url) . "' type='video/mp4'>
        //             Your browser does not support the video tag.
        //         </video>";
        //     echo '<label for="remove_company_video1">Remove Company Video:</label>';
        //     echo '<input type="checkbox" id="remove_company_video1" name="remove_company_video1" value="1">';
        // }
        ?>
        <br><br>
        <label for="join_video_title2_field_en">video Title-2 (English):</label>
        <textarea id="join_video_title2_field_en" name="join_video_title2_field_en" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_video_title2_en); ?>
        </textarea>

        <br><br>
        <label for="join_video_title2_field_ar">video Title-2 (Arabic):</label>
        <textarea id="join_video_title2_field_ar" name="join_video_title2_field_ar" rows="2" style="width:100%;">
        <?php echo esc_textarea($join_video_title2_ar); ?>
        </textarea>

        <br><br>
        <label for="join_video_desc2_field_en">video Description-2 (English):</label>
        <textarea id="join_video_desc2_field_en" name="join_video_desc2_field_en" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_video_desc2_en); ?>
        </textarea>

        <br><br>
        <label for="join_video_desc2_field_ar">video Description-2 (Arabic):</label>
        <textarea id="join_video_desc2_field_ar" name="join_video_desc2_field_ar" rows="4" style="width:100%;">
        <?php echo esc_textarea($join_video_desc2_ar); ?>
        </textarea>

        <br><br>

   <?php
}
// Function to save the meta box values when the post is saved
function save_translation_meta_boxes($post_id) {
    // Check if the post is being autosaved or if the current user has permission
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save the Our Mission field for the About page (English and Arabic)
    if (isset($_POST['mission_small_title_field_en'])) {
        update_post_meta($post_id, '_mission_small_title_field_en', sanitize_text_field($_POST['mission_small_title_field_en']));
    }
    if (isset($_POST['mission_small_title_field_ar'])) {
        update_post_meta($post_id, '_mission_small_title_field_ar', sanitize_text_field($_POST['mission_small_title_field_ar']));
    }

	if (isset($_POST['mission_heading_field_en'])) {
        update_post_meta($post_id, '_mission_heading_field_en', sanitize_text_field($_POST['mission_heading_field_en']));
    }
    if (isset($_POST['mission_heading_field_ar'])) {
        update_post_meta($post_id, '_mission_heading_field_ar', sanitize_text_field($_POST['mission_heading_field_ar']));
    }

    // mission sub heading
    if (isset($_POST['mission_sub_heading_field_en'])) {
        update_post_meta($post_id, '_mission_sub_heading_field_en', sanitize_text_field($_POST['mission_sub_heading_field_en']));
    }
    if (isset($_POST['mission_sub_heading_field_ar'])) {
        update_post_meta($post_id, '_mission_sub_heading_field_ar', sanitize_text_field($_POST['mission_sub_heading_field_ar']));
    }


    // our people (Team)
	if (isset($_POST['people_small_title_field_en'])) {
        update_post_meta($post_id, '_people_small_title_field_en', sanitize_text_field($_POST['people_small_title_field_en']));
    }
    if (isset($_POST['people_small_title_field_ar'])) {
        update_post_meta($post_id, '_people_small_title_field_ar', sanitize_text_field($_POST['people_small_title_field_ar']));
    }
	if (isset($_POST['people_heading_field_en'])) {
        update_post_meta($post_id, '_people_heading_field_en', sanitize_text_field($_POST['people_heading_field_en']));
    }
    if (isset($_POST['people_heading_field_ar'])) {
        update_post_meta($post_id, '_people_heading_field_ar', sanitize_text_field($_POST['people_heading_field_ar']));
    }

    // sub heading
    if (isset($_POST['people_sub_heading_field_en'])) {
        update_post_meta($post_id, '_people_sub_heading_field_en', sanitize_text_field($_POST['people_sub_heading_field_en']));
    }
    if (isset($_POST['people_sub_heading_field_ar'])) {
        update_post_meta($post_id, '_people_sub_heading_field_ar', sanitize_text_field($_POST['people_sub_heading_field_ar']));
    }
    // our history 
    if (isset($_POST['our_history_small_title_field_en'])) {
        update_post_meta($post_id, '_our_history_small_title_field_en', sanitize_text_field($_POST['our_history_small_title_field_en']));
    }
    if (isset($_POST['our_history_small_title_field_ar'])) {
        update_post_meta($post_id, '_our_history_small_title_field_ar', sanitize_text_field($_POST['our_history_small_title_field_ar']));
    }
    if (isset($_POST['timeline_title_field_en'])) {
        update_post_meta($post_id, '_timeline_title_field_en', sanitize_text_field($_POST['timeline_title_field_en']));
    }
    if (isset($_POST['timeline_title_field_ar'])) {
        update_post_meta($post_id, '_timeline_title_field_ar', sanitize_text_field($_POST['timeline_title_field_ar']));
    }

    // Save the Get to Know Us field for the Home page (English and Arabic)==++++++++++++++++++
    if (isset($_POST['hero_small_title_field_en'])) {
        update_post_meta($post_id, '_hero_small_title_field_en', sanitize_text_field($_POST['hero_small_title_field_en']));
    }
    if (isset($_POST['hero_small_title_field_ar'])) {
        update_post_meta($post_id, '_hero_small_title_field_ar', sanitize_text_field($_POST['hero_small_title_field_ar']));
    }

    if (isset($_POST['hero_heading_field_en'])) {
        update_post_meta($post_id, '_hero_heading_field_en', sanitize_text_field($_POST['hero_heading_field_en']));
    }
    if (isset($_POST['hero_heading_field_ar'])) {
        update_post_meta($post_id, '_hero_heading_field_ar', sanitize_text_field($_POST['hero_heading_field_ar']));
    }


    if (isset($_POST['hero_sub_heading_field_en'])) {
        update_post_meta($post_id, '_hero_sub_heading_field_en', sanitize_text_field($_POST['hero_sub_heading_field_en']));
    }
    if (isset($_POST['hero_sub_heading_field_ar'])) {
        update_post_meta($post_id, '_hero_sub_heading_field_ar', sanitize_text_field($_POST['hero_sub_heading_field_ar']));
    }

    // our concept
    if (isset($_POST['our_concept_small_title_field_en'])) {
        update_post_meta($post_id, '_our_concept_small_title_field_en', sanitize_text_field($_POST['our_concept_small_title_field_en']));
    }
    if (isset($_POST['our_concept_small_title_field_ar'])) {
        update_post_meta($post_id, '_our_concept_small_title_field_ar', sanitize_text_field($_POST['our_concept_small_title_field_ar']));
    }

    if (isset($_POST['our_concept_heading_field_en'])) {
        update_post_meta($post_id, '_our_concept_heading_field_en', sanitize_text_field($_POST['our_concept_heading_field_en']));
    }
    if (isset($_POST['our_concept_heading_field_ar'])) {
        update_post_meta($post_id, '_our_concept_heading_field_ar', sanitize_text_field($_POST['our_concept_heading_field_ar']));
    }


    if (isset($_POST['our_concept_sub_heading_field_en'])) {
        update_post_meta($post_id, '_our_concept_sub_heading_field_en', sanitize_text_field($_POST['our_concept_sub_heading_field_en']));
    }
    if (isset($_POST['our_concept_sub_heading_field_ar'])) {
        update_post_meta($post_id, '_our_concept_sub_heading_field_ar', sanitize_text_field($_POST['our_concept_sub_heading_field_ar']));
    }

    // ----
    
    if (isset($_POST['get_to_know_small_title_field_en'])) {
        update_post_meta($post_id, '_get_to_know_small_title_field_en', sanitize_text_field($_POST['get_to_know_small_title_field_en']));
    }
    if (isset($_POST['get_to_know_small_title_field_ar'])) {
        update_post_meta($post_id, '_get_to_know_small_title_field_ar', sanitize_text_field($_POST['get_to_know_small_title_field_ar']));
    }

    if (isset($_POST['get_to_know_heading_field_en'])) {
        update_post_meta($post_id, '_get_to_know_heading_field_en', sanitize_text_field($_POST['get_to_know_heading_field_en']));
    }
    if (isset($_POST['get_to_know_heading_field_ar'])) {
        update_post_meta($post_id, '_get_to_know_heading_field_ar', sanitize_text_field($_POST['get_to_know_heading_field_ar']));
    }


    if (isset($_POST['get_to_know_sub_heading_field_en'])) {
        update_post_meta($post_id, '_get_to_know_sub_heading_field_en', sanitize_text_field($_POST['get_to_know_sub_heading_field_en']));
    }
    if (isset($_POST['get_to_know_sub_heading_field_ar'])) {
        update_post_meta($post_id, '_get_to_know_sub_heading_field_ar', sanitize_text_field($_POST['get_to_know_sub_heading_field_ar']));
    }


    if (isset($_POST['total_workers'])) {
        update_post_meta($post_id, '_total_workers', sanitize_text_field($_POST['total_workers']));
    }

    if (isset($_POST['total_women'])) {
        update_post_meta($post_id, '_total_women', sanitize_text_field($_POST['total_women']));
    }
    // join us page metaboxes
    if (isset($_POST['join_hero_title_field_en'])) {
        update_post_meta($post_id, '_join_hero_title_field_en', sanitize_text_field($_POST['join_hero_title_field_en']));
    }
    if (isset($_POST['join_hero_title_field_ar'])) {
        update_post_meta($post_id, '_join_hero_title_field_ar', sanitize_text_field($_POST['join_hero_title_field_ar']));
    }
    // card section
    if (isset($_POST['join_card_title1_field_en'])) {
        update_post_meta($post_id, '_join_card_title1_field_en', sanitize_text_field($_POST['join_card_title1_field_en']));
    }
    if (isset($_POST['join_card_title1_field_ar'])) {
        update_post_meta($post_id, '_join_card_title1_field_ar', sanitize_text_field($_POST['join_card_title1_field_ar']));
    }

    if (isset($_POST['join_card_desc1_field_en'])) {
        update_post_meta($post_id, '_join_card_desc1_field_en', sanitize_text_field($_POST['join_card_desc1_field_en']));
    }
    if (isset($_POST['join_card_desc1_field_ar'])) {
        update_post_meta($post_id, '_join_card_desc1_field_ar', sanitize_text_field($_POST['join_card_desc1_field_ar']));
    }
    // card 2 
    if (isset($_POST['join_card_title2_field_en'])) {
        update_post_meta($post_id, '_join_card_title2_field_en', sanitize_text_field($_POST['join_card_title2_field_en']));
    }
    if (isset($_POST['join_card_title2_field_ar'])) {
        update_post_meta($post_id, '_join_card_title2_field_ar', sanitize_text_field($_POST['join_card_title2_field_ar']));
    }

    if (isset($_POST['join_card_desc2_field_en'])) {
        update_post_meta($post_id, '_join_card_desc2_field_en', sanitize_text_field($_POST['join_card_desc2_field_en']));
    }
    if (isset($_POST['join_card_desc2_field_ar'])) {
        update_post_meta($post_id, '_join_card_desc2_field_ar', sanitize_text_field($_POST['join_card_desc2_field_ar']));
    }

    // card 3
    if (isset($_POST['join_card_title3_field_en'])) {
        update_post_meta($post_id, '_join_card_title3_field_en', sanitize_text_field($_POST['join_card_title3_field_en']));
    }
    if (isset($_POST['join_card_title3_field_ar'])) {
        update_post_meta($post_id, '_join_card_title3_field_ar', sanitize_text_field($_POST['join_card_title3_field_ar']));
    }

    if (isset($_POST['join_card_desc3_field_en'])) {
        update_post_meta($post_id, '_join_card_desc3_field_en', sanitize_text_field($_POST['join_card_desc3_field_en']));
    }
    if (isset($_POST['join_card_desc3_field_ar'])) {
        update_post_meta($post_id, '_join_card_desc3_field_ar', sanitize_text_field($_POST['join_card_desc3_field_ar']));
    }

    // video section
    // video 1
    if (isset($_POST['join_video_title1_field_en'])) {
        update_post_meta($post_id, '_join_video_title1_field_en', sanitize_text_field($_POST['join_video_title1_field_en']));
    }
    if (isset($_POST['join_video_title1_field_ar'])) {
        update_post_meta($post_id, '_join_video_title1_field_ar', sanitize_text_field($_POST['join_video_title1_field_ar']));
    }

    if (isset($_POST['join_video_desc1_field_en'])) {
        update_post_meta($post_id, '_join_video_desc1_field_en', sanitize_text_field($_POST['join_video_desc1_field_en']));
    }
    if (isset($_POST['join_video_desc1_field_ar'])) {
        update_post_meta($post_id, '_join_video_desc1_field_ar', sanitize_text_field($_POST['join_video_desc1_field_ar']));
    }
    if (isset($_POST['join_video1_link_field'])) {
        update_post_meta($post_id, '_join_video1_link_field', esc_url_raw($_POST['join_video1_link_field']));
    }
     // Save Uploaded Video
    //  if (!empty($_FILES['join_video1_upload_field']['name'])) {
    //     $upload = wp_handle_upload($_FILES['join_video1_upload_field'], ['test_form' => false]);
    //     if (isset($upload['url'])) {
    //         // Save video URL to post meta
    //         update_post_meta($post_id, '_join_video1_upload_field', esc_url_raw($upload['url']));
    //     }
    // }

    // Remove Video if Requested
    // if (!empty($_POST['remove_join_video1'])) {
    //     delete_post_meta($post_id, '_join_video1_upload_field');
    // }
    
    // video 2
     // Save Company Video Upload
    //  if (!empty($_FILES['company_video1_upload_field']['name'])) {
    //     $upload = wp_handle_upload($_FILES['company_video1_upload_field'], ['test_form' => false]);
    //     if (isset($upload['url'])) {
    //         update_post_meta($post_id, '_company_video1_upload_field', esc_url_raw($upload['url']));
    //     }
    // }

    // Remove Company Video
    // if (isset($_POST['remove_company_video1']) && $_POST['remove_company_video1'] == '1') {
    //     delete_post_meta($post_id, '_company_video1_upload_field');
    // }

     // Save Intro Video Upload
    //  if (!empty($_FILES['intro_video_upload_field']['name'])) {
    //     $upload = wp_handle_upload($_FILES['intro_video_upload_field'], ['test_form' => false]);
    //     if (isset($upload['url'])) {
    //         update_post_meta($post_id, '_intro_video_upload_field', esc_url_raw($upload['url']));
    //     }
    // }

    // Remove Intro Video
    // if (isset($_POST['remove_intro_video']) && $_POST['remove_intro_video'] == '1') {
    //     delete_post_meta($post_id, '_intro_video_upload_field');
    // }


    // Save Video Link
    if (isset($_POST['join_video_homeintrolink_field']) && !empty($_POST['join_video_homeintrolink_field'])) {
        update_post_meta($post_id, '_join_video_homeintrolink_field', esc_url_raw($_POST['join_video_homeintrolink_field']));
    }

    if (isset($_POST['join_video_aboutintrolink_field']) && !empty($_POST['join_video_aboutintrolink_field'])) {
        update_post_meta($post_id, '_join_video_aboutintrolink_field', esc_url_raw($_POST['join_video_aboutintrolink_field']));
    }

    if (isset($_POST['join_video_link1_field']) && !empty($_POST['join_video_link1_field'])) {
        update_post_meta($post_id, '_join_video_link1_field', esc_url_raw($_POST['join_video_link1_field']));
    }

    if (isset($_POST['join_video_link2_field']) && !empty($_POST['join_video_link2_field'])) {
        update_post_meta($post_id, '_join_video_link2_field', esc_url_raw($_POST['join_video_link2_field']));
    }

    // Handle Video Removal
    // if (isset($_POST['remove_join_video1']) && $_POST['remove_join_video1'] == '1') {
    //     delete_post_meta($post_id, '_join_video_link1_field');
    // }
    if (isset($_POST['join_video_title2_field_en'])) {
        update_post_meta($post_id, '_join_video_title2_field_en', sanitize_text_field($_POST['join_video_title2_field_en']));
    }
    if (isset($_POST['join_video_title2_field_ar'])) {
        update_post_meta($post_id, '_join_video_title2_field_ar', sanitize_text_field($_POST['join_video_title2_field_ar']));
    }

    if (isset($_POST['join_video_desc2_field_en'])) {
        update_post_meta($post_id, '_join_video_desc2_field_en', sanitize_text_field($_POST['join_video_desc2_field_en']));
    }
    if (isset($_POST['join_video_desc2_field_ar'])) {
        update_post_meta($post_id, '_join_video_desc2_field_ar', sanitize_text_field($_POST['join_video_desc2_field_ar']));
    }
}
add_action('save_post', 'save_translation_meta_boxes');


// team slider custom fields

function display_person_images_meta_box($post) {
    // Get the existing slides data
    $slides = get_post_meta($post->ID, 'person_slider_images', true);
    ?>
    <div id="person-slider-wrapper">
        <?php
        if (!empty($slides)) {
            foreach ($slides as $index => $slide) { ?>
                <div class="person-slider-slide" style="margin-bottom: 20px;">
                    <h3 class="accordion-header">
                        <button type="button" class="accordion-toggle" data-index="<?php echo $index; ?>">
                            Slide <?php echo $index + 1; ?>
                        </button>
                    </h3>
                    <div class="accordion-content" style="display: none;">
                        <?php for ($i = 1; $i <= 6; $i++) { ?>
                            <p><strong>Person Image <?php echo $i; ?>:</strong></p>
                            <input type="text" name="person_slider[<?php echo $index; ?>][person_image_<?php echo $i; ?>]" value="<?php echo isset($slide['person_image_' . $i]) ? esc_url($slide['person_image_' . $i]) : ''; ?>" />
                            <input type="button" class="button upload-image-button" value="Upload Image" />

                            <p><strong>Hover Image <?php echo $i; ?>:</strong></p>
                            <input type="text" name="person_slider[<?php echo $index; ?>][hover_image_<?php echo $i; ?>]" value="<?php echo isset($slide['hover_image_' . $i]) ? esc_url($slide['hover_image_' . $i]) : ''; ?>" />
                            <input type="button" class="button upload-image-button" value="Upload Hover Image" />

                            <div class="textfields" style="margin-bottom:20px; display:flex; flex-wrap:wrap; gap:2%">
                                <!-- name -->
                                <div style="width: 49%">
                                    <p><strong>Name (English) <?php echo esc_html($i); ?>:</strong></p>
                                    <input type="text" name="person_slider[<?php echo esc_attr($index); ?>][name_<?php echo esc_attr($i); ?>]" value="<?php echo isset($slide['name_' . $i]) ? esc_attr($slide['name_' . $i]) : ''; ?>" class="widefat" />
                                </div>
                                <div style="width: 49%">
                                    <p><strong>Name (Arabic) <?php echo esc_html($i); ?>:</strong></p>
                                    <input type="text" name="person_slider[<?php echo esc_attr($index); ?>][name_ar_<?php echo esc_attr($i); ?>]" value="<?php echo isset($slide['name_ar_' . $i]) ? esc_attr($slide['name_ar_' . $i]) : ''; ?>" class="widefat" />
                                </div>
                                

                                <!-- designation -->
                               <div style="width: 49%">
                                <p><strong>Designation (English) <?php echo esc_html($i); ?>:</strong></p>
                                <input type="text" name="person_slider[<?php echo esc_attr($index); ?>][designation_<?php echo esc_attr($i); ?>]" value="<?php echo isset($slide['designation_' . $i]) ? esc_attr($slide['designation_' . $i]) : ''; ?>" class="widefat" />
                               </div>
                               <div style="width: 49%">
                                <p><strong>Designation (Arabic) <?php echo esc_html($i); ?>:</strong></p>
                                <input type="text" name="person_slider[<?php echo esc_attr($index); ?>][designation_ar_<?php echo esc_attr($i); ?>]" value="<?php echo isset($slide['designation_ar_' . $i]) ? esc_attr($slide['designation_ar_' . $i]) : ''; ?>" class="widefat" />
                               </div>
                            </div>
                            <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                        <?php } ?>
                        <a href="#" class="remove-slide button">Remove Slide</a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <p>
        <a href="#" id="add-new-slide" class="button">Add New Slide</a>
    </p>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = document.querySelectorAll('#person-slider-wrapper .person-slider-slide').length;

            // Function to handle image uploading
            function handleImageUpload(button) {
                const inputField = button.previousElementSibling;

                // Create the media frame
                const mediaFrame = wp.media({
                    title: 'Select or Upload Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                // When an image is selected, run a callback.
                mediaFrame.on('select', function() {
                    const attachment = mediaFrame.state().get('selection').first().toJSON();
                    inputField.value = attachment.url; // Set the image URL in the input field
                });

                // Open the media frame.
                mediaFrame.open();
            }

            // Add new slide functionality
            document.getElementById('add-new-slide').addEventListener('click', function(e) {
                e.preventDefault();

                let newSlide = document.createElement('div');
                newSlide.classList.add('person-slider-slide');
                newSlide.style.marginBottom = '20px';
                newSlide.innerHTML = `<h3 class="accordion-header"><button type="button" class="accordion-toggle" data-index="${slideIndex}">Slide ${slideIndex + 1}</button></h3><div class="accordion-content" style="display: none;">`;

                for (let i = 1; i <= 6; i++) {
                    newSlide.innerHTML += `
                        <p><strong>Person Image ${i}:</strong></p>
                        <input type="text" name="person_slider[${slideIndex}][person_image_${i}]" class="image-url" value="" />
                        <input type="button" class="button upload-image-button" value="Upload Image" />

                        <p><strong>Hover Image ${i}:</strong></p>
                        <input type="text" name="person_slider[${slideIndex}][hover_image_${i}]" class="hover-url" value="" />
                        <input type="button" class="button upload-image-button" value="Upload Hover Image" />

                        <div class="textfields" style="margin-bottom:20px;display:flex;flex-wrap:wrap; gap:2%">
                            <div style="width: 49%">
                                <p><strong>Name (English) ${i}:</strong></p>
                                <input type="text" name="person_slider[${slideIndex}][name_${i}]" class="widefat" value="" />
                            </div>
                            <div style="width: 49%">
                                <p><strong>Name (Arabic) ${i}:</strong></p>
                                <input type="text" name="person_slider[${slideIndex}][name_ar_${i}]" class="widefat" value="" />
                            </div>


                            <div style="width: 49%">
                                <p><strong>Designation (English) ${i}:</strong></p>
                                <input type="text" name="person_slider[${slideIndex}][designation_${i}]" class="widefat" value="" />
                            </div>
                            <div style="width: 49%">
                                <p><strong>Designation (Arabic) ${i}:</strong></p>
                                <input type="text" name="person_slider[${slideIndex}][designation_ar_${i}]" class="widefat" value="" />
                            </div>
                        </div>
                        <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                    `;
                }

                newSlide.innerHTML += `</div><a href="#" class="remove-slide button">Remove Slide</a>`;
                document.getElementById('person-slider-wrapper').appendChild(newSlide);
                slideIndex++;

                // Attach the image uploader and remove button to the new slide
                addSlideEventListeners(newSlide);
            });

            // Attach event listeners for each existing slide
            const slides = document.querySelectorAll('.person-slider-slide');
            slides.forEach(slide => {
                addSlideEventListeners(slide);
            });

            // Function to attach event listeners for image upload and remove button
            function addSlideEventListeners(slide) {
                const uploadButtons = slide.querySelectorAll('.upload-image-button');
                const removeButton = slide.querySelector('.remove-slide');

                // Attach image upload functionality to each button
                uploadButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                // Remove slide functionality
                if (removeButton) {
                    removeButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        slide.remove();
                    });
                }

                // Accordion toggle functionality
                const accordionButton = slide.querySelector('.accordion-toggle');
                const accordionContent = slide.querySelector('.accordion-content');
                accordionButton.addEventListener('click', function() {
                    if (accordionContent.style.display === 'none') {
                        accordionContent.style.display = 'block';
                    } else {
                        accordionContent.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <?php
}

add_action("add_meta_boxes", "add_custom_meta_boxes_for_about_and_home");

function save_person_slider($post_id) {
    // Verify if this is an auto-save routine.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;

    // Verify nonce here (if you added one) for security.

    // Only save on the "About" page (replace 123 with your actual About page ID)
    $about_page = get_page_by_path('about-us');

    if (isset($_POST['person_slider'])) 
    {
        // Get the array from the POST data
        $personslider_data = $_POST['person_slider'];
        // Re-index the array to ensure consistent numeric keys
        $personslider_data = array_values($personslider_data);
        // If the slider data is empty, delete the meta
        if (empty($personslider_data)) {
            delete_post_meta($post_id, 'person_slider_images');
        } else {
            // Otherwise, update the post meta with the slider data
            update_post_meta($post_id, 'person_slider_images', $personslider_data);
        }
    }else {
        delete_post_meta($post_id, 'person_slider_images');
    }
}
add_action('save_post', 'save_person_slider');


// timeline slider

// Function to display the meta box for Timeline Slider on the About page
function display_timeline_images_meta_box($post) {
    // Get the existing slides data
    $slides = get_post_meta($post->ID, 'timeline_slider_images', true);
    ?>
    <div id="timeline-slider-wrapper">
        <?php
        if (!empty($slides)) {
            foreach ($slides as $index => $slide) { ?>
                <div class="timeline-slider-slide" style="margin-bottom: 20px;">
                    <h3 class="accordion-header">
                        <button type="button" class="accordion-toggle2" data-index="<?php echo $index; ?>">
                            Slide <?php echo $index + 1; ?>
                        </button>
                    </h3>
                    <div class="accordion-content2" style="display: none;">
                        <!-- Image Upload -->
                        <p><strong>Image:</strong></p>
                        <input type="text" name="timeline_slider[<?php echo $index; ?>][image]" value="<?php echo isset($slide['image']) ? esc_url($slide['image']) : ''; ?>" />
                        <input type="button" class="button upload-image-button" value="Upload Image" />

                        <!-- Title -->
                        <p><strong>Title:</strong></p>
                        <input type="text" name="timeline_slider[<?php echo $index; ?>][title]" value="<?php echo isset($slide['title']) ? esc_attr($slide['title']) : ''; ?>" class="widefat" />
                        <p><strong>Title (Arabic):</strong></p>
                        <input type="text" name="timeline_slider[<?php echo $index; ?>][title_ar]" value="<?php echo isset($slide['title_ar']) ? esc_attr($slide['title_ar']) : ''; ?>" class="widefat" />
                        <!-- Description -->
                        <p><strong>Description:</strong></p>
                        <textarea name="timeline_slider[<?php echo $index; ?>][description]" class="widefat"><?php echo isset($slide['description']) ? esc_textarea($slide['description']) : ''; ?></textarea>

                        <p><strong>Description (Arabic):</strong></p>
                        <textarea name="timeline_slider[<?php echo $index; ?>][description_ar]" class="widefat"><?php echo isset($slide['description_ar']) ? esc_textarea($slide['description_ar']) : ''; ?></textarea>

                        <!-- Year -->
                        <p><strong>Year:</strong></p>
                        <input type="text" name="timeline_slider[<?php echo $index; ?>][year]" value="<?php echo isset($slide['year']) ? esc_attr($slide['year']) : ''; ?>" class="widefat" />

                        <p><a href="#" class="remove-slide button">Remove Slide</a></p>
                        <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <p>
        <a href="#" id="add-new-timeline-slide" class="button">Add New Slide</a>
    </p>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = document.querySelectorAll('#timeline-slider-wrapper .timeline-slider-slide').length;

            function handleImageUpload(button) {
                const inputField = button.previousElementSibling;

                const mediaFrame = wp.media({
                    title: 'Select or Upload Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    const attachment = mediaFrame.state().get('selection').first().toJSON();
                    inputField.value = attachment.url;
                });

                mediaFrame.open();
            }

            document.getElementById('add-new-timeline-slide').addEventListener('click', function(e) {
                e.preventDefault();

                let newSlide = document.createElement('div');
                newSlide.classList.add('timeline-slider-slide');
                newSlide.style.marginBottom = '20px';
                newSlide.innerHTML = `<h3 class="accordion-header"><button type="button" class="accordion-toggle2" data-index="${slideIndex}">Slide ${slideIndex + 1}</button></h3><div class="accordion-content" style="display: none;">`;

                newSlide.innerHTML += `
                    <p><strong>Image:</strong></p>
                    <input type="text" name="timeline_slider[${slideIndex}][image]" class="image-url" value="" />
                    <input type="button" class="button upload-image-button" value="Upload Image" />

                    <p><strong>Title:</strong></p>
                    <input type="text" name="timeline_slider[${slideIndex}][title]" class="widefat" value="" />

                    <p><strong>Title (Arabic):</strong></p>
                    <input type="text" name="timeline_slider[${slideIndex}][title_ar]" class="widefat" value="" />

                    <p><strong>Description:</strong></p>
                    <textarea name="timeline_slider[${slideIndex}][description]" class="widefat"></textarea>

                     <p><strong>Description (Arabic):</strong></p>
                    <textarea name="timeline_slider[${slideIndex}][description_ar]" class="widefat"></textarea>

                    <p><strong>Year:</strong></p>
                    <input type="text" name="timeline_slider[${slideIndex}][year]" class="widefat" value="" />
                    <p></p>
                    <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                `;

                newSlide.innerHTML += `</div><a href="#" class="remove-slide button">Remove Slide</a>`;
                document.getElementById('timeline-slider-wrapper').appendChild(newSlide);
                slideIndex++;

                addSlideEventListeners(newSlide);
            });

            const slides = document.querySelectorAll('.timeline-slider-slide');
            slides.forEach(slide => {
                addSlideEventListeners(slide);
            });

            function addSlideEventListeners(slide) {
                const uploadButtons = slide.querySelectorAll('.upload-image-button');
                const removeButton = slide.querySelector('.remove-slide');

                uploadButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                if (removeButton) {
                    removeButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        slide.remove();
                    });
                }

                const accordionButton = slide.querySelector('.accordion-toggle2');
                const accordionContent = slide.querySelector('.accordion-content2');
                accordionButton.addEventListener('click', function() {
                    accordionContent.style.display = accordionContent.style.display === 'none' ? 'block' : 'none';
                });
            }
        });
    </script>
    <?php
}

// Add the meta box for the Timeline Slider, only for the About page
function add_custom_meta_boxes_for_timeline() {
    global $post;

    // Check if we are on the "About" page by slug
    $about_page_slug = 'about-us'; // Replace this with the actual slug of your About page
    if ($post && $post->post_name === $about_page_slug) {
        add_meta_box(
            'timeline_slider_meta_box', // ID of the meta box
            'Timeline Slider', // Title of the meta box
            'display_timeline_images_meta_box', // Callback function
            'page', // Post type (pages in this case)
            'normal', // Context (where the box appears)
            'high' // Priority (how high the box is displayed)
        );
    }
}
add_action("add_meta_boxes", "add_custom_meta_boxes_for_timeline");

// Save the meta box data
function save_timeline_slider($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;

    if (isset($_POST['timeline_slider'])) 
    {
        // Get the array from the POST data
        $timlineslider_data = $_POST['timeline_slider'];
         // Re-index the array to ensure consistent numeric keys
         $timlineslider_data = array_values($timlineslider_data);
        // If the slider data is empty, delete the meta
        if (empty($timlineslider_data)) {
            delete_post_meta($post_id, 'timeline_slider_images');
        } else {
            // Otherwise, update the post meta with the slider data
            update_post_meta($post_id, 'timeline_slider_images', $timlineslider_data);
        }
    }else {
        delete_post_meta($post_id, 'timeline_slider_images');
    }
    
}
add_action('save_post', 'save_timeline_slider');



// home slider 1

function display_homeslider1_images_meta_box($post) {
    // Get the existing slides data
    $slides = get_post_meta($post->ID, 'homeslider1_slider_images', true);
    ?>
    <div id="homeslider1-slider-wrapper">
        <?php
        if (!empty($slides)) {
            foreach ($slides as $index => $slide) { ?>
                <div class="homeslider1-slider-slide" style="margin-bottom: 20px;">
                    <h3 class="accordion-header">
                        <button type="button" class="accordion-toggle2" data-index="<?php echo $index; ?>">
                            Slide <?php echo $index + 1; ?>
                        </button>
                    </h3>
                    <div class="accordion-content3" style="display: none;">
                        <!-- Image Upload -->
                         <!-- Color Picker -->
                        <p><strong>Background Color:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][color]" value="<?php echo isset($slide['color']) ? esc_attr($slide['color']) : ''; ?>"  />
                        <p><strong>Image:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][image]" value="<?php echo isset($slide['image']) ? esc_url($slide['image']) : ''; ?>" />
                        <input type="button" class="button upload-image-button" value="Upload Image" />

                        Additional Single Image Field
                        <p><strong>Single Image:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][single_image]" value="<?php echo isset($slide['single_image']) ? esc_url($slide['single_image']) : ''; ?>" />
                        <input type="button" class="button upload-single-image-button" value="Upload Single Image" />

                        <!-- Title -->
                        <p><strong>Title:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][title]" value="<?php echo isset($slide['title']) ? esc_attr($slide['title']) : ''; ?>" class="widefat" />
                        <p><strong>Title (Arabic):</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][title_ar]" value="<?php echo isset($slide['title_ar']) ? esc_attr($slide['title_ar']) : ''; ?>" class="widefat" />

                        <!-- Description -->
                        <p><strong>Description:</strong></p>
                        <textarea name="homeslider1_slider[<?php echo $index; ?>][description]" class="widefat"><?php echo isset($slide['description']) ? esc_textarea($slide['description']) : ''; ?></textarea>
                        <!-- Description ar -->
                        <p><strong>Description arabic:</strong></p>
                        <textarea name="homeslider1_slider[<?php echo $index; ?>][description_ar]" class="widefat"><?php echo isset($slide['description_ar']) ? esc_textarea($slide['description_ar']) : ''; ?></textarea>

                        <!-- sub description -->
                        <p><strong>Sub description:</strong></p>
                        <textarea name="homeslider1_slider[<?php echo $index; ?>][sub_description]" class="widefat"><?php echo isset($slide['sub_description']) ? esc_textarea($slide['sub_description']) : ''; ?></textarea>
                        <!-- sub Description ar -->
                        <p><strong>Sub description arabic:</strong></p>
                        <textarea name="homeslider1_slider[<?php echo $index; ?>][sub_description_ar]" class="widefat"><?php echo isset($slide['sub_description_ar']) ? esc_textarea($slide['sub_description_ar']) : ''; ?></textarea>
                        <!-- Orders -->
                         <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][orders]" value="<?php echo isset($slide['orders']) ? esc_attr($slide['orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Per week:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][per_week]" value="<?php echo isset($slide['per_week']) ? esc_attr($slide['per_week']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Per week arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][per_week_ar]" value="<?php echo isset($slide['per_week_ar']) ? esc_attr($slide['per_week_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                        <!-- ice cream Orders -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Ice Cream Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][ice_cream_orders]" value="<?php echo isset($slide['ice_cream_orders']) ? esc_attr($slide['ice_cream_orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Ice Cream Orders AR:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][ice_cream_orders_ar]" value="<?php echo isset($slide['ice_cream_orders_ar']) ? esc_attr($slide['ice_cream_orders_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][ice_cream_per_year]" value="<?php echo isset($slide['ice_cream_per_year']) ? esc_attr($slide['ice_cream_per_year']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][ice_cream_per_year_ar]" value="<?php echo isset($slide['ice_cream_per_year_ar']) ? esc_attr($slide['ice_cream_per_year_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>
                         

                        <!-- Stores -->
                        <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Stores:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][stores]" value="<?php echo isset($slide['stores']) ? esc_attr($slide['stores']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Store desc:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][stores_desc]" value="<?php echo isset($slide['stores_desc']) ? esc_attr($slide['stores_desc']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Stores desc arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][stores_desc_ar]" value="<?php echo isset($slide['stores_desc_ar']) ? esc_attr($slide['stores_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                         <!-- cake Orders -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Cake Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][cake_orders]" value="<?php echo isset($slide['cake_orders']) ? esc_attr($slide['cake_orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Cake Orders AR:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][cake_orders_ar]" value="<?php echo isset($slide['cake_orders_ar']) ? esc_attr($slide['cake_orders_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Cake per year:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][cake_per_year]" value="<?php echo isset($slide['cake_per_year']) ? esc_attr($slide['cake_per_year']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Cake per year arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[<?php echo $index; ?>][cake_per_year_ar]" value="<?php echo isset($slide['cake_per_year_ar']) ? esc_attr($slide['cake_per_year_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>

                        <!-- Button Text -->
                        <p><strong>Button Text:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][button_text]" value="<?php echo isset($slide['button_text']) ? esc_attr($slide['button_text']) : ''; ?>" class="widefat" />

                        <!-- Button Text arabic-->
                        <p><strong>Button Text arabic:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][button_text_ar]" value="<?php echo isset($slide['button_text_ar']) ? esc_attr($slide['button_text_ar']) : ''; ?>" class="widefat" />

                        <!-- Button Link -->
                        <p><strong>Button Link:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][button_link]" value="<?php echo isset($slide['button_link']) ? esc_url($slide['button_link']) : ''; ?>" class="widefat" />
                        
                        <!-- Instagram Link -->
                        <p><strong>Instagram Link:</strong></p>
                        <input type="text" name="homeslider1_slider[<?php echo $index; ?>][instagram_link]" value="<?php echo isset($slide['instagram_link']) ? esc_url($slide['instagram_link']) : ''; ?>" class="widefat" />

                            <p><a href="#" class="remove-slide button">Remove Slide</a></p>
                            <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <p>
        <a href="#" id="add-new-homeslider1-slide" class="button">Add New Slide</a>
    </p>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = document.querySelectorAll('#homeslider1-slider-wrapper .homeslider1-slider-slide').length;

            function handleImageUpload(button) {
                const inputField = button.previousElementSibling;

                const mediaFrame = wp.media({
                    title: 'Select or Upload Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    const attachment = mediaFrame.state().get('selection').first().toJSON();
                    inputField.value = attachment.url;
                });

                mediaFrame.open();
            }

            document.getElementById('add-new-homeslider1-slide').addEventListener('click', function(e) {
                //   console.log("slideeeeee");
                e.preventDefault();
          
                let newSlide = document.createElement('div');
                newSlide.classList.add('homeslider1-slider-slide');
                newSlide.style.marginBottom = '20px';
                
                newSlide.innerHTML = `<h3 class="accordion-header"><button type="button" class="accordion-toggle2" data-index="${slideIndex}">Slide ${slideIndex + 1}</button></h3><div class="accordion-content3" style="display: none;">`;

                newSlide.innerHTML += `
                    <p><strong>Background Color:</strong></p>
                    <input type="text" name="homeslider1_slider[${slideIndex}][color]" value="" />
                    <p><strong>Image:</strong></p>
                    <input type="text" name="homeslider1_slider[${slideIndex}][image]" class="image-url" value="" />
                    <input type="button" class="button upload-image-button" value="Upload Image" />

                    <p><strong>Single Image:</strong></p>
                    <input type="text" name="homeslider1_slider[${slideIndex}][single_image]" class="single-image-url" value="" />
                    <input type="button" class="button upload-single-image-button" value="Upload Single Image" />

                    <p><strong>Title:</strong></p>
                    <input type="text" name="homeslider1_slider[${slideIndex}][title]" class="widefat" value="" />

                    <p><strong>Title (Arabic):</strong></p>
                    <input type="text" name="homeslider1_slider[${slideIndex}][title_ar]" class="widefat" value="" />

                    <p><strong>Description:</strong></p>
                    <textarea name="homeslider1_slider[${slideIndex}][description]" class="widefat"></textarea>

                    <p><strong>Description arabic:</strong></p>
                    <textarea name="homeslider1_slider[${slideIndex}][description_ar]" class="widefat"></textarea>
                    
                        <!-- sub description -->
                        <p><strong>Sub description:</strong></p>
                        <textarea name="homeslider1_slider[${slideIndex}][sub_description]" class="widefat"><?php echo isset($slide['sub_description']) ? esc_textarea($slide['sub_description']) : ''; ?></textarea>
                        <!-- sub Description ar -->
                        <p><strong>Sub description arabic:</strong></p>
                        <textarea name="homeslider1_slider[${slideIndex}][sub_description_ar]" class="widefat"><?php echo isset($slide['sub_description_ar']) ? esc_textarea($slide['sub_description_ar']) : ''; ?></textarea>
                     <!-- Orders -->
                         <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][orders]" value="<?php echo isset($slide['orders']) ? esc_attr($slide['orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Per week:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][per_week]" value="<?php echo isset($slide['per_week']) ? esc_attr($slide['per_week']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Per week arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][per_week_ar]" value="<?php echo isset($slide['per_week_ar']) ? esc_attr($slide['per_week_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                        <!-- ice cream Orders -->
                        
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Ice Cream Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][ice_cream_orders]" value="<?php echo isset($slide['ice_cream_orders']) ? esc_attr($slide['ice_cream_orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Ice Cream Orders AR:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][ice_cream_orders_ar]" value="<?php echo isset($slide['ice_cream_orders_ar']) ? esc_attr($slide['ice_cream_orders_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][ice_cream_per_year]" value="<?php echo isset($slide['ice_cream_per_year']) ? esc_attr($slide['ice_cream_per_year']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][ice_cream_per_year_ar]" value="<?php echo isset($slide['ice_cream_per_year_ar']) ? esc_attr($slide['ice_cream_per_year_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div> 
                        <!-- cake order per year -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Cake Orders:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][cake_orders]" value="<?php echo isset($slide['cake_orders']) ? esc_attr($slide['cake_orders']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Ice Cream Orders AR:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][cake_orders_ar]" value="<?php echo isset($slide['cake_orders_ar']) ? esc_attr($slide['cake_orders_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][cake_per_year]" value="<?php echo isset($slide['cake_per_year']) ? esc_attr($slide['cake_per_year']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Ice Cream per year arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][cake_per_year_ar]" value="<?php echo isset($slide['cake_per_year_ar']) ? esc_attr($slide['cake_per_year_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                        <!-- Stores -->
                        <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Stores:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][stores]" value="<?php echo isset($slide['stores']) ? esc_attr($slide['stores']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Store desc:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][stores_desc]" value="<?php echo isset($slide['stores_desc']) ? esc_attr($slide['stores_desc']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Stores desc arabic:</strong></p>
                                <input type="text" name="homeslider1_slider[${slideIndex}][stores_desc_ar]" value="<?php echo isset($slide['stores_desc_ar']) ? esc_attr($slide['stores_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>
                        <!-- Button Text -->
                        <p><strong>Button Text:</strong></p>
                        <input type="text" name="homeslider1_slider[${slideIndex}][button_text]" value="<?php echo isset($slide['button_text']) ? esc_attr($slide['button_text']) : ''; ?>" class="widefat" />

                        <!-- Button Text arabic -->
                        <p><strong>Button Text arabic:</strong></p>
                        <input type="text" name="homeslider1_slider[${slideIndex}][button_text_ar]" value="<?php echo isset($slide['button_text_ar']) ? esc_attr($slide['button_text_ar']) : ''; ?>" class="widefat" />

                        <!-- Button Link -->
                        <p><strong>Button Link:</strong></p>
                        <input type="text" name="homeslider1_slider[${slideIndex}][button_link]" value="<?php echo isset($slide['button_link']) ? esc_url($slide['button_link']) : ''; ?>" class="widefat" />
                        
                        <!-- Instagram Link -->
                        <p><strong>Instagram Link:</strong></p>
                        <input type="text" name="homeslider1_slider[${slideIndex}][instagram_link]" value="<?php echo isset($slide['instagram_link']) ? esc_url($slide['instagram_link']) : ''; ?>" class="widefat" />

                         <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                `;

                newSlide.innerHTML += `</div><a href="#" class="remove-slide button">Remove Slide</a>`;
                document.getElementById('homeslider1-slider-wrapper').appendChild(newSlide);
                slideIndex++;

                addSlideEventListeners(newSlide);
                
            });

            const slides = document.querySelectorAll('.homeslider1-slider-slide');
            slides.forEach(slide => {
                addSlideEventListeners(slide);
            });

            function addSlideEventListeners(slide) {
                const uploadButtons = slide.querySelectorAll('.upload-image-button');
                const uploadSingleImageButtons = slide.querySelectorAll('.upload-single-image-button');
                const removeButton = slide.querySelector('.remove-slide');
                console.log('alideindexx',slideIndex)
                uploadButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                uploadSingleImageButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                if (removeButton) {
                    removeButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        slide.remove();
                        console.log('Removed',slideIndex)
                       
                    });
                }

                const accordionButton = slide.querySelector('.accordion-toggle2');
                const accordionContent = slide.querySelector('.accordion-content3');
                accordionButton.addEventListener('click', function() {
                    accordionContent.style.display = accordionContent.style.display === 'none' ? 'block' : 'none';
                });
            }
        });
    </script>
    <?php
}

function add_custom_meta_boxes_for_homeslider1() {
    global $post;

    // Check if we are on the "About" page by slug
    $home_page_slug = 'home'; // Replace this with the actual slug of your About page
    if ($post && $post->post_name === $home_page_slug) {
        add_meta_box(
            'homeslider1_slider_meta_box', // ID of the meta box
            'Homeslider Slider1', // Title of the meta box
            'display_homeslider1_images_meta_box', // Callback function
            'page', // Post type (pages in this case)
            'normal', // Context (where the box appears)
            'high' // Priority (how high the box is displayed)
        );
    }
}
add_action("add_meta_boxes", "add_custom_meta_boxes_for_homeslider1");

// Save the meta box data
function save_homeslider1_slider($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;

        if (isset($_POST['homeslider1_slider'])) {
        // Get the array from the POST data
        $slider_data1 = $_POST['homeslider1_slider'];

        // Re-index the array to ensure consistent numeric keys
        $slider_data1 = array_values($slider_data1);
        // If the slider data is empty, delete the meta
        if (empty($slider_data1)) {
            delete_post_meta($post_id, 'homeslider1_slider_images');
        } else {
            // Otherwise, update the post meta with the slider data
            update_post_meta($post_id, 'homeslider1_slider_images', $slider_data1);
        }
    }else {
        delete_post_meta($post_id, 'homeslider1_slider_images');
        
    }
}
add_action('save_post', 'save_homeslider1_slider');
    


// home slider 2
function display_homeSlider2_images_meta_box($post) {
    // Get the existing slides data
    $slides2 = get_post_meta($post->ID, 'homeSlider2_slider_images', true);
    ?>
    <div id="homeSlider2-slider-wrapper">
        <?php
        if (!empty($slides2)) {
            foreach ($slides2 as $index => $slide) { ?>
                <div class="homeSlider2-slider-slide" style="margin-bottom: 20px;">
                    <h3 class="accordion-header">
                        <button type="button" class="accordion-toggle2" data-index="<?php echo $index; ?>">
                            Slide <?php echo $index + 1; ?>
                        </button>
                    </h3>
                    <div class="accordion-content4" style="display: none;">
                        <!-- Image Upload -->
                         <!-- Color Picker -->
                        <p><strong>Background Color:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][color]" value="<?php echo isset($slide['color']) ? esc_attr($slide['color']) : ''; ?>"  />
                        <p><strong>Image2:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][image]" value="<?php echo isset($slide['image']) ? esc_url($slide['image']) : ''; ?>" />
                        <input type="button" class="button upload-image-button" value="Upload Image" />

                        <!-- Additional Single Image Field -->
                        <p><strong>Single Image:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][single_image]" value="<?php echo isset($slide['single_image']) ? esc_url($slide['single_image']) : ''; ?>" />
                        <input type="button" class="button upload-single-image-button" value="Upload Single Image" />

                        <!-- Title -->
                        <p><strong>Title:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][title]" value="<?php echo isset($slide['title']) ? esc_attr($slide['title']) : ''; ?>" class="widefat" />
                        <p><strong>Title (Arabic):</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][title_ar]" value="<?php echo isset($slide['title_ar']) ? esc_attr($slide['title_ar']) : ''; ?>" class="widefat" />

                        <!-- Description -->
                        <p><strong>Description:</strong></p>
                        <textarea name="homeSlider2_slider[<?php echo $index; ?>][description]" class="widefat"><?php echo isset($slide['description']) ? esc_textarea($slide['description']) : ''; ?></textarea>
                        <!-- Description ar -->
                        <p><strong>Description arabic:</strong></p>
                        <textarea name="homeSlider2_slider[<?php echo $index; ?>][description_ar]" class="widefat"><?php echo isset($slide['description_ar']) ? esc_textarea($slide['description_ar']) : ''; ?></textarea>

                        

                         <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Dishes:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][dishes]" value="<?php echo isset($slide['dishes']) ? esc_attr($slide['dishes']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Dishes title:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][dish_title]" value="<?php echo isset($slide['dish_title']) ? esc_attr($slide['dish_title']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Dishes title arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][dish_title_ar]" value="<?php echo isset($slide['dish_title_ar']) ? esc_attr($slide['dish_title_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                        <!-- ice cream Orders -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Event:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][event]" value="<?php echo isset($slide['event']) ? esc_attr($slide['event']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Event AR:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][event_ar]" value="<?php echo isset($slide['event_ar']) ? esc_attr($slide['event_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Event text:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][event_text]" value="<?php echo isset($slide['event_text']) ? esc_attr($slide['event_text']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Event text arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][event_text_ar]" value="<?php echo isset($slide['event_text_ar']) ? esc_attr($slide['event_text_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>
                         

                        <!-- Stores -->
                        <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Rating:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][rating]" value="<?php echo isset($slide['rating']) ? esc_attr($slide['rating']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:20%">
                                <p><strong>Rating arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][rating_ar]" value="<?php echo isset($slide['rating_ar']) ? esc_attr($slide['rating_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Rating desc:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][rating_desc]" value="<?php echo isset($slide['rating_desc']) ? esc_attr($slide['rating_desc']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Rating desc arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][rating_desc_ar]" value="<?php echo isset($slide['rating_desc_ar']) ? esc_attr($slide['rating_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                         <!-- cake Orders -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Review:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][review]" value="<?php echo isset($slide['review']) ? esc_attr($slide['review']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>Review AR:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][review_ar]" value="<?php echo isset($slide['review_ar']) ? esc_attr($slide['review_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Review Desc:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][review_desc]" value="<?php echo isset($slide['review_desc']) ? esc_attr($slide['review_desc']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Review desc arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][review_desc_ar]" value="<?php echo isset($slide['review_desc_ar']) ? esc_attr($slide['review_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>

                        <!-- Button Text -->
                        <p><strong>Button Text:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][button_text]" value="<?php echo isset($slide['button_text']) ? esc_attr($slide['button_text']) : ''; ?>" class="widefat" />

                        <!-- Button Text arabic-->
                        <p><strong>Button Text arabic:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][button_text_ar]" value="<?php echo isset($slide['button_text_ar']) ? esc_attr($slide['button_text_ar']) : ''; ?>" class="widefat" />

                        <!-- Button Link -->
                        <p><strong>Button Link:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][button_link]" value="<?php echo isset($slide['button_link']) ? esc_url($slide['button_link']) : ''; ?>" class="widefat" />
                        
                        <!-- Instagram Link -->
                        <p><strong>Instagram Link:</strong></p>
                        <input type="text" name="homeSlider2_slider[<?php echo $index; ?>][instagram_link]" value="<?php echo isset($slide['instagram_link']) ? esc_url($slide['instagram_link']) : ''; ?>" class="widefat" />

                            <p><a href="#" class="remove-slide button">Remove Slide</a></p>
                            <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                        </div>
                    </div>
              
                <?php
            }
        }
        ?>
   </div>
   
    <p>
        <a href="#" id="add-new-homeSlider2-slide" class="button">Add New Slide</a>
    </p> 
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = document.querySelectorAll('#homeSlider2-slider-wrapper .homeSlider2-slider-slide').length;

            function handleImageUpload(button) {
                const inputField = button.previousElementSibling;

                const mediaFrame = wp.media({
                    title: 'Select or Upload Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                mediaFrame.on('select', function() {
                    const attachment = mediaFrame.state().get('selection').first().toJSON();
                    inputField.value = attachment.url;
                });

                mediaFrame.open();
            }

            document.getElementById('add-new-homeSlider2-slide').addEventListener('click', function(e) {
                e.preventDefault();
                

                let newSlide = document.createElement('div');
                newSlide.classList.add('homeSlider2-slider-slide');
                newSlide.style.marginBottom = '20px';
                newSlide.innerHTML = `<h3 class="accordion-header"><button type="button" class="accordion-toggle2" data-index="${slideIndex}">Slide ${slideIndex + 1}</button></h3><div class="accordion-content" style="display: none;">`;

                newSlide.innerHTML += `
                    <p><strong>Background Color:</strong></p>
                    <input type="text" name="homeSlider2_slider[${slideIndex}][color]" value="" />
                    <p><strong>Image2:</strong></p>
                    <input type="text" name="homeSlider2_slider[${slideIndex}][image]" class="image-url" value="" />
                    <input type="button" class="button upload-image-button" value="Upload Image" />

                    <p><strong>Single Image:</strong></p>
                    <input type="text" name="homeSlider2_slider[${slideIndex}][single_image]" class="single-image-url" value="" />
                    <input type="button" class="button upload-single-image-button" value="Upload Single Image" />

                    <p><strong>Title:</strong></p>
                    <input type="text" name="homeSlider2_slider[${slideIndex}][title]" class="widefat" value="" />

                    <p><strong>Title (Arabic):</strong></p>
                    <input type="text" name="homeSlider2_slider[${slideIndex}][title_ar]" class="widefat" value="" />

                    <p><strong>Description:</strong></p>
                    <textarea name="homeSlider2_slider[${slideIndex}][description]" class="widefat"></textarea>

                    <p><strong>Description arabic:</strong></p>
                    <textarea name="homeSlider2_slider[${slideIndex}][description_ar]" class="widefat"></textarea>
                    
                       
                     <!-- Orders -->
                         <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Dishes:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][dishes]" value="<?php echo isset($slide['dishes']) ? esc_attr($slide['dishes']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Dishes title:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][dish_title]" value="<?php echo isset($slide['dish_title']) ? esc_attr($slide['dish_title']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Dishes title arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][dish_title_ar]" value="<?php echo isset($slide['dish_title_ar']) ? esc_attr($slide['dish_title_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div>

                        <!-- ice cream Orders -->
                        <div style="display:flex; gap:10px">
                            <div style="width:15%">
                                <p><strong>Event:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][event]" value="<?php echo isset($slide['event']) ? esc_attr($slide['event']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:15%">
                                <p><strong>event AR:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][event_ar]" value="<?php echo isset($slide['event_ar']) ? esc_attr($slide['event_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Event text:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][event_text]" value="<?php echo isset($slide['event_text']) ? esc_attr($slide['event_text']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Event text arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][event_text_ar]" value="<?php echo isset($slide['event_text_ar']) ? esc_attr($slide['event_text_ar']) : ''; ?>" class="widefat" />
                            </div>
                         </div> 

                        <!-- Rating -->
                        <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Rating:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][rating]" value="<?php echo isset($slide['rating']) ? esc_attr($slide['rating']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Rating arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][rating_ar]" value="<?php echo isset($slide['rating_ar']) ? esc_attr($slide['rating_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Rating desc:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][rating_desc]" value="<?php echo isset($slide['rating_desc']) ? esc_attr($slide['rating_desc']) : ''; ?>" class="widefat" />
                            </div>

                            <div style="width:40%">
                                <p><strong>Rating desc arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][rating_desc_ar]" value="<?php echo isset($slide['rating_desc_ar']) ? esc_attr($slide['rating_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>

                        <div style="display:flex; gap:10px">
                            <div style="width:20%">
                                <p><strong>Review:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][review]" value="<?php echo isset($slide['review']) ? esc_attr($slide['review']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Review arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][review_ar]" value="<?php echo isset($slide['review_ar']) ? esc_attr($slide['review_ar']) : ''; ?>" class="widefat" />
                            </div>
                            <div style="width:40%">
                                <p><strong>Review desc:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][review_desc]" value="<?php echo isset($slide['review_desc']) ? esc_attr($slide['review_desc']) : ''; ?>" class="widefat" />
                            </div>

                            <div style="width:40%">
                                <p><strong>Review desc arabic:</strong></p>
                                <input type="text" name="homeSlider2_slider[${slideIndex}][review_desc_ar]" value="<?php echo isset($slide['review_desc_ar']) ? esc_attr($slide['review_desc_ar']) : ''; ?>" class="widefat" />
                            </div>
                        </div>
                        <!-- Button Text -->
                        <p><strong>Button Text:</strong></p>
                        <input type="text" name="homeSlider2_slider[${slideIndex}][button_text]" value="<?php echo isset($slide['button_text']) ? esc_attr($slide['button_text']) : ''; ?>" class="widefat" />

                        <!-- Button Text arabic -->
                        <p><strong>Button Text arabic:</strong></p>
                        <input type="text" name="homeSlider2_slider[${slideIndex}][button_text_ar]" value="<?php echo isset($slide['button_text_ar']) ? esc_attr($slide['button_text_ar']) : ''; ?>" class="widefat" />

                        <!-- Button Link -->
                        <p><strong>Button Link:</strong></p>
                        <input type="text" name="homeSlider2_slider[${slideIndex}][button_link]" value="<?php echo isset($slide['button_link']) ? esc_url($slide['button_link']) : ''; ?>" class="widefat" />
                        
                        <!-- Instagram Link -->
                        <p><strong>Instagram Link:</strong></p>
                        <input type="text" name="homeSlider2_slider[${slideIndex}][instagram_link]" value="<?php echo isset($slide['instagram_link']) ? esc_url($slide['instagram_link']) : ''; ?>" class="widefat" />

                         <hr style="border-top: 1px solid #ff6e21;border-bottom: 1px solid #ff6e21;"/>
                `;

                newSlide.innerHTML += `</div><a href="#" class="remove-slide button">Remove Slide</a>`;
                document.getElementById('homeSlider2-slider-wrapper').appendChild(newSlide);
                slideIndex++;

                addSlideEventListeners(newSlide);
            });

            const slides = document.querySelectorAll('.homeSlider2-slider-slide');
            slides.forEach(slide => {
                addSlideEventListeners(slide);
            });

           
            function addSlideEventListeners(slide) {
                const uploadButtons = slide.querySelectorAll('.upload-image-button');
                const uploadSingleImageButtons = slide.querySelectorAll('.upload-single-image-button');
                const removeButton = slide.querySelector('.remove-slide');

                uploadButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                uploadSingleImageButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        handleImageUpload(button);
                    });
                });

                if (removeButton) {
                    removeButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        slide.remove();
                    });
                }

                const accordionButton = slide.querySelector('.accordion-toggle2');
                const accordionContent = slide.querySelector('.accordion-content4');
                accordionButton.addEventListener('click', function() {
                    accordionContent.style.display = accordionContent.style.display === 'none' ? 'block' : 'none';
                });
            }
        });
    </script>
    <?php
}

// Add the meta box for the homeSlider2 Slider, only for the About page
function add_custom_meta_boxes_for_homeSlider2() {
    global $post;

    // Check if we are on the "About" page by slug
    $home_page_slug = 'home'; // Replace this with the actual slug of your About page
    if ($post && $post->post_name === $home_page_slug) {
        add_meta_box(
            'homeSlider2_slider_meta_box', // ID of the meta box
            'homeSlider2 Slider', // Title of the meta box
            'display_homeSlider2_images_meta_box', // Callback function
            'page', // Post type (pages in this case)
            'normal', // Context (where the box appears)
            'high' // Priority (how high the box is displayed)
        );
    }
}
add_action("add_meta_boxes", "add_custom_meta_boxes_for_homeSlider2");

// Save the meta box data
function save_homeSlider2_slider($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return;
   
    if (isset($_POST['homeSlider2_slider'])) {
        // Get the array from the POST data
        $slider_data = $_POST['homeSlider2_slider'];

         // Re-index the array to ensure consistent numeric keys
         $slider_data = array_values($slider_data);
        // If the slider data is empty, delete the meta
        if (empty($slider_data)) {
            delete_post_meta($post_id, 'homeSlider2_slider_images');
        } else {
            // Otherwise, update the post meta with the slider data
            update_post_meta($post_id, 'homeSlider2_slider_images', $slider_data);
        }
    }else {
        delete_post_meta($post_id, 'homeSlider2_slider_images');
    }
}
add_action('save_post', 'save_homeSlider2_slider');


// custom widgets
// Custom Widget Class
class Custom_HTML_Block_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'custom_html_block_widget', // Base ID
            'Custom HTML Block Widget', // Name
            array('description' => __('A Widget to display custom HTML block with PHP', 'zad')) // Args
        );
    }

    // Outputs the HTML for the widget
    public function widget($args, $instance) {
        echo $args['before_widget'];
        $page_id = get_the_ID();
        $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';

        // Fetch translations
        $mission_small_title_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_small_title_field_ar', true) : get_post_meta($page_id, '_mission_small_title_field_en', true);
        $mission_heading_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_heading_field_ar', true) : get_post_meta($page_id, '_mission_heading_field_en', true);
        $mission_sub_heading_field_content = ($current_language === 'ar') ? get_post_meta($page_id, '_mission_sub_heading_field_ar', true) : get_post_meta($page_id, '_mission_sub_heading_field_en', true);
      
        // our people section
        $people_small_title_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_small_title_field_ar', true) : get_post_meta($page_id, '_people_small_title_field_en', true);
        $people_heading_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_heading_field_ar', true) : get_post_meta($page_id, '_people_heading_field_en', true);
        $people_sub_heading_content = ($current_language === 'ar') ? get_post_meta($page_id, '_people_sub_heading_field_ar', true) : get_post_meta($page_id, '_people_sub_heading_field_en', true);
        // Display the custom HTML entered by the user with PHP execution
        if (!empty($instance['custom_html'])) {
            echo '<div class="custom-html-block">';
            // Execute PHP code inside the custom HTML
            eval('?>' . $instance['custom_html']);
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    // Widget form in the admin area (for adding custom HTML with PHP)
    public function form($instance) {
        // Retrieve saved custom HTML or set default empty value
        $custom_html = !empty($instance['custom_html']) ? $instance['custom_html'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('custom_html'); ?>"><?php _e('Custom HTML with PHP:', 'zad'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('custom_html'); ?>" name="<?php echo $this->get_field_name('custom_html'); ?>" rows="10"><?php echo esc_textarea($custom_html); ?></textarea>
        </p>
        <?php
    }

    // Save widget form data
    public function update($new_instance, $old_instance) {
        $instance = array();
        // Store custom HTML with PHP
        $instance['custom_html'] = (!empty($new_instance['custom_html'])) ? $new_instance['custom_html'] : '';
        return $instance;
    }
}

// Register the widget
function register_custom_html_block_widget() {
    register_widget('Custom_HTML_Block_Widget');
}
add_action('widgets_init', 'register_custom_html_block_widget');


function register_custom_widget_areas() {
    // Register the main sidebar (if not already registered)
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'zad' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Main sidebar that appears on the right.', 'zad' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    // Register a new widget area below the sidebar
    register_sidebar( array(
        'name'          => __( 'About us page widget', 'zad' ),
        'id'            => 'below-sidebar',
        'description'   => __( 'A widget area that appears below the main sidebar.', 'zad' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Home page widget', 'zad' ),
        'id'            => 'below-sidebar2',
        'description'   => __( 'A widget area that appears below the main sidebar.', 'zad' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'register_custom_widget_areas' );


// gallery

function create_gallery_post_type() {
    register_post_type('gallery_item',
        array(
            'labels' => array(
                'name' => __('Gallery Items'),
                'singular_name' => __('Gallery Item')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'thumbnail'),
            'menu_icon' => 'dashicons-format-gallery',
        )
    );
}
add_action('init', 'create_gallery_post_type');
function add_gallery_meta_box() {
    add_meta_box(
        'gallery_images_meta_box', 
        'Gallery Images', 
        'display_gallery_meta_box', 
        'gallery_item', 
        'normal', 
        'high'
    );
}
add_action('add_meta_boxes', 'add_gallery_meta_box');

function display_gallery_meta_box($post) {
    $gallery_images = get_post_meta($post->ID, 'gallery_images', true);
    $arabic_title = get_post_meta($post->ID, 'arabic_title', true);
    wp_nonce_field(basename(__FILE__), 'gallery_images_nonce');
    ?>
    <div>
        <label for="arabic-title">Arabic Title:</label>
        <input type="text" id="arabic-title" name="arabic_title" value="<?php echo esc_attr($arabic_title); ?>" style="width: 100%;" placeholder="Arabic Title"/>
    </div>
    <br>
    <div id="gallery-images-wrapper">
        <?php if (!empty($gallery_images)) :
            foreach ($gallery_images as $index => $image) { ?>
                <div class="gallery-image-row">
                    <input type="text" name="gallery_images[<?php echo $index; ?>][url]" value="<?php echo esc_url($image['url']); ?>" placeholder="Image URL" style="width: 70%;" />
                    <button class="upload-image-button button" type="button">Upload Image</button>
                    <button class="remove-image" type="button">Remove</button>
                </div>
            <?php }
        endif; ?>
    </div>
    <button id="add-gallery-image" type="button">Add Image</button>
    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const addImageBtn = document.getElementById('add-gallery-image');
        const imagesWrapper = document.getElementById('gallery-images-wrapper');

        addImageBtn.addEventListener('click', () => {
            const index = imagesWrapper.children.length;
            const row = document.createElement('div');
            row.className = 'gallery-image-row';
            row.innerHTML = `
                <input type="text" name="gallery_images[${index}][url]" placeholder="Image URL" style="width: 70%;" />
                <button class="upload-image-button button" type="button">Upload Image</button>
                <button class="remove-image" type="button">Remove</button>
            `;
            row.querySelector('.remove-image').addEventListener('click', () => row.remove());
            row.querySelector('.upload-image-button').addEventListener('click', openMediaUploader);
            imagesWrapper.appendChild(row);
        });

        function openMediaUploader(event) {
            event.preventDefault();
            const inputField = event.target.previousElementSibling;
            const mediaUploader = wp.media({
                title: 'Select or Upload an Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            }).on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.value = attachment.url;
            }).open();
        }

        document.querySelectorAll('.upload-image-button').forEach(btn => {
            btn.addEventListener('click', openMediaUploader);
        });

        document.querySelectorAll('.remove-image').forEach(btn => {
            btn.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    });
    </script>

    <style>
        #gallery-images-wrapper { margin-bottom: 10px; }
        .gallery-image-row { margin-bottom: 5px; display: flex; align-items: center; }
        .upload-image-button { margin-left: 5px; }
        .remove-image { margin-left: 10px; color: red; cursor: pointer; }
    </style>
    <?php
}

function save_gallery_images_meta($post_id) {
    if (!isset($_POST['gallery_images_nonce']) || !wp_verify_nonce($_POST['gallery_images_nonce'], basename(__FILE__))) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['gallery_images'])) {
        $gallery_images = array_filter($_POST['gallery_images'], function($image) {
            return !empty($image['url']);
        });
        update_post_meta($post_id, 'gallery_images', $gallery_images);
    } else {
        delete_post_meta($post_id, 'gallery_images');
    }
     // Save Arabic title
     if (isset($_POST['arabic_title'])) {
        update_post_meta($post_id, 'arabic_title', sanitize_text_field($_POST['arabic_title']));
    } else {
        delete_post_meta($post_id, 'arabic_title');
    }
}
add_action('save_post', 'save_gallery_images_meta');


function translate_contact_form_7($content) {
    // Detect Arabic (Adjust according to your site’s setup)
    if (isset($_COOKIE['site_language']) && $_COOKIE['site_language'] == 'ar') {
        $content = str_replace('Your name*', 'الاسم', $content);
        $content = str_replace('Your e-mail*', 'البريد الإلكتروني', $content);
        $content = str_replace('Subject*', 'الموضوع', $content);
        $content = str_replace('Your phone*', 'رقم الهاتف', $content);
        $content = str_replace('Your message', 'رسالتك', $content);
        $content = str_replace('Send Message', 'إرسال الرسالة', $content);
        $content = str_replace('Join us now', 'انضم إلينا الآن', $content);
        $content = str_replace('Enter your first name', 'أدخل اسمك الأول', $content);
        $content = str_replace('Enter your last name', 'أدخل اسم العائلة', $content);
        $content = str_replace('Enter an e-mail address', 'أدخل عنوان البريد الإلكتروني', $content);
        $content = str_replace("Enter a position you are applying for", 'أدخل الوظيفة التي تتقدم لها', $content);

        // Translate labels (adjust based on actual labels in your form)
        $content = str_replace('Name', 'اسم', $content);
        $content = str_replace('Address', 'عنوان', $content);
        $content = str_replace('have you ever owned a business?', 'هل سبق لك أن امتلكت عملاً تجاريًا؟', $content);
        $content = str_replace('From where did you hear about us?', 'من أين سمعت عنا؟', $content);
        $content = str_replace('Where do you plan to open your franchise?', 'أين تخطط لفتح الامتياز الخاص بك؟', $content);
        $content = str_replace('additional information or comments box', 'معلومات إضافية أو مربع التعليقات', $content);
        $content = str_replace('Yes', 'نعم', $content);
        $content = str_replace('One or more fields have an error. Please check and try again.', 'يوجد خطأ في أحد الحقول أو أكثر. يرجى التحقق والمحاولة مرة أخرى.', $content);
        $content = str_replace('Submit request', 'إرسال الطلب', $content);
        $content = str_replace('No', 'لا', $content);
        $content = str_replace('Add', 'يضيف', $content);
        $content = str_replace('First name', 'الاسم الأول', $content);
        $content = str_replace('Last name', 'اسم العائلة', $content);
        $content = str_replace('Phone number', 'رقم الهاتف', $content);
        $content = str_replace('E-mail', 'البريد الإلكتروني', $content);
        $content = str_replace('Vacancy', 'الوظيفة المطلوبة', $content);
        $content = str_replace('CV or resume', 'السيرة الذاتية', $content);
    
    }
    return $content;
}
add_filter('wpcf7_form_elements', 'translate_contact_form_7');


// banner dynamic

// 1️⃣ Create Custom Settings Page
function custom_banner_settings_menu() {
    add_menu_page(
        'Banner Settings',
        'Banners',
        'manage_options',
        'custom-banner-settings',
        'custom_banner_settings_page',
        'dashicons-format-image',
        30
    );
}
add_action('admin_menu', 'custom_banner_settings_menu');

// 2️⃣ Display the Settings Page
function custom_banner_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['save_banner_settings'])) {
        update_option('banner_images', $_POST['banner_images']);
    }

    $banners = get_option('banner_images', []);
    ?>
    <div class="wrap">
        <h1>Banner Settings</h1>
        <form method="post">
            <div id="banner-container">
                <?php if (!empty($banners)) : ?>
                    <?php foreach ($banners as $index => $banner) : ?>
                        <div class="banner-item" style="margin-bottom: 20px;">
                            <input type="text" name="banner_images[<?php echo $index; ?>][url]" value="<?php echo esc_url($banner['url'] ?? ''); ?>" style="width: 60%;" placeholder="Image URL" />
                            <select name="banner_images[<?php echo $index; ?>][page]">
                                <option value="home" <?php selected($banner['page'], 'home'); ?>>Home</option>
                                <option value="about" <?php selected($banner['page'], 'about'); ?>>About</option>
                                <option value="join-us" <?php selected($banner['page'], 'join-us'); ?>>Join us</option>
                                <option value="franchise" <?php selected($banner['page'], 'franchise'); ?>>Franchise</option>
                                <option value="recuritment" <?php selected($banner['page'], 'recuritment'); ?>>Recuritment</option>
                            </select>

                            <select name="banner_images[<?php echo $index; ?>][position]">
                                <option value="hero" <?php selected($banner['position'], 'hero'); ?>>Hero Section</option>
                                <option value="bottom" <?php selected($banner['position'], 'bottom'); ?>>Bottom Section</option>
                            </select>

                            <button type="button" class="upload-banner-button button">Upload Image</button>
                            <button type="button" class="remove-banner-button button">Remove</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <button type="button" id="add-banner-button" class="button">Add New Banner</button>
            <br><br>
            <input type="submit" name="save_banner_settings" value="Save Settings" class="button button-primary">
        </form>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            // Recalculate the total banners on page load
            let bannerIndex = $(".banner-item").length;

            // Add new banner
            $("#add-banner-button").on("click", function () {
                const newBanner = `
                    <div class="banner-item" style="margin-bottom: 20px;">
                        <input type="text" name="banner_images[${bannerIndex}][url]" style="width: 60%;" placeholder="Image URL" />
                        <select name="banner_images[${bannerIndex}][page]">
                            <option value="home">Home</option>
                            <option value="about">About</option>
                            <option value="join-us">Join us</option>
                            <option value="franchise">franchise</option>
                            <option value="recuritment">recuritment</option>
                        </select>
                        <select name="banner_images[${bannerIndex}][position]">
                            <option value="hero">Hero Section</option>
                            <option value="bottom">Bottom Section</option>
                        </select>
                        <button type="button" class="upload-banner-button button">Upload Image</button>
                        <button type="button" class="remove-banner-button button">Remove</button>
                    </div>
                `;
                $("#banner-container").append(newBanner);
                bannerIndex++;
            });

            // Upload Image
            $(document).on("click", ".upload-banner-button", function () {
                const button = $(this);
                const inputField = button.siblings('input[type="text"]');

                const mediaUploader = wp.media({
                    title: "Select Image",
                    button: { text: "Use This Image" },
                    multiple: false,
                });

                mediaUploader.on("select", function () {
                    const attachment = mediaUploader.state().get("selection").first().toJSON();
                    inputField.val(attachment.url);
                });

                mediaUploader.open();
            });

            // Remove Banner
            $(document).on("click", ".remove-banner-button", function () {
                $(this).closest(".banner-item").remove();
                updateBannerIndices();
            });

            // Function to update the indices of banners
            function updateBannerIndices() {
                bannerIndex = 0; // Reset index
                $(".banner-item").each(function () {
                    const index = bannerIndex;

                    // Update input field
                    $(this).find('input[type="text"]').attr('name', `banner_images[${index}][url]`);

                    // Update page select
                    $(this).find('select[name^="banner_images["][name$="][page]"]').attr('name', `banner_images[${index}][page]`);

                    // Update position select
                    $(this).find('select[name^="banner_images["][name$="][position]"]').attr('name', `banner_images[${index}][position]`);

                    bannerIndex++;
                });
            }
        });
    </script>
    <?php
}

// Enqueue scripts for media uploader and jQuery
function custom_banner_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_custom-banner-settings') {
        return;
    }
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'custom_banner_admin_scripts');

// franchise page




// function add_franchise_meta_box() {
//     add_meta_box(
//         'franchise_meta_box',
//         'Franchise Rows',
//         'render_franchise_meta_box',
//         'page', // Change to 'post' if needed
//         'normal',
//         'default'
//     );
// }
function add_franchise_meta_box() {
    global $post;

    // Ensure $post is set and check the slug (permalink)
    if (isset($post) && get_post_field('post_name', $post->ID) === 'franchise') {
        add_meta_box(
            'franchise_meta_box',
            'Franchise Rows',
            'render_franchise_meta_box',
            'page', // Change to 'post' if needed
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'add_franchise_meta_box');

add_action('add_meta_boxes', 'add_franchise_meta_box');

function render_franchise_meta_box($post) {
    $franchise_rows = get_post_meta($post->ID, 'franchise_rows', true);
    $franchise_title = get_post_meta($post->ID, '_franchise_title', true);
    $franchise_desc = get_post_meta($post->ID, '_franchise_desc', true);

    $franchise_title_ar = get_post_meta($post->ID, '_franchise_title_ar', true);
    $franchise_desc_ar = get_post_meta($post->ID, '_franchise_desc_ar', true);
    wp_nonce_field('franchise_meta_box_nonce', 'franchise_meta_box_nonce_field');

    echo '<div id="franchise-rows-container">';
    ?>
    <p>
        <label for="franchise_title"><strong>Title:</strong></label>
        <input type="text" name="franchise_title" id="franchise_title" value="<?php echo esc_attr($franchise_title); ?>" class="widefat" />
    </p>
    <p>
        <label for="franchise_desc"><strong>Description:</strong></label>
        <textarea name="franchise_desc" id="franchise_desc" rows="4" class="widefat"><?php echo esc_textarea($franchise_desc); ?></textarea>
    </p>

    <p>
        <label for="franchise_title_ar"><strong>Title Arabic:</strong></label>
        <input type="text" name="franchise_title_ar" id="franchise_title_ar" value="<?php echo esc_attr($franchise_title_ar); ?>" class="widefat" />
    </p>
    <p>
        <label for="franchise_desc_ar"><strong>Description Arabic:</strong></label>
        <textarea name="franchise_desc_ar" id="franchise_desc_ar" rows="4" class="widefat"><?php echo esc_textarea($franchise_desc_ar); ?></textarea>
    </p>
    <?php
    if (!empty($franchise_rows) && is_array($franchise_rows)) {
        foreach ($franchise_rows as $index => $row) {
            ?>
            <div class="franchise-row">
                <h4>Row <?php echo $index + 1; ?></h4>
                <p>
                    <label>Title:</label>
                    <input type="text" name="franchise_rows[<?php echo $index; ?>][title]" class="widefat" value="<?php echo esc_attr($row['title'] ?? ''); ?>">
                </p>
                <p>
                    <label>Description:</label>
                    <textarea name="franchise_rows[<?php echo $index; ?>][description]" class="widefat"><?php echo esc_textarea($row['description'] ?? ''); ?></textarea>
                </p>

                <!--for arabic frild  -->
                <p>
                    <label>Title Arabic:</label>
                    <input type="text" name="franchise_rows[<?php echo $index; ?>][title_ar]" class="widefat" value="<?php echo esc_attr($row['title_ar'] ?? ''); ?>">
                </p>
                <p>
                    <label>Description Arabic:</label>
                    <textarea name="franchise_rows[<?php echo $index; ?>][description_ar]" class="widefat"><?php echo esc_textarea($row['description_ar'] ?? ''); ?></textarea>
                </p>

                <p>
                    <label>Image URL:</label>
                    <input type="text" name="franchise_rows[<?php echo $index; ?>][image]" class="widefat" value="<?php echo esc_url($row['image'] ?? ''); ?>">
                    <button type="button" class="button upload_image_button">Upload Image</button>
                    <button type="button" class="button button-danger remove-franchise-row">Remove Row</button>
                </p>
                <hr>
            </div>
            <?php
        }
    }
    echo '</div>';
    echo '<button type="button" id="add-franchise-row" class="button button-primary">Add Row</button>';
}

function save_franchise_meta_box($post_id) {
    if (!isset($_POST['franchise_meta_box_nonce_field']) || !wp_verify_nonce($_POST['franchise_meta_box_nonce_field'], 'franchise_meta_box_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
// Save or update the title
if (isset($_POST['franchise_title'])) {
    update_post_meta($post_id, '_franchise_title', sanitize_text_field($_POST['franchise_title']));
}

// Save or update the description
if (isset($_POST['franchise_desc'])) {
    update_post_meta($post_id, '_franchise_desc', sanitize_textarea_field($_POST['franchise_desc']));
}


if (isset($_POST['franchise_title_ar'])) {
    update_post_meta($post_id, '_franchise_title_ar', sanitize_text_field($_POST['franchise_title_ar']));
}

// Save or update the description
if (isset($_POST['franchise_desc_ar'])) {
    update_post_meta($post_id, '_franchise_desc_ar', sanitize_textarea_field($_POST['franchise_desc_ar']));
}
    if (isset($_POST['franchise_rows']) && is_array($_POST['franchise_rows'])) {
        $sanitized_rows = array_map(function ($row) {
            return [
                'title' => sanitize_text_field($row['title'] ?? ''),
                'description' => sanitize_textarea_field($row['description'] ?? ''),
                'title_ar' => sanitize_text_field($row['title_ar'] ?? ''),
                'description_ar' => sanitize_textarea_field($row['description_ar'] ?? ''),
                'image' => esc_url_raw($row['image'] ?? ''),
            ];
        }, $_POST['franchise_rows']);

        update_post_meta($post_id, 'franchise_rows', $sanitized_rows);
    } else {
        delete_post_meta($post_id, 'franchise_rows');
    }
}
add_action('save_post', 'save_franchise_meta_box');

function enqueue_franchise_meta_box_scripts() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let rowCount = document.querySelectorAll('#franchise-rows-container .franchise-row').length;

        document.getElementById('add-franchise-row').addEventListener('click', function () {
            // if (rowCount >= 4) {
            //     alert('You can only add up to 4 rows.');
            //     return;
            // }

            const container = document.getElementById('franchise-rows-container');
            const newRow = document.createElement('div');
            newRow.classList.add('franchise-row');
            newRow.innerHTML = `
                <h4>Row ${rowCount + 1}</h4>
                <p>
                    <label>Title:</label>
                    <input type="text" name="franchise_rows[${rowCount}][title]" class="widefat">
                </p>
                <p>
                    <label>Description:</label>
                    <textarea name="franchise_rows[${rowCount}][description]" class="widefat"></textarea>
                </p>

                <p>
                    <label>Title Arabic:</label>
                    <input type="text" name="franchise_rows[${rowCount}][title_ar]" class="widefat">
                </p>
                <p>
                    <label>Description Arabic:</label>
                    <textarea name="franchise_rows[${rowCount}][description_ar]" class="widefat"></textarea>
                </p>


                <p>
                    <label>Image URL:</label>
                    <input type="text" name="franchise_rows[${rowCount}][image]" class="widefat">
                    <button type="button" class="button upload_image_button">Upload Image</button>
                </p>
                <button type="button" class="button button-danger remove-franchise-row">Remove Row</button>
                <hr>
            `;
            container.appendChild(newRow);
            rowCount++;

            // Attach image upload functionality to new button
            attachUploadImageHandler(newRow.querySelector('.upload_image_button'));

            // Attach remove row functionality
            newRow.querySelector('.remove-franchise-row').addEventListener('click', function () {
                newRow.remove();
                rowCount--;
            });
        });

        function attachUploadImageHandler(button) {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const target = button.previousElementSibling;

                const customUploader = wp.media({
                    title: 'Select Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                customUploader.on('select', function () {
                    const attachment = customUploader.state().get('selection').first().toJSON();
                    target.value = attachment.url;
                });

                customUploader.open();
            });
        }

        // Attach upload image handler to existing buttons
        document.querySelectorAll('.upload_image_button').forEach(button => {
            attachUploadImageHandler(button);
        });

        // Remove functionality for existing rows
        document.querySelectorAll('.remove-franchise-row').forEach(button => {
            button.addEventListener('click', function () {
                button.closest('.franchise-row').remove();
                rowCount--;
            });
        });
    });
    </script>
    <?php
}
add_action('admin_footer', 'enqueue_franchise_meta_box_scripts');


// privacy policy fields

// function zad_add_arabic_content_meta_box() {
//     global $post;

//     // Get the Privacy Policy page dynamically by its slug
//     $privacy_policy_page = get_page_by_path('privacy-policy');

//     // Check if the Privacy Policy page exists
//     if ($privacy_policy_page) {
//         $privacy_policy_page_id = $privacy_policy_page->ID;

//         // Add the meta box only for the Privacy Policy page
//         add_meta_box(
//             'zad_arabic_content', // Meta box ID
//             'Arabic Content',     // Meta box title
//             'zad_arabic_content_meta_box_callback', // Callback function
//             'page',               // Post type
//             'normal',             // Context
//             'default',            // Priority
//             array('privacy_page_id' => $privacy_policy_page_id) // Pass privacy policy ID
//         );
//     }
// }

function add_privacy_policy_metabox() {
    // Check if the post is the Privacy Policy page
    global $post;

    //     // Get the Privacy Policy page dynamically by its slug
    $privacy_policy_page = get_page_by_path('privacy-policy');
    if ($privacy_policy_page) {
        add_meta_box(
            'privacy_policy_editor', // Metabox ID
            'Privacy Policy Content', // Title of the metabox
            'privacy_policy_editor_callback', // Callback function
            'page', // Post type (here we add to pages)
            'normal', // Context (normal means it will appear in the main section)
            'high', // Priority (high means it will appear at the top)
            array('privacy_page_id' => $privacy_policy_page_id) // Pass privacy policy ID
        );
    }
}
add_action('add_meta_boxes', 'add_privacy_policy_metabox');

function privacy_policy_editor_callback($post) {
    // Add nonce for security
    wp_nonce_field('privacy_policy_nonce_action', 'privacy_policy_nonce');
    
    // Get the saved content for the editor
    $content = get_post_meta($post->ID, '_privacy_policy_content', true);

    // Output the TinyMCE editor
    wp_editor($content, 'privacy_policy_editor', array(
        'textarea_name' => 'privacy_policy_content', // Name of the field
        'editor_class'  => 'wp-editor-area', // Class for the textarea
        'textarea_rows' => 10, // Number of rows
        'editor_height' => 300, // Height of the editor
    ));
}

function save_privacy_policy_metabox($post_id) {
    // Check if nonce is set and valid
    if (!isset($_POST['privacy_policy_nonce']) || !wp_verify_nonce($_POST['privacy_policy_nonce'], 'privacy_policy_nonce_action')) {
        return;
    }

    // Save the content if it's set
    if (isset($_POST['privacy_policy_content'])) {
        update_post_meta($post_id, '_privacy_policy_content', sanitize_textarea_field($_POST['privacy_policy_content']));
    }
}
add_action('save_post', 'save_privacy_policy_metabox');

