<?php
/**
 * Osetin functions and definitions
 *
 * @package Osetin
 */


// Set the version for the theme
if (!defined('OSETIN_THEME_VERSION')) define('OSETIN_THEME_VERSION', '1.3.3');
if (!defined('OSETIN_THEME_UNIQUE_ID')) define('OSETIN_THEME_UNIQUE_ID', 'osetin_psych');

/**
* Activate & configure required plugins
*/
include_once( get_template_directory() . '/inc/osetin-acf.php' );
include_once( get_template_directory() . '/inc/osetin-magic.php' );
include_once( get_template_directory() . '/inc/wp-less/wp-less.php' );
include_once( get_template_directory() . '/inc/activate-plugins.php' );
include_once( get_template_directory() . '/inc/osetin-demo-data-import.php' );
include_once( get_template_directory() . '/inc/configure-plugins.php' );
include_once( get_template_directory() . '/inc/osetin-feature-autosuggest.php' );
include_once( get_template_directory() . '/inc/shortcodes.php' );

if ( ! function_exists( 'osetin_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function osetin_setup() {

    osetin_autosuggest_init();

    set_post_thumbnail_size( 500, 500 );
    add_image_size( 'osetin-medium-square-thumbnail', 400, 400, true );
    add_image_size( 'osetin-full-width', 1600, 1600 );
    add_image_size( 'osetin-for-background', 2400, 5000 );
    
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'zelus-by-osetin', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );
    add_theme_support('post-thumbnails');
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
    add_theme_support( 'post-formats', array('image', 'video', 'link', 'gallery') );




    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
      'header' => esc_html__( 'Top Menu', 'zelus-by-osetin' ),
      'footer' => esc_html__( 'Footer Menu', 'zelus-by-osetin' ),
    ) );

  }
endif; // osetin_setup

add_action( 'after_setup_theme', 'osetin_setup' );







if ( ! function_exists( 'osetin_admin_setup' ) ) :

  function osetin_admin_setup()
  {

    if( function_exists('acf_add_options_page') ) {
      acf_add_options_page(array(
        'page_title'  => __('Theme General Settings', 'zelus-by-osetin'),
        'menu_title'  => __('Theme Settings', 'zelus-by-osetin'),
        'menu_slug'   => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));

      acf_add_options_sub_page(array(
          'page_title'  => __('Theme Settings - Get Started', 'zelus-by-osetin'),
          'menu_title'  => __('Get Started', 'zelus-by-osetin'),
          'parent_slug' => 'theme-general-settings',
          'capability'  => 'manage_options'
        ));


      acf_add_options_sub_page(array(
        'page_title'  => __('Theme Settings - General', 'zelus-by-osetin'),
        'menu_title'  => __('General', 'zelus-by-osetin'),
        'parent_slug' => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));

      acf_add_options_sub_page(array(
        'page_title'  => __('Theme Settings - Appearance', 'zelus-by-osetin'),
        'menu_title'  => __('Appearance', 'zelus-by-osetin'),
        'parent_slug' => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));

      acf_add_options_sub_page(array(
        'page_title'  => __('Theme Settings - Fonts', 'zelus-by-osetin'),
        'menu_title'  => __('Fonts', 'zelus-by-osetin'),
        'parent_slug' => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));

      acf_add_options_sub_page(array(
        'page_title'  => __('Theme Settings - Header', 'zelus-by-osetin'),
        'menu_title'  => __('Header', 'zelus-by-osetin'),
        'parent_slug' => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));


      acf_add_options_sub_page(array(
        'page_title'  => __('Theme Settings - Footer', 'zelus-by-osetin'),
        'menu_title'  => __('Footer', 'zelus-by-osetin'),
        'parent_slug' => 'theme-general-settings',
        'capability'  => 'manage_options',
      ));
    }
  }

endif;

add_action( 'admin_menu', 'osetin_admin_setup', 98 );


