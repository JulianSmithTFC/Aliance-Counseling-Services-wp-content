<?php
add_shortcode( 'os_iconed_feature', 'os_iconed_feature_func' );
function os_iconed_feature_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'icon_class' => '',
     'icon_color' => '',
     'media_position' => 'top',
     'wrapped_in_box' => 'no',
     'media_size' => '',
     'text_align' => 'center',
     'image_url' => '',
     'link_label' => '',
     'link_url' => '',
     'link_class' => '',
     'color_scheme' => 'light',
     'header_text' => '',
     'header_color' => '',
     'css' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  if($atts['link_label']){
    if($atts['link_class']){
      $link_html = '<div class="fwi-link-w"><a class="os-btn '.esc_attr($atts['link_class']).'" href="'.$atts['link_url'].'">'.$atts['link_label'].'</a></div>';
    }else{
      $link_html = '<div class="fwi-link-w without-class"><a href="'.$atts['link_url'].'">'.$atts['link_label'].'</a></div>';
    }
  }else{
    $link_html = '';
  }

  $media_style = '';
  $heading_style = '';
  $media_wrapper_style = '';

  if($atts['header_color']){
    $heading_style.= 'color: '.$atts['header_color'].';';
  }
  if($atts['media_size']) $media_wrapper_style= 'width: '.$atts['media_size'].';';

  if($atts['image_url']){
    if($atts['media_size']) $media_style.= 'width: '.$atts['media_size'].';';
    $media_html = '<img alt="'.esc_attr($atts['header_text']).'" src="'.osetin_get_image_url_by_id($atts['image_url'], 'osetin-full-width', '').'" style="'.$media_style.'">';
  }else{
    if($atts['icon_color']) $media_style.= 'color: '.$atts['icon_color'].';';
    if($atts['media_size']) $media_style.= 'font-size: '.$atts['media_size'].';';
    $media_html = '<i class="'.$atts['icon_class'].'" style="'.$media_style.'"></i>';
  }

  $extra_feature_class = '';
  if($atts['wrapped_in_box'] == 'yes'){
    $extra_feature_class = 'wrapped-in-box';
  }

  $html =   '<div class="os-feature-with-icon '.$extra_feature_class.' color-scheme-'.$atts['color_scheme'].' text-align-'.$atts['text_align'].' media-position-'.$atts['media_position'].' '.vc_shortcode_custom_css_class($atts['css']).'">
                <div class="fwi-media-w" style="'.$media_wrapper_style.'">'.$media_html.'</div>
                <div class="fwi-content-w">
                  <h5 class="fwi-header" style="'.$heading_style.'">'.$atts['header_text'].'</h5>
                  <div class="fwi-content">'.$content.'</div>
                  '.$link_html.'
                </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_iconed_feature' );
function vc_elem_iconed_feature() {
   vc_map( array(
      "name" => __( "Feature with Icon or Image", "psych-helper" ),
      "base" => "os_iconed_feature",
      "icon" => "os-admin-icon-content-1",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Feature Heading", "psych-helper" ),
            "param_name" => "header_text",
            "value" => "",
            "description" => __( "Enter heading text for the feature", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Heading Text Color (optional)", "psych-helper" ),
            "param_name" => "header_color",
            "value" => '',
            "description" => __( "Choose color for heading text", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Class", "psych-helper" ),
            "param_name" => "icon_class",
            "value" => "",
            "description" => __( "Enter class of the icon font you want to use. See all available icons by <a href='http://zelus.pinsupreme.com/icon-list' target='_blank'>clicking here</a>", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Icon Color (optional)", "psych-helper" ),
            "param_name" => "icon_color",
            "value" => '',
            "description" => __( "Choose color for the icon", "psych-helper" )
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Feature Description", "psych-helper" ),
            "param_name" => "content",
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Feature Description.", "psych-helper" )
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Image (optional)", "psych-helper" ),
            "param_name" => "image_url",
            "value" => '',
            "description" => __( "If you want you can use image instead of the icon font. Select the image here and set it's width below", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Image Width/Icon Size (optional)", "psych-helper" ),
            "param_name" => "media_size",
            "value" => "",
            "description" => __( "Enter size for image or icon you want to use from above (e.g. 50px).", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Link Label", "psych-helper" ),
            "param_name" => "link_label",
            "value" => "",
            "description" => __( "Enter link label. Leave blank to not use link", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Link URL", "psych-helper" ),
            "param_name" => "link_url",
            "value" => "",
            "description" => __( "Enter url where the link would point to", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Link Style Class (optional)", "psych-helper" ),
            "param_name" => "link_class",
            "value" => "",
            "description" => __( "By default it will use an underlined link style. You can add custom class or one of the classes of [os_btn] shortcode to customize it.", "psych-helper" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Layout Type", "psych-helper" ),
            "param_name" => "media_position", 
            "value" => array( __('Text below', 'psych-helper') => 'top', __('Text on the Right', 'psych-helper') => 'left'),
            "description" => __( "Select Style for the layout", "psych-helper" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Align", "psych-helper" ),
            "param_name" => "text_align", 
            "value" => array(  __('Center', 'psych-helper') => 'center',   __('Left', 'psych-helper') => 'left'),
            "description" => __( "Select Style for the layout", "psych-helper" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "In a box?", "psych-helper" ),
            "param_name" => "wrapped_in_box", 
            "value" => array(  __('No', 'psych-helper') => 'no', __('Yes', 'psych-helper') => 'yes'),
            "description" => __( "", "psych-helper" )
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Scheme", "psych-helper" ),
            "param_name" => "color_scheme",
            "value" => array(  __('Light', 'psych-helper') => 'light',   __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Select Color Scheme for element", "psych-helper" )
         ))
      )
   );
}
