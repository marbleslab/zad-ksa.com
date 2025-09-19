<?php
/**
 * Template Name: Privacy Policy Page
 */
get_header();
// $current_language = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'en';
 global $current_language;
$lang = isset($current_language) ? $current_language : 'en';
 // banner
 
?>

    <section class=" position-relative">
     
      

      <div class="container z-1 position-relative">
    <div class="main-section d-flex justify-content-center align-items-center"  >
      <div class="py-5">
       
        
        <div class="entry-content">
   


<?php
if (is_page('privacy-policy') && $current_language === 'ar') {
  // Get the Arabic content from the meta field
  $privacy_policy_content = get_post_meta(get_the_ID(), '_privacy_policy_content', true);
    
    // Check if there is content to display
    if ($privacy_policy_content) {
        // Output the content with the appropriate formatting
        echo wp_kses_post($privacy_policy_content); // Sanitize the content for safe output
    } else {
        echo '<p>No privacy policy content found.</p>';
    }
} else {
    // Display default content for other pages or when language is not Arabic
    echo '<h3>' . get_the_title() . '</h3>';  // Properly display the title
    the_content();  // Display the content (no need to echo, as the_content does that)
}?>

        </div>
      </div>
    </div>
  </div>
    </section>
   
<?php
get_footer(); 
?>
