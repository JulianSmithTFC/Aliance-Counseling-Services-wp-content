<?php

add_shortcode( 'os_testimonials', 'os_testimonials_func' );
function os_testimonials_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'color_type' => 'light',
    'css' => ''), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $form_header_html = '';

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args = array(
  'orderby' => 'date',
  'order'   => 'ASC',
  'post_type' => 'osetin_testimonial',
  'posts_per_page' => -1
  );
  $testimonials_query = new WP_Query( $args );

  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $css_html = vc_shortcode_custom_css_class($atts['css']);

  $html = '
  <div class="os-container">
    <div class="os-testimonials '.$color_type.' '.$css_html.'">
      <div class="container-fluid"><div class="testimonials-slider">';
          while ( $testimonials_query->have_posts() ) : $testimonials_query->the_post();
            $html.= '<div class="testimonial"><div class="row">';
              $html.= '<div class="col-md-4 offset-md-1 align-items-center"><div class="testimonial-image"><img alt="'.esc_attr(get_the_title()).'" src="'.get_the_post_thumbnail_url(get_the_ID(), "osetin-full-width").'"/></div></div>';
              $html.= '<div class="col-md-6 align-items-center"><div class="testimonial-text">'.get_the_excerpt().'</div><div class="testimonial-author">'.get_the_title().'</div></div>';
            $html.= '</div></div>';
          endwhile;
          wp_reset_postdata();
  $html.='
      </div></div>
    </div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_testimonials' );
function vs_elem_testimonials() {
   vc_map( array(
      "name" => __( "Testimonials", "psych-helper" ),
      "base" => "os_testimonials",
      "icon" => "os-admin-icon-comment-2-smile",
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
            "description" => __( "Color Scheme Type for the element", "psych-helper" )
          ),
          array(
              'type' => 'css_editor',
              'heading' => __( 'Css', 'psych-helper' ),
              'param_name' => 'css',
              'group' => __( 'Design options', 'psych-helper' ),
          ))
      )
   );
}