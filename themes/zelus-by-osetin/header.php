<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>
<?php 
$background_image_size = osetin_get_settings_field('background_image_size');
$background_contain = ($background_image_size == 'small') ? '' : 'background-size: cover;';
if(is_category()){
  $cat_id =  get_query_var('cat');
  $body_bg_image = osetin_get_field('category_page_background_image', "category_{$cat_id}", false, true);
  if(empty($body_bg_image)){
    $body_bg_image = osetin_get_field('background_image_option', 'option', false, true);
  }
}else{
  $body_bg_image = osetin_get_settings_field('background_image', false, false, false, true);
}
if(!empty($body_bg_image) && is_array($body_bg_image)){
  $size = 'osetin-for-background';
  $body_bg_image_url = $body_bg_image['sizes'][ $size ];
  $body_bg_image_width = $body_bg_image['sizes'][ $size . '-width' ];
  $body_bg_image_height = $body_bg_image['sizes'][ $size . '-height' ];
  if($body_bg_image_width) $body_bg_image_width = str_replace('px', '', $body_bg_image_width);
  if($body_bg_image_height) $body_bg_image_height = str_replace('px', '', $body_bg_image_height);
}else{
  $body_bg_image_url = false;
}
$default_logo = get_template_directory_uri().'/assets/img/logo-black-big.png';
if(osetin_get_field('enable_custom_header_settings') === true){
  $top_menu_version_type = osetin_get_field('top_menu_type');
  $logo_image_url = osetin_get_field('logo_image');
  $logo_image_width = osetin_get_field('logo_image_width');
}else{
  $top_menu_version_type = osetin_get_field('top_menu_type_option', 'option', 'version_1');
  $logo_image_url = osetin_get_field('logo_image_option', 'option', $default_logo);
  $logo_image_width = osetin_get_field('logo_image_width_option', 'option', '210');
}

$top_menu_bg_color =  osetin_get_field('top_menu_background_color', 'option');
$top_menu_bg_color_type =  osetin_get_field('top_menu_background_color_type', 'option', 'light');
$top_menu_bg_image_url =  osetin_get_field('top_menu_background_image', 'option');

$fixed_menu_logo_image_url = osetin_get_field('fixed_header_logo', 'option', $logo_image_url);
$fixed_menu_logo_image_width = osetin_get_field('fixed_header_logo_width', 'option', '180');
$mobile_logo_image_url = osetin_get_field('mobile_logo_image', 'option', $logo_image_url);
$mobile_logo_image_width = osetin_get_field('mobile_logo_image_width', 'option', '180');