function osetin_acf_options_page_settings(){
  if(isset($_GET['page']) && ($_GET['page'] == 'acf-options-get-started')){

    $path = get_template_directory() .'/inc/views/options-page.php';
    if( file_exists($path) ) {

      include( $path );
      
    }
  }
}
add_action('admin_notices','osetin_acf_options_page_settings');



/*
* Add theme settings links to toolbar
*/

function osetin_add_custom_toolbar_links($wp_admin_bar) {

    $args = array(
        'id' => 'theme-settings',
        'title' => 'Theme Settings', 
        'href' => admin_url('admin.php?page=acf-options-get-started'), 
        'meta' => array(
            'class' => 'theme-settings-link', 
            'title' => 'Theme Settings'
            )
    );
    $wp_admin_bar->add_node($args);
 
    $args = array(
        'id' => 'theme-settings-get-started',
        'title' => 'Get Started', 
        'href' => admin_url('admin.php?page=acf-options-get-started'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);


    $args = array(
        'id' => 'theme-settings-general',
        'title' => 'General', 
        'href' => admin_url('admin.php?page=acf-options-general'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'theme-settings-appearance',
        'title' => 'Appearance', 
        'href' => admin_url('admin.php?page=acf-options-appearance'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'theme-settings-fonts',
        'title' => 'Fonts', 
        'href' => admin_url('admin.php?page=acf-options-fonts'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'theme-settings-header',
        'title' => 'Header', 
        'href' => admin_url('admin.php?page=acf-options-header'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);

    $args = array(
        'id' => 'theme-settings-footer',
        'title' => 'Footer', 
        'href' => admin_url('admin.php?page=acf-options-footer'), 
        'parent' => 'theme-settings'
    );
    $wp_admin_bar->add_node($args);
 
}
// add_action('admin_bar_menu', 'osetin_add_custom_toolbar_links', 999);







/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'osetin_content_width' ) ) :
  function osetin_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'osetin_content_width', 640 );
  }
endif;

add_action( 'after_setup_theme', 'osetin_content_width', 0 );






/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'osetin_widgets_init' ) ) :
  function osetin_widgets_init() {
    register_sidebar( array(
      'name'          => esc_html__( 'Archives/Index Sidebar', 'zelus-by-osetin' ),
      'id'            => 'sidebar-index',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title"><span>',
      'after_title'   => '</span></h3>',
    ) );
    register_sidebar(array(
      'name'          => esc_html__( 'Footer Sidebar', 'zelus-by-osetin' ),
      'id'            => 'sidebar-footer',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title"><span>',
      'after_title'   => '</span></h3>',
    ) );
    register_sidebar(array(
      'name'          => esc_html__( 'Single Post Sidebar', 'zelus-by-osetin' ),
      'id'            => 'sidebar-single-post',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title"><span>',
      'after_title'   => '</span></h3>',
    ) );
    register_sidebar(array(
      'name'          => esc_html__( 'Service Page Sidebar', 'zelus-by-osetin' ),
      'id'            => 'sidebar-service',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title"><span>',
      'after_title'   => '</span></h3>',
    ) );
    register_sidebar(array(
      'name'          => esc_html__( 'Single Page Sidebar', 'zelus-by-osetin' ),
      'id'            => 'sidebar-single-page',
      'description'   => '',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title"><span>',
      'after_title'   => '</span></h3>',
    ) );
  }
endif;

add_action( 'widgets_init', 'osetin_widgets_init' );






if ( ! function_exists( 'osetin_body_class' ) ) :
  function osetin_body_class($body_classes){
    $last_menu_item_as_button = osetin_get_field('last_menu_item_as_button', 'option', false);
    if($last_menu_item_as_button){
      $body_classes[] = 'last-menu-item-as-button';
    }

    if(osetin_get_field('use_rounded_corners_for_dropdown_menu', 'option')){
      $body_classes[] = 'dropdown-menu-rounded-corners';
    }
    $body_classes[] = 'dropdown-menu-color-scheme-'.osetin_get_field('menu_dropdown_background_color_type', 'option', 'light');

    if(is_singular() && (osetin_get_field('overlap_menu') === true)){
      $body_classes[] = 'overlap-menu';
    }

    if(osetin_get_field('remove_decoration_from_top_intro', 'option') === true){
      $body_classes[] = 'no-header-decorations';
    }

    if(true){
      $body_classes[] = 'os-is-animated';
    }


    return $body_classes;
  }
