<?php


add_shortcode( 'os_section_desc', 'os_section_desc_func' );
function os_section_desc_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'sub_header' => '',
     'icon_class' => '',
     'alignment' => '',
     'color_type' => 'light',
     'css' => '',
     'custom_text_highlight' => '',
     'custom_element_highlight' => '',
     'custom_headers_color' => '',
     'custom_text_color' => '',
     'compact' => false), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $extra_class = $atts['compact'] ? ' desc-compact' : '';

  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }

  $icon_html = '';
  if($atts['icon_class']){
    $icon_html = '<div class="icon-w"><i class="'.$atts['icon_class'].'"></i></div>';
  }

  $custom_style = '';
  $css_custom_class = '';
  if($atts['custom_text_highlight'] != '' || $atts['custom_element_highlight'] != '' || $atts['custom_headers_color'] != '' || $atts['custom_text_color'] != ''){
    $css_custom_class = uniqid('sc_section_desc_');
    if($atts['custom_text_color']) 
      $custom_style.= ".{$css_custom_class} { color: {$atts['custom_text_color']}!important; }";
    if($atts['custom_headers_color']) 
      $custom_style.= ".{$css_custom_class} h1, .{$css_custom_class} h2, .{$css_custom_class} h3, .{$css_custom_class} h4, .{$css_custom_class} h5 { color: {$atts['custom_headers_color']}!important; }";
    if($atts['custom_element_highlight']) 
      $custom_style.= ".{$css_custom_class} h1:after, .{$css_custom_class} h2:after, .{$css_custom_class} h3:after { background-color: {$atts['custom_element_highlight']}!important; }";
    if($atts['custom_text_highlight']) 
      $custom_style.= ".{$css_custom_class} .section-description-sub-header { color: {$atts['custom_text_highlight']}!important; }";
    $custom_style = '<style>'.$custom_style.'</style>';
  }

  $html = $custom_style.'
  <div class="os-container">
    <div class="os-section-description align-'.$atts['alignment'].$extra_class.' '.$color_type.' '.vc_shortcode_custom_css_class($atts['css']).' '. $css_custom_class .'"><div class="os-section-description-i">';
      $html .= $icon_html;
      if($atts['sub_header'] != '') $html.= '<h5 class="section-description-sub-header">'.$atts['sub_header'].'</h5>';

      $html.= '<div class="section-description-content">'.$content.'</div>';

      $html.='
    </div></div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_section_desc' );
function vs_elem_section_desc() {
   vc_map( array(
      "name" => __( "Section Description", "psych-helper" ),
      "base" => "os_section_desc",
      "icon" => "os-admin-icon-diploma-1",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Sub Header", "psych-helper" ),
            "param_name" => "sub_header",
            "value" => "",
            "description" => __( "Optional Subheader", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => "",
            "description" => __( "Type in the section content.", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Icon Class (Optional)", "psych-helper" ),
            "param_name" => "icon_class",
            "value" => "",
            "description" => __( "Optional Icon to show above", "psych-helper" ),
            "group" => __( "Content", "psych-helper" ),
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Alignment", "psych-helper" ),
            "param_name" => "alignment", 
            "value" => array(  __('Left', 'psych-helper') => 'left',   __('Center', 'psych-helper') => 'center',   __('Right', 'psych-helper') => 'right'),
            "description" => __( "Which side to align content.", "psych-helper" ),
            "group" => __( "Layout", "psych-helper" ),
         ),
         array(
            "type" => "checkbox",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Use less top and bottom padding", "psych-helper" ),
            "param_name" => "compact", 
            "value" => false,
            "description" => '',
            "group" => __( "Layout", "psych-helper" ),
         ),
          array(
              "type" => "css_editor",
              "heading" => __( "Css", "psych-helper" ),
              "param_name" => "css",
              "group" => __( "Design options", "psych-helper" ),
          ),array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Type", "psych-helper" ),
            "param_name" => "color_type",
            "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Color Scheme Type for the element", "psych-helper" ),
            "group" => __( "Custom Colors", "psych-helper" ),
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
          ))
      )
   );
}