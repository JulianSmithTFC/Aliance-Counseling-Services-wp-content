<?php

add_shortcode( 'os_cta_block', 'os_cta_block_func' );
function os_cta_block_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'color_type' => 'light',
     'offer_image_url' => '',
     'link_label' => '',
     'link_url' => '',
     'link_bg_color' => '',
     'link_text_color' => '',
     'bg_color' => false,
     'bg_image_url' => false,
     'css' => ''
  ), $atts );


  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  if($atts['link_label']){
    $btn_css = '';
    if($atts['link_bg_color']){
      $btn_css.= 'background-color: '.$atts['link_bg_color'].';';
    }
    if($atts['link_text_color']){
      $btn_css.= 'color: '.$atts['link_text_color'].';';
    }
    $link_html = '<div class="cta-button"><a href="'.$atts['link_url'].'" class="os-btn white" style="'.$btn_css.'">'.$atts['link_label'].'</a></div>';
  }else{
    $link_html = '';
  }

  if($atts['offer_image_url']){
    $offer_img_html = '<div class="cta-offer-img"><img alt="'.esc_attr($atts['link_label']).'" src="'.osetin_get_image_url_by_id($atts['offer_image_url'], 'osetin-full-width', '').'"/></div>';
    $has_offer_img = 'with-offer-img';
  }else{
    $offer_img_html = '';
    $has_offer_img = 'without-offer-img';
  }

  $color_type = ' color-scheme-dark';
  if($atts['color_type'] == 'light'){
    $color_type = ' color-scheme-light';
  }

  $extra_style = '';
  if($atts['bg_color']){
     $extra_style.= 'background-color: '.$atts['bg_color'].';';
  }
  if($atts['bg_image_url']){
     $extra_style.= 'background-image: url('.osetin_get_image_url_by_id($atts['bg_image_url'], 'osetin-full-width', '').');"';
  }

  $html =   '<div class="os-container">
              <div class="os-cta-block '.$has_offer_img.$color_type.' '.vc_shortcode_custom_css_class($atts['css']).'" style="'.$extra_style.'">
                '.$offer_img_html.'
                <div class="cta-content">
                  <div class="cta-text">'.$content.'</div>
                  '.$link_html.'
                </div>
              </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_cta_block' );
function vc_elem_cta_block() {
   vc_map( array(
      "name" => __( "Call to Action", "psych-helper" ),
      "base" => "os_cta_block",
      "icon" => "os-admin-icon-target-1",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
        array(
          "type" => "textarea_html",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Call to action text content", "psych-helper" ),
          "param_name" => "content", 
          "value" => __( "<h3>Special Offer Available Here</h3><p>Pros hope out it of the and is that degree has him, sat nice those for of agreeable. Subject little a involved. Sports. Name area on then grant view of the with congress, ideas instead of clues of the a there in his music. </p>", "psych-helper" ),
          "description" => __( "Type in call to action text content.", "psych-helper" ),
          "group" => __( "Content", "psych-helper" ),
        ),
        array(
          "type" => "attach_image",
          "class" => "",
          "heading" => __( "Offer Image (optional)", "psych-helper" ),
          "param_name" => "offer_image_url",
          "value" => '',
          "description" => __( "Choose image for the offer (e.g. book cover)", "psych-helper" ),
          "group" => __( "Content", "psych-helper" ),
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Button Label", "psych-helper" ),
          "param_name" => "link_label",
          "value" => "",
          "description" => __( "Enter link label. Leave blank to not use link", "psych-helper" ),
          "group" => __( "Button Settings", "psych-helper" ),
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Button URL", "psych-helper" ),
          "param_name" => "link_url",
          "value" => "",
          "description" => __( "Enter url where the link would point to", "psych-helper" ),
          "group" => __( "Button Settings", "psych-helper" ),
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Button Background Color (optional)", "psych-helper" ),
          "param_name" => "link_bg_color",
          "value" => '',
          "description" => __( "Choose color for the button background", "psych-helper" ),
          "group" => __( "Button Settings", "psych-helper" ),
        ),
        array(
          "type" => "colorpicker",
          "class" => "",
          "heading" => __( "Button Text Color (optional)", "psych-helper" ),
          "param_name" => "link_text_color",
          "value" => '',
          "description" => __( "Choose color for the button color", "psych-helper" ),
          "group" => __( "Button Settings", "psych-helper" ),
        ),
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Color Type", "psych-helper" ),
          "param_name" => "color_type",
          "value" => array(  __('Dark', 'psych-helper') => 'dark',  __('Light', 'psych-helper') => 'light'),
          "description" => __( "Color Scheme Type for the element", "psych-helper" ),
          "group" => __( "Design options", "psych-helper" ),
        ),
        array(
            "type" => "css_editor",
            "heading" => __( "Css", "psych-helper" ),
            "param_name" => "css",
            "group" => __( "Design options", "psych-helper" ),
        ))
      )
   );
}