endif;

// Add specific CSS class by filter
add_filter('body_class','osetin_body_class');



















// generate full url for the enqueue style function to add google fonts support
if ( ! function_exists( 'osetin_google_fonts_url' ) ) :
  function osetin_google_fonts_url(){
      $font_url = '';
      $font_names = osetin_get_google_font_names();
      
      /*
      Translators: If there are characters in your language that are not supported
      by chosen font(s), translate this to 'off'. Do not translate into your own language.
       */
      if ( 'off' !== _x( 'on', 'Google font: on or off', 'zelus-by-osetin' ) ) {
          $font_url = add_query_arg( 'family', $font_names, "//fonts.googleapis.com/css" );
      }
      return $font_url;
  }
endif;



if ( ! function_exists( 'osetin_enqueue_custom_fonts_css' ) ) :
  function osetin_enqueue_custom_fonts_css() {
    $custom_css = '';
    if( osetin_have_rows('custom_font', 'option') ){
      while ( osetin_have_rows('custom_font', 'option') ) { the_row();
        $font_family_name = get_sub_field('font_family_name');
        $font_url_woff = get_sub_field('font_woff');
        $font_url_woff2 = get_sub_field('font_woff2');
        $font_weight = get_sub_field('font_weight');

        $custom_css.= "@font-face {
                font-family: '".$font_family_name."';
                src: url('".$font_url_woff2."') format('woff2'),
                     url('".$font_url_woff."') format('woff');
                font-weight: ".$font_weight.";
                font-style: normal;
              }";
      }
    }
    if($custom_css != ''){
      wp_enqueue_style( 'osetin-custom-fonts', get_template_directory_uri() . '/custom-fonts.css', array(), OSETIN_THEME_VERSION );
      wp_add_inline_style( 'osetin-custom-fonts', $custom_css );
    }

  }
endif;




if ( ! function_exists( 'osetin_load_admin_style' ) ) :
  function osetin_load_admin_style() {
    wp_register_style( 'osetin-admin', get_template_directory_uri() . '/assets/css/osetin-admin.css', false, OSETIN_THEME_VERSION );
    wp_enqueue_style( 'osetin-admin' );
  }
endif;

add_action( 'admin_enqueue_scripts', 'osetin_load_admin_style', 30 );






