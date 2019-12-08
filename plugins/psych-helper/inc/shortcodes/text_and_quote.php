<?php
add_shortcode( 'os_text_and_quote', 'os_text_and_quote_func' );
function os_text_and_quote_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'quote_text' => '',
    'sub_title' => '',
    'quote_text_color' => '',
    'quote_bg_color' => '',
    'quote_bg_image' => '',
    'quote_author' => '',
    'quote_author_avatar' => '',
    'quote_author_extra' => '',
    'color_type' => 'light',
    'css' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  if($atts['sub_title'])
    $sub_title = '<h5 class="sub-title">'.$atts['sub_title'].'</h5>';
  else
    $sub_title = '';

  $quote_text_css = '';
  if($atts['quote_text_color']){
    $quote_text_css = 'color: '.$atts['quote_text_color'];
  }
  $quote_bg_css = '';
  if($atts['quote_bg_color']){
    $quote_bg_css.= 'background-color: '.$atts['quote_bg_color'].';';
    if(!$atts['quote_bg_image']) $quote_bg_css.= 'background-image: none;';
  }
  if($atts['quote_bg_image']){
    $quote_bg_css.= 'background-image: url('.osetin_get_image_url_by_id($atts['quote_bg_image'], 'osetin-full-width').');';
  }

  $color_type = ' color-scheme-dark';
  if($atts['color_type'] == 'light'){
    $color_type = ' color-scheme-light';
  }

  $html =   '<div class="os-container">
              <div class="os-text-and-quote-w '.$color_type.' '.vc_shortcode_custom_css_class($atts['css']).'" style="'.$quote_bg_css.'">
                <div class="container-fluid">
                  <div class="os-text-and-quote-i">
                    <div class="os-tq-content-left">'.$sub_title.$content.'</div>
                    <div class="os-tq-quote-w">
                      <div class="os-tq-quote-i">
                        <div class="os-tq-quote" style="'.$quote_text_css.'">'.$atts['quote_text'].'</div>
                        <div class="os-tq-author">
                          <div class="os-tq-author-avatar" style="background-image: url('.osetin_get_image_url_by_id($atts['quote_author_avatar'], 'osetin-full-width').')"></div>
                          <div class="os-tq-author-avatar-name">'.$atts['quote_author'].'</div>
                          <div class="os-tq-author-avatar-extra">'.$atts['quote_author_extra'].'</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_text_and_quote' );
function vc_elem_text_and_quote() {
   vc_map( array(
      "name" => __( "Text and Quote Block", "psych-helper" ),
      "base" => "os_text_and_quote",
      "icon" => "os-admin-icon-comments-2",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Text Content", "psych-helper" ),
            "param_name" => "content", 
            "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
            "description" => __( "Enter your content.", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Sub Title", "psych-helper" ),
            "param_name" => "sub_title",
            "value" => "",
            "description" => __( "Enter sub title", "psych-helper" )
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Quote", "psych-helper" ),
            "param_name" => "quote_text",
            "value" => "",
            "description" => __( "Enter text for quote", "psych-helper" )
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Quote Text Color (optional)", "psych-helper" ),
            "param_name" => "quote_text_color",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Quote Background Color (optional)", "psych-helper" ),
            "param_name" => "quote_bg_color",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Background Image (optional)", "psych-helper" ),
            "param_name" => "quote_bg_image",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "attach_image",
            "class" => "",
            "heading" => __( "Author Avatar", "psych-helper" ),
            "param_name" => "quote_author_avatar",
            "value" => '',
            "description" => ''
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Quote Author", "psych-helper" ),
            "param_name" => "quote_author",
            "value" => "",
            "description" => ''
         ),
         array(
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Quote Author Extra Text", "psych-helper" ),
            "param_name" => "quote_author_extra",
            "value" => "",
            "description" => ''
         ),
         array(
            "type" => "dropdown",
            "holder" => "div",
            "class" => "",
            "heading" => __( "Color Type", "psych-helper" ),
            "param_name" => "color_type",
            "value" => array( __('Light', 'psych-helper') => 'light',  __('Dark', 'psych-helper') => 'dark'),
            "description" => __( "Color Scheme Type for the element", "psych-helper" )
         ))
      )
   );
}