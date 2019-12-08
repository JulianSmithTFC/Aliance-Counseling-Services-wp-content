<?php
add_shortcode( 'os_text_and_image', 'os_text_and_image_func' );
function os_text_and_image_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'sub_title' => '',
     'image_width' => '',
     'image_side' => '',
     'image_url' => '',
     'color_type' => 'light',
     'custom_text_highlight' => '',
     'custom_element_highlight' => '',
     'custom_headers_color' => '',
     'custom_text_color' => '',
     'css' => ''
  ), $atts );

  $custom_style = '';
  $css_custom_class = '';
  if($atts['custom_text_highlight'] != '' || $atts['custom_element_highlight'] != '' || $atts['custom_headers_color'] != '' || $atts['custom_text_color'] != ''){
    $css_custom_class = uniqid('sc_text_image_');
    if($atts['custom_text_color']) 
      $custom_style.= ".{$css_custom_class} { color: {$atts['custom_text_color']}!important; }";
    if($atts['custom_headers_color']) 
      $custom_style.= ".{$css_custom_class} h1, .{$css_custom_class} h2, .{$css_custom_class} h3, .{$css_custom_class} h4, .{$css_custom_class} h5 { color: {$atts['custom_headers_color']}!important; }";
    if($atts['custom_element_highlight']) 
      $custom_style.= ".{$css_custom_class} h1:after, .{$css_custom_class} h2:after, .{$css_custom_class} h3:after { background-color: {$atts['custom_element_highlight']}!important; }";
    if($atts['custom_text_highlight']) 
      $custom_style.= ".{$css_custom_class} .sub-title { color: {$atts['custom_text_highlight']}!important; }";
    $custom_style = '<style>'.$custom_style.'</style>';
  }

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  switch ($atts['image_width']) {
    case 'half':
      $column_classes = array('col-md-6', 'col-md-6');
    break;

    case 'more':
      $column_classes = array('col-md-5', 'col-md-7');
    break;

    default:
      $column_classes = array('col-md-7', 'col-md-5');
    break;
  }

  if($atts['sub_title'])
    $sub_title = '<h5 class="sub-title">'.$atts['sub_title'].'</h5>';
  else
    $sub_title = '';

  $image_html = '<div class="'.$column_classes[1].' os-ti-image" style="background-image: url('.osetin_get_image_url_by_id($atts['image_url'], 'full', '').');"></div>';
  $text_html = '<div class="'.$column_classes[0].'"><div class="os-ti-content-left">'.$sub_title.$content.'</div></div>';
  $content_html = ($atts['image_side'] == 'right') ? $text_html.$image_html : $image_html.$text_html;

  if($atts['image_side'] == 'right') $direction = 'sm-reverse';
  else $direction = '';


  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }
  $html =   $custom_style. '<div class="os-container"><div class="os-text-and-image '.$color_type.' ' . vc_shortcode_custom_css_class($atts['css']) . ' ' . esc_attr($css_custom_class) .'"><div class="container-fluid">
              <div class="row '.$direction.'">'.$content_html.'</div>
            </div></div></div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_text_and_image' );
function vc_elem_text_and_image() {
   vc_map( array(
      "name" => __( "Text and Image Block", "psych-helper" ),
      "base" => "os_text_and_image",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Image for the side", "psych-helper" ),
            "param_name" => "image_url",
            "value" => '',
            "description" => __( "Choose image", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Image Occupies", "psych-helper" ),
            "param_name" => "image_width", 
            "value" => array(  __('Half', 'psych-helper') => 'half',   __('More than half', 'psych-helper') => 'more',   __('Less than half', 'psych-helper') => 'less'),
            "std" => __('Select Width', 'psych-helper'),
            "description" => __( "Select Image width.", "psych-helper" ),
            "group" => __( "Layout", "psych-helper" ),
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Image Side", "psych-helper" ),
            "param_name" => "image_side", 
            "value" => array( __('On the right', 'psych-helper') => 'right' ,  __('On the left', 'psych-helper') => 'left' ),
            "std" => __('Select Side', 'psych-helper'),
            "description" => __( "Select image side.", "psych-helper" ),
            "group" => __( "Layout", "psych-helper" ),
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Sub Title", "psych-helper" ),
            "param_name" => "sub_title",
            "value" => "",
            "description" => __( "Enter sub title", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Enter your content.", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Type", "psych-helper" ),
            "param_name" => "color_type",
            "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Color Scheme Type for the element", "psych-helper" ),
            'group' => __( 'Custom Colors', 'psych-helper' ),
         ),
          array(
              "type" => "css_editor",
              "heading" => __( "Css", "psych-helper" ),
              "param_name" => "css",
              "group" => __( "Design options", "psych-helper" ),
          ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Custom Color for Highlighted Text (optional)", "psych-helper" ),
            "param_name" => "custom_text_highlight",
            "value" => '',
            "description" => '',
            "group" => __( "Custom Colors", "psych-helper" ),
          ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Custom Color for Highlighted Element (optional)", "psych-helper" ),
            "param_name" => "custom_element_highlight",
            "value" => '',
            "description" => '',
            "group" => __( "Custom Colors", "psych-helper" ),
          ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Custom Color for Heading Text (optional)", "psych-helper" ),
            "param_name" => "custom_headers_color",
            "value" => '',
            "description" => '',
            "group" => __( "Custom Colors", "psych-helper" ),
          ),
          array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Custom Color for Body Text (optional)", "psych-helper" ),
            "param_name" => "custom_text_color",
            "value" => '',
            "description" => '',
            "group" => __( "Custom Colors", "psych-helper" ),
          ),



      ))
   );
}