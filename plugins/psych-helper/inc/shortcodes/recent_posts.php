<?php


add_shortcode( 'os_recent_posts', 'os_recent_posts_func' );
function os_recent_posts_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'css' => '', 
    'color_type' => 'light',
    'custom_post_tile_color' => false, 
    'css' => ''), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $form_header_html = '';

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args = array(
  'orderby' => 'date',
  'order'   => 'DESC',
  'post_type' => 'post',
  'posts_per_page' => 6
  );

  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $post_bg_color = '';
  if($atts['custom_post_tile_color']){
    $post_bg_color = "background-color: {$atts['custom_post_tile_color']};";
  }

  $recent_posts_query = new WP_Query( $args );
  $html = '
  <div class="os-container">
    <div class="os-recent-posts '.vc_shortcode_custom_css_class($atts['css']).' '. $color_type .'">
      <div class="container-fluid"><div class="recent-posts-slider">';
          while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
            $html.= '<div class="recent-post-w"><div class="recent-post-i" style="'.$post_bg_color.'">';
              $html.= '<a href="'.get_the_permalink().'" class="recent-post-media" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), "osetin-full-width").');"></a>';
              $html.= '<h6><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>';
            $html.= '</div></div>';
          endwhile;
          wp_reset_postdata();
  $html.='
      </div></div>
    </div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_recent_posts' );
function vs_elem_recent_posts() {
   vc_map( array(
      "name" => __( "Recent Posts", "psych-helper" ),
      "base" => "os_recent_posts",
      "icon" => "os-admin-icon-newspaper",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Color Type", "psych-helper" ),
          "param_name" => "color_type",
          "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
          "description" => __( "Color Scheme Type for the element", "psych-helper" ),
          "group" => __( "Design options", "psych-helper" ),
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Custom Color for Post Tile (optional)", "psych-helper" ),
          "param_name" => "custom_post_tile_color",
          "value" => '',
          "description" => '',
          "group" => __( "Design options", "psych-helper" ),
        ),
        array(
          "type" => "css_editor",
          "heading" => __( "Css", "psych-helper" ),
          "param_name" => "css",
          "group" => __( "Design options", "psych-helper" ),
        ),)
      )
   );
}