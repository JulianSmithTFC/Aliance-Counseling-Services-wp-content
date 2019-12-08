<?php
add_shortcode( 'os_faq', 'os_faq_func' );
function os_faq_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
     'question' => '',
     'css' => ''
  ), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content


  $html = '<div class="os-faq-item ' . vc_shortcode_custom_css_class($atts['css']) . '">
            <div class="os-faq-question-w">
              <div class="icon-w"><i class="os-icon os-icon-plus-square"></i></div>
              <h6 class="os-faq-question">'. $atts['question'].'</h6>
            </div>
            <div class="os-faq-answer">'. $content.'</div>
          </div>';
  return $html;
}

add_action( 'vc_before_init', 'vc_elem_os_faq' );
function vc_elem_os_faq() {
   vc_map( array(
      "name" => __( "FAQ Item", "psych-helper" ),
      "base" => "os_faq",
      "icon" => "os-admin-icon-window-content",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
                    array(
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Question", "psych-helper" ),
                      "param_name" => "question",
                      "value" => "",
                      "description" => __( "Question Title", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
                    ),
                   array(
                      "type" => "textarea_html",
                      "holder" => "div",
                      "class" => "",
                      "heading" => __( "Answer", "psych-helper" ),
                      "param_name" => "content",
                      "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
                      "group" => __( "Content", "psych-helper" ),
                   ),
                    array(
                      "type" => "css_editor",
                      "heading" => __( "Css", "psych-helper" ),
                      "param_name" => "css",
                      "group" => __( "Design options", "psych-helper" ),
                    ),
      ))
   );
}
