<?php
/**
 * Plugin Name: Psychology Theme Helper
 * Description: Adds Special post types support to use within a theme
 * Version: 1.2
 * Author: ThemeBully
 * Author URI: https://themebully.com
 * Text Domain: psych-helper
 * Domain Path: /languages
 */


// Enable shortcodes in widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode', 11);

// Social links for users
if ( ! function_exists( 'osetin_author_social_links' ) ) :
  function osetin_author_social_links( $author_social_link ) {

    $author_social_link['rss_url'] = 'RSS URL';
    $author_social_link['google_profile'] = 'Google Plus Profile URL';
    $author_social_link['twitter_profile'] = 'Twitter Profile URL';
    $author_social_link['facebook_profile'] = 'Facebook Profile URL';
    $author_social_link['linkedin_profile'] = 'Linkedin Profile URL';
    $author_social_link['instagram_profile'] = 'Instagram Profile URL';
    $author_social_link['flickr_profile'] = 'Flickr Profile URL';

    return $author_social_link;
  }
endif;

add_filter( 'user_contactmethods', 'osetin_author_social_links', 10, 1);



include( plugin_dir_path( __FILE__ ) . 'inc/custom_post_types.php');
include( plugin_dir_path( __FILE__ ) . 'inc/widgets.php');
include( plugin_dir_path( __FILE__ ) . 'inc/shortcodes.php');



