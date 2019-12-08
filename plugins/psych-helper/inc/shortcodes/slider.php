<?php
add_shortcode( 'os_slider', 'os_slider_func' );
function os_slider_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'slider_style' => 'v1',
    'slide_ids' => false,
    'enable_arrows' => false,
    'enable_controls' => false,
    'is_parallax' => false,
    'autoslide_delay' => 0
  ), $atts );


  $extra_class = '';

  if($atts['enable_arrows'] != true){
    $extra_class.= ' without-arrows';
  }
  if($atts['is_parallax']){
    $extra_class.= ' with-parallax';
  }
  if($atts['enable_controls'] != true){
    $extra_class.= ' without-controls';
  }

  $args = array(
  'orderby' => 'date',
  'order'   => 'ASC',
  'post_type'   => 'osetin_slide',
  'posts_per_page' => -1
  );
  if($atts['slide_ids']) $args['post__in'] = explode(',', $atts['slide_ids']);

  $recent_posts_query = new WP_Query( $args );
  $counter = 1;
  $controls_html = '';
  $html = '
  <div class="os-container">
    <div class="os-slider-w style-'.$atts['slider_style'].$extra_class.'" data-autoslide="'.$atts['autoslide_delay'].'">
      <div class="os-slider-i">
        <div class="slide-navi-prev-v2"><i class="os-icon os-icon-arrow-left2"></i></div><div class="slide-navi-next-v2"><i class="os-icon os-icon-arrow-right2"></i></div>
        <div class="scroll-arrow">
          <i class="os-icon os-icon-arrow-1-down arrow-first"></i>
          <i class="os-icon os-icon-arrow-1-down arrow-second"></i>
          <i class="os-icon os-icon-arrow-1-down arrow-third"></i>
          <i class="os-icon os-icon-mouse-2 arrow-mouse"></i>
        </div>
        <svg class="os-intro-scroll-bg" width="193px" height="47px" viewBox="0 0 193 47" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <path d="M96.4967964,0.16015625 C143.388672,0.16015625 161.011719,32.3546569 193,46.4859222 L-1.02318154e-12,46.4859222 C31.6328125,29.2287075 49.6049209,0.16015625 96.4967964,0.16015625 Z" id="Rectangle-5" fill="#FFFFFF"></path>
        </svg>';
        $slider_navigation_html = '<div class="slider-navigation-w"><div class="slide-navi-prev"><i class="os-icon os-icon-arrow-up2"></i></div>';
        while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
          if(osetin_get_field('content_background_opacity')){
            $slider_content_bg = esc_attr('background-color: rgba(255,255,255, '. osetin_get_field('content_background_opacity').')');
          }else{
            $slider_content_bg = '';  
          }
          $edit_slide_link = get_edit_post_link();
          $edit_slide_link_html = ($edit_slide_link) ? '<a class="edit-slide-link" href="'.$edit_slide_link.'">'.__('Edit Slide', 'psych-helper').'</a>' : '';
          $active = ($counter == 1) ? 'active' : '';
          $content_side = osetin_get_field('content_side', false, 'right');
          $controls_html.= '<div class="control-slide '.$active.'" data-slide-id="'.$counter.'">
                              <div class="cs-icon"><i class="'.osetin_get_field('icon_class').'"></i></div>
                              <div class="cs-description-w">
                                <div class="cs-label">'.osetin_get_field('label').'</div>
                                <div class="cs-description">'.osetin_get_field('description').'</div>
                              </div>
                            </div>';
          $slider_navigation_html.= '<div class="slider-navigation-dot"></div>';
          $html.= '<div class="os-slide-w '.$active.' side-'.$content_side.'" data-slide-id="'.$counter.'">
                    <div class="os-slide">
                      <div class="os-slide-bg" style="background-image: url('.osetin_get_image_url_by_id(get_post_thumbnail_id(), 'osetin-full-width', '').');"></div>
                      <div class="os-slide-content"><div class="os-slide-shade" style="'.osetin_get_css_prop('background-color', osetin_get_field('highlight')).'"></div>
                        '.$edit_slide_link_html.'
                        <div class="os-slide-content-i" style="'.$slider_content_bg.'">';
                          ob_start();
                          the_content();
                          $html.= ob_get_clean();
                        $html.= '</div>
                      </div>
                    </div>
                  </div>';
          $counter++;
        endwhile;
        $slider_navigation_html.= '<div class="slide-navi-next"><i class="os-icon os-icon-arrow-down2"></i></div></div>';
        wp_reset_postdata();
        $html.='
      </div>'.$slider_navigation_html.'
      <div class="slider-controls">'.$controls_html.'</div>
    </div>
  </div>';
  return $html;
}



add_action( 'vc_before_init', 'vs_elem_osetin_slider' );
function vs_elem_osetin_slider() {
   vc_map( array(
      "name" => __( "Slider", "psych-helper" ),
      "base" => "os_slider",
      "icon" => "os-admin-icon-slideshow-1",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Slider Style", "psych-helper" ),
            "param_name" => "slider_style", 
            "value" => array(  __('Version 1', 'psych-helper') => 'v1',   __('Version 2', 'psych-helper') => 'v2'),
            "std" => __('Select Width', 'psych-helper'),
            "description" => __( "Select slider style.", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Slide ID(s) to show", "psych-helper" ),
            "param_name" => "slide_ids",
            "value" => "",
            "description" => __( "Enter comma separated list of slide ID(s) you want to show (e.g. 3,5,7). Leave blank to show all slides", "psych-helper" )
         ),
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Add Arrows Down and Scroll Icon", "psych-helper" ),
            "param_name" => "enable_arrows",
            "value" => false,
            "description" => ''
         ),
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Show slide descriptions under slides", "psych-helper" ),
            "param_name" => "enable_controls",
            "value" => false,
            "description" => ''
         ),
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Add Parallax Effect on Scroll", "psych-helper" ),
            "param_name" => "is_parallax",
            "value" => false,
            "description" => ''
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Autoslide delay", "psych-helper" ),
            "param_name" => "autoslide_delay",
            "value" => "",
            "description" => __( "To make the slider autoslide enter milliseconds value here, so for 3 seconds enter 3000. If you don't want it to autoslide just leave the field blank", "psych-helper" )
         ))
      )
   );
}