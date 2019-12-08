<?php
function osetin_shortcode_social_links_func( $atts ) {
    $atts = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    $output = '';

    if( osetin_have_rows('social_links', 'option') ){
      $output.= '<ul class="shortcode-social-links">';

      // loop through the rows of data
      while ( osetin_have_rows('social_links', 'option') ) : the_row();
          $output.= '<li><a href="'.esc_url(get_sub_field('social_page_url')).'" target="_blank"><i class="os-icon os-icon-'.esc_attr(get_sub_field('social_network')).'"></i></a></li>';
      endwhile;

      $output.= '</ul>';

    }
    return $output;
}
add_shortcode( 'osetin_social_links', 'osetin_shortcode_social_links_func' );