?>
<body <?php body_class(); ?> style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('background_color_option', 'option')); ?><?php if($body_bg_image_url) echo osetin_get_css_prop('background-image', $body_bg_image_url, false, 'background-repeat: repeat; background-position: top center; background-attachment: fixed;'.$background_contain); ?>">
  <div class="all-wrapper with-animations">
    <div class="all-wrapper-i">
      <?php if(osetin_top_bar_visible()){ ?>
      <?php $member_bar_bg = osetin_get_field('top_bar_background_color', 'option'); ?>
      <div class="os-container top-bar-links-box-container">
        <div class="top-bar-links-box-w" style="<?php echo ($member_bar_bg) ? 'background-color: '.esc_attr($member_bar_bg) : ''; ?>">
          <div class="top-bar-links-box">
            <ul>
              <?php if(osetin_get_field('main_phone', 'option')){ ?><li><div class="top-bar-link-phone"><i class="os-icon os-icon-phone"></i> <span><?php echo '<strong>'.__('Call Us: ', 'zelus-by-osetin').'</strong> '.osetin_get_field('main_phone', 'option'); ?></span></div></li><?php } ?>
              <?php if(osetin_get_field('main_address', 'option')){ ?><li><div class="top-bar-link-address"><i class="os-icon os-icon-location"></i> <span><?php echo '<strong>'.__('Our Address: ', 'zelus-by-osetin').'</strong> '.osetin_get_field('main_address', 'option'); ?></span></div></li><?php } ?>
            </ul>
          </div>
          <?php 
          if( osetin_have_rows('social_links', 'option') && osetin_get_field('show_header_social_icons', 'option') != 'no' ){
            osetin_social_share_icons('header'); ?>
            <span class="top-bar-social-label"><?php _e('Find us on Social Media:', 'zelus-by-osetin'); ?></span>
            <?php
          }
          ?>
        </div>
      </div>
      <?php } ?>
      <div class="main-header-w main-header-<?php echo esc_attr($top_menu_version_type); ?>">
        <?php if($top_menu_version_type != 'version_2'){ ?>
          <div class="main-header-i">
            <div class="main-header color-scheme-<?php echo esc_attr($top_menu_bg_color_type); ?> " style="<?php echo osetin_get_css_prop('background-color', $top_menu_bg_color); ?><?php echo osetin_get_css_prop('background-image', $top_menu_bg_image_url); ?>; background-size: cover;">
              <div class="logo" style="width: <?php echo esc_attr($logo_image_width); ?>px;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <img src="<?php echo esc_url($logo_image_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                </a>
              </div>
              <?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'header-menu', 'container_class' => 'top-menu menu-activated-on-hover', 'fallback_cb' => false ) ); ?>
            </div>
          </div>
        <?php }else{ ?>
          <div class="main-header color-scheme-<?php echo esc_attr($top_menu_bg_color_type); ?> ">
            <div class="top-logo-w">
              <div class="social-trigger-w">
                <div class="social-trigger">
                  <i class="os-icon os-icon-thin-heart"></i>
                </div>
                <?php osetin_social_share_icons('header'); ?>
              </div>
              <div class="logo" style="width: <?php echo esc_attr($logo_image_width); ?>px;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <img src="<?php echo esc_url($logo_image_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                </a>
              </div>
              <div class="search-trigger"><i class="os-icon os-icon-search"></i></div>
            </div>
            <div class="top-menu-w" style="<?php echo osetin_get_css_prop('background-color', $top_menu_bg_color); ?><?php echo osetin_get_css_prop('background-image', $top_menu_bg_image_url); ?>; background-size: cover;">
              <?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'header-menu', 'container_class' => 'top-menu menu-activated-on-hover', 'fallback_cb' => false ) ); ?>
            </div>
          </div>
        <?php } ?>
      </div>
      <?php if(osetin_get_field('use_fixed_header', 'option')){ ?>
        <div class="fixed-header-w color-scheme-<?php echo osetin_get_field('fixed_menu_bar_background_color_type', 'option', 'light'); ?>" style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('fixed_menu_bar_background_color', 'option')); ?>">
          <div class="os-container">
            <div class="fixed-header-i">
              <div class="fixed-logo-w" style="width: <?php echo esc_attr($fixed_menu_logo_image_width); ?>px;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <img src="<?php echo esc_url($fixed_menu_logo_image_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
                </a>
              </div>
              <?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'fixed-header-menu', 'container_class' => 'fixed-top-menu-w menu-activated-on-hover', 'fallback_cb' => false ) ); ?>
              <div class="fixed-search-trigger-w">
                <div class="search-trigger"><i class="os-icon os-icon-search"></i></div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="mobile-header-w">
        <div class="mobile-header-menu-w menu-activated-on-click color-scheme-<?php echo osetin_get_field('mobile_header_background_color_type', 'option', 'dark'); ?>" style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('mobile_header_background_color', 'option')); ?>">
          <?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'mobile-header-menu', 'container' => '', 'fallback_cb' => false ) ); ?>
        </div>
        <div class="mobile-header color-scheme-<?php echo esc_attr($top_menu_bg_color_type); ?> " style="<?php echo osetin_get_css_prop('background-color', $top_menu_bg_color); ?><?php echo osetin_get_css_prop('background-image', $top_menu_bg_image_url); ?> background-size: cover;">
          <div class="mobile-menu-toggler">
            <i class="os-icon os-icon-menu"></i>
          </div>
          <div class="mobile-logo" style="width: <?php echo esc_attr($mobile_logo_image_width); ?>px;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url($mobile_logo_image_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"></a>
          </div>
          <div class="mobile-menu-search-toggler">
            <i class="os-icon os-icon-search"></i>
          </div>
        </div>
      </div>