/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'osetin_scripts' ) ) :
  function osetin_scripts() {


    // ------------//
    // FONTS //
    // ------------//

    // Add typekit font support
    if(osetin_get_field('font_library', 'option') == "adobe_typekit_fonts"){
      wp_enqueue_script( 'osetin_typekit', '//use.typekit.net/' . osetin_get_field('adobe_typekit_id', 'option') . '.js');
      wp_add_inline_script( 'osetin_typekit', 'try{Typekit.load();}catch(e){}' );
    }elseif(osetin_get_field('font_library', 'option') == "custom_fonts"){
      osetin_enqueue_custom_fonts_css();
    }elseif(osetin_get_field('font_library', 'option') == "external_stylesheet" && osetin_get_field('custom_stylesheet_url', 'option')){
      wp_enqueue_style( 'osetin-external-font-style', osetin_get_field('custom_stylesheet_url', 'option'), array(), OSETIN_THEME_VERSION );
    }else{
      // Embed google fonts 
      wp_enqueue_style( 'osetin-google-font', osetin_google_fonts_url(), array(), OSETIN_THEME_VERSION );
    }


    // ------------//
    // STYLESHEETS //
    // ------------//

    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
    wp_enqueue_style( 'osetin-main', get_template_directory_uri() . '/assets/less/main.less', false, OSETIN_THEME_VERSION );
    wp_enqueue_style( 'osetin-style', get_stylesheet_uri() );



    // ------------//
    // JAVASCRIPTS //
    // ------------//
    
    wp_enqueue_script( 'osetin-feature-autosuggest',        get_template_directory_uri() . '/assets/js/osetin-feature-autosuggest.js',  array( 'jquery' ), OSETIN_THEME_VERSION, true );
    wp_enqueue_script( 'salvattore',        get_template_directory_uri() . '/assets/js/lib/salvattore.min.js',        array(), OSETIN_THEME_VERSION, true );
    wp_enqueue_script( 'owl-carousel',           get_template_directory_uri() . '/assets/js/lib/owl.carousel.min.js',        array( 'jquery' ), OSETIN_THEME_VERSION, true );
    wp_enqueue_script( 'waitforimages',          get_template_directory_uri() . '/assets/js/lib/waitforimages.min.js',       array( 'jquery' ), OSETIN_THEME_VERSION, true );
    wp_enqueue_script( 'perfect-scrollbar',      get_template_directory_uri() . '/assets/js/lib/perfect-scrollbar.js',       array( 'jquery' ), OSETIN_THEME_VERSION, true );
    wp_enqueue_script( 'mousewheel',             get_template_directory_uri() . '/assets/js/lib/jquery.mousewheel.js',       array( 'jquery' ), OSETIN_THEME_VERSION, true );
    
    wp_enqueue_script( 'osetin-functions',                  get_template_directory_uri() . '/assets/js/functions.js',                   array( 'jquery'), OSETIN_THEME_VERSION, true );
    wp_add_inline_script( 'osetin-functions', 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"', 'before' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
endif;

add_action( 'wp_enqueue_scripts', 'osetin_scripts' );




if ( ! function_exists( 'osetin_dequeue_css_from_plugins' ) ) :
  function osetin_dequeue_css_from_plugins()  {
    // remove styles that are no need
    wp_dequeue_style('sb_instagram_icons');
  }
endif;

add_action('wp_print_styles', 'osetin_dequeue_css_from_plugins');






// Get google fonts names inputted in admin, or use default google fonts if nothign is selected
if ( ! function_exists( 'osetin_get_google_font_names' ) ) :
  function osetin_get_google_font_names(){
    $font_selected_in_admin = osetin_get_field('google_fonts_href', 'option');
      if(!empty($font_selected_in_admin)){
        // clean the input in order to get font names=
        $font_selected_in_admin = str_replace("<link href='http://fonts.googleapis.com/css?family=", '', $font_selected_in_admin);
        $font_selected_in_admin = str_replace("<link href='https://fonts.googleapis.com/css?family=", '', $font_selected_in_admin);
        $font_selected_in_admin = str_replace("<link href='", '', $font_selected_in_admin);
        $font_selected_in_admin = str_replace("http://fonts.googleapis.com/css?family=", '', $font_selected_in_admin);
        $font_selected_in_admin = str_replace("https://fonts.googleapis.com/css?family=", '', $font_selected_in_admin);
        $font_selected_in_admin = str_replace("' rel='stylesheet' type='text/css'>", '', $font_selected_in_admin);
        $font_names = $font_selected_in_admin;
      }else{
        // default font to use in case nothing is selected in admin
        $font_names = 'Playfair+Display:400i|Heebo:300,700';
      }
      return $font_names;
  }
endif;




// This is done to make sure acf fields are loaded in a child theme 
// More info http://support.advancedcustomfields.com/forums/topic/acf-json-fields-not-loading-from-parent-theme/

add_filter('acf/settings/save_json', function() {
  return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
  $paths = array(get_template_directory() . '/acf-json');

  if(is_child_theme()){
    $paths[] = get_stylesheet_directory() . '/acf-json';
  }

  return $paths;
});