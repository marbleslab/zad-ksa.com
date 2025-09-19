<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zadgroup
 */
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
global $current_language;
// Get the language from the cookie if available, otherwise default to 'en'
$current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en'; 
$lang = $current_language;  // Assign it to $lang as well
?>
<!doctype html>
<html lang="<?php echo $_COOKIE['site_language'] ?? 'No cookie set'; ?>">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'zag-group' ); ?></a>

	<header id="masthead" class="site-header">
	 
			
	<section class="headerSection top-0 w-100 z-3">
      <div class="container">
        <nav class="navbar navbar-expand-lg main-navigation" id="site-navigation" >
          <div class="mainmenu w-100 d-flex align-items-center">
			
            <div class="site-branding">
              <?php
              // Get the logos from the customizer
              $homepage_logo = get_theme_mod( 'homepage_logo' );
              $other_pages_logo = get_theme_mod( 'other_pages_logo' );

              // Check if it's the homepage
              if ( is_front_page()  ) :
                // Display the homepage logo (white logo) if set, otherwise display the site title
                if ( $homepage_logo ) :
                  ?>
                  <a href="<?php echo esc_url( home_url( '/' ). '?lang=' . $lang ); ?>" rel="home">
                    <img src="<?php echo esc_url( $homepage_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-white">
                  </a>
                  <?php
                else :
                  // Fallback to site name if no logo is set
                  ?>
                  <a href="<?php echo esc_url( home_url( '/' ). '?lang=' . $lang ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                  <?php
                endif;
              else :
                // Display the other pages logo (black logo) if set, otherwise display the site title
                if ( $other_pages_logo ) :
                  ?>
                  <a href="<?php echo esc_url( home_url( '/' ). '?lang=' . $lang ); ?>" rel="home">
                    <img src="<?php echo esc_url( $other_pages_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="logo-black">
                  </a>
                  <?php
                else :
                  // Fallback to site name if no logo is set
                  ?>
                  <a href="<?php echo esc_url( home_url( '/' ). '?lang=' . $lang ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                  <?php
                endif;
              endif;
              ?>
            </div>

            <button
              class="btn btn-primary d-sm-none ms-auto bg-transparent p-0 border-0 hamburgerIcon"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#mainMenu"
              aria-controls="mainMenu"
            >
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hamburger.png" />
            </button>

            <div
              class="offcanvas offcanvas-end"
              tabindex="-1"
              id="mainMenu"
              aria-labelledby="mainMenuLabel"
            >
              <div class="offcanvas-header">
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="offcanvas"
                  aria-label="Close"
                ></button>
              </div>
              <div class="offcanvas-body">
                <div class="w-100 d-sm-flex" id="navbarSupportedContent">
                  <?php
                    // wp_nav_menu( array(
                    //   'theme_location' => 'menu-1',
                    //   'menu_id'        => 'primary-menu', // Defined in functions.php
                    //   'container'       => 'ul',          // No additional wrapper
                    //   'menu_class'      => 'navbar-nav mx-auto mb-2 mb-lg-0', // Apply Bootstrap classes to <ul>
                    //   'li_class'        => 'nav-item',        // Add this to apply Bootstrap 'nav-item' to <li>
                    //   'link_class'      => 'nav-link text-white text-center',
                    //   'fallback_cb'     => false,         // Prevent fallback to pages
                    //   'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>', // Custom wrapping structure
                    //   'depth'           => 1,             // No dropdowns, so limit to 1 level
                    // ) );
                  ?>
                  <ul id="primary-menu" class="navbar-nav mx-auto mb-2 mb-lg-0 nav-menu">
                   <li id="menu-item-30" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30 nav-item">
                        <a href="<?php echo esc_url(home_url('about-us') . '?lang=' . $lang); ?>" class="nav-link text-white text-center"><?php echo custom_translate('about_us'); ?></a>
                    </li>
                    <li id="menu-item-29" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29 nav-item">
                        <a href="<?php echo esc_url(home_url('gallery') . '?lang=' . $lang); ?>" class="nav-link text-white text-center"><?php echo custom_translate('gallery'); ?></a>
                    </li>
                    <li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28 nav-item">
                        <a href="<?php echo esc_url(home_url('join-us') . '?lang=' . $lang); ?>" class="nav-link text-white text-center"><?php echo custom_translate('join_us'); ?></a>
                    </li>
                    <li id="menu-item-28" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28 nav-item">
                        <a href="<?php echo esc_url(home_url('franchise') . '?lang=' . $lang); ?>" class="nav-link text-white text-center"><?php echo custom_translate('franchise'); ?></a>
                    </li>

                  </ul>
                  
                  <div class="text-white d-flex justify-content-center gap-3 socialicons align-items-center">
  
                  <?php
                    // Determine the current language from the cookie
                    // $current_lang = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
                  ?>
                    <div id="zoom-controls" style="display: flex; gap: 4px; align-items:center;">
                      <button id="zoomInBtn" style="padding:2px 10px; background:#222; color:#fff; border:none; border-radius:4px; font-size:14px; box-shadow:0 1px 3px #0002; cursor:pointer;">＋</button>
                      <button id="zoomOutBtn" style="padding:2px 10px; background:#222; color:#fff; border:none; border-radius:4px; font-size:14px; box-shadow:0 1px 3px #0002; cursor:pointer;">－</button>
                      <button id="zoomResetBtn" style="padding:2px 12px; background:#0563af; color:#fff; border:none; border-radius:4px; font-size:14px; box-shadow:0 1px 3px #0002; cursor:pointer;">Reset</button>
                    </div>

                  <div id="language-switcher">
                    <?php if ($lang === 'en'): ?>
                       <!--Show Arabic flag if English is the current language -->
                      <img id="ar-flag"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/artxt.png"
                        alt="social"
                        class="object-fit-contain"
                        onclick="switchLanguage('ar')" style="cursor: pointer;"
                      />              
                    <?php else: ?>
                       <!--Show English flag if Arabic is the current language -->
                      <h6 id="en-flag" onclick="switchLanguage('en')" class="fs-4 m-0" style="cursor: pointer;line-height: .8;">English</h6>
                    <?php endif; ?>
                  </div>

                  <script>
                //   function switchLanguage(lang) {
                //     // Redirect to the same page with the new language parameter
                //     document.cookie = "site_language=" + lang + "; path=/; max-age=" + (86400 * 30); // 30 days cookie
                    
                //     // Redirect to the same page with the new language parameter
                //       window.location.href = window.location.pathname + "?lang=" + lang;
                //     // window.location.href = "?lang=" + lang;
                //   }
                function switchLanguage(lang) {
                    // Set the language cookie
                    document.cookie = "site_language=" + lang + "; path=/; max-age=" + (86400 * 30); // 30 days cookie
                
                    // Reload the page to reflect the language change
                    // location.reload();
                    window.location.href = window.location.pathname + "?lang=" + lang;
                }

                  </script>
                    <a href="https://www.linkedin.com/company/zad-ksa/" target="_blank"><img
                      src="<?php echo get_template_directory_uri(); ?>/assets/images/linkedin.png"
                      alt="social"
                      class="object-fit-contain"
                    />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </section>
		

		
	</header><!-- #masthead -->
