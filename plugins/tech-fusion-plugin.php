<?php
/**
 * Plugin Name: Tech Fusion Hot Fix Plugin
 * Description: This Plugin is used to create the custom sidebar menu's for Alliance Counseling Services website
 * Version: 1.0
 * Author: Julian Smith - Tech Fusion
 * Author URI: https://techfusionconsulting.com/
 */


add_shortcode( 'os_box_with_attachment_fixed', 'os_box_with_attachment_fixed_func' );
function os_box_with_attachment_fixed_func( $atts, $content = null ) { // New function parameter $content is added!
    $atts = shortcode_atts( array(
        'file_url' => '',
        'link_name' => '',
        'icon_css' => '',
        'icon_color' => '',
        'link_text_color' => '',
    ), $atts );

    $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

    $file_link_html = '<div class="box-file-link-w"><i style="color: '.esc_attr($atts['icon_color']).' !important;" class="'.esc_attr($atts['icon_css']).'"></i><a href="'
        .esc_attr
        ($atts['file_url']).'" target="_blank" style="color: '.esc_attr($atts['link_text_color']).' !important; border-color: '.esc_attr($atts['link_text_color']).' !important;">
'.esc_attr($atts['link_name']).'</a></div>';
    $text_html = '<div class="box-file-description">'.$content.'</div>';

    $html =  '<div class="os-box-with-attachment">'.$file_link_html.$text_html.'</div>';
    return $html;
}

add_action( 'vc_before_init', 'vc_elem_box_with_attachment_fixed' );
function vc_elem_box_with_attachment_fixed() {
    vc_map( array(
            "name" => __( "Fixed Box with Attachment", "psych-helper" ),
            "base" => "os_box_with_attachment_fixed",
            "icon" => "os-admin-icon-window-content",
            "class" => "",
            "category" => __( "Psychology", "psych-helper"),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Icon", "psych-helper" ),
                    "param_name" => "icon_css",
                    "value" => "",
                    "description" => __( "Enter Icon CSS", "psych-helper" )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Link URL", "psych-helper" ),
                    "param_name" => "file_url",
                    "value" => "",
                    "description" => __( "Enter full file url", "psych-helper" )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Link Name", "psych-helper" ),
                    "param_name" => "link_name",
                    "value" => "",
                    "description" => __( "Enter The Link URL", "psych-helper" )
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Icon Color (Optional)", "psych-helper" ),
                    "param_name" => "icon_color",
                    "value" => '',
                    "description" => __( "Choose color for the icon", "psych-helper" )
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Link Text Color (Optional)", "psych-helper" ),
                    "param_name" => "link_text_color",
                    "value" => '',
                    "description" => __( "Choose color for the link text", "psych-helper" )
                ),
                array(
                    "type" => "textarea_html",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Text Content", "psych-helper" ),
                    "param_name" => "content",
                    "value" => __( "<p>I am test text block. Click edit button to change this text.</p>", "psych-helper" ),
                    "description" => __( "Enter your content.", "psych-helper" ),
                ),



            ))
    );
}































add_shortcode( 'os_john_booking_widget', 'os_john_booking_widget_func' );
function os_john_booking_widget_func( $atts, $content = null ) { // New function parameter $content is added!
    $atts = shortcode_atts( array(
        'button_text' => '',
        'button_color' => '',
        'button_text_color' => '',
    ), $atts );

    $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

    $file_link_html = '<div class="box-file-link-w"><i style="color: '.esc_attr($atts['icon_color']).' !important;" class="'.esc_attr($atts['icon_css']).'"></i><a href="'
        .esc_attr
        ($atts['file_url']).'" target="_blank" style="color: '.esc_attr($atts['link_text_color']).' !important; border-color: '.esc_attr($atts['link_text_color']).' !important;">
'.esc_attr($atts['link_name']).'</a></div>';
    $text_html = '<div class="box-file-description">'.$content.'</div>';

    $html =  '<!-- Start SimplePractice Booking Widget Embed Code -->
<style>.spwidget-button-wrapper{text-align: center}.spwidget-button{display: inline-block;padding: 12px 24px;color: '.esc_attr($atts['button_text_color']).' !important;background: '.esc_attr($atts['button_color']).';border: 0;border-radius: 4px;font-size: 16px;font-weight: 600;text-decoration: none}.spwidget-button:hover{background: #d15913}.spwidget-button:active{color: rgba(255, 255, 255, .75) !important;box-shadow: 0 1px 3px rgba(0, 0, 0, .15) inset}</style>
<div class="spwidget-button-wrapper"><a href="https://john-frisbie-lcpc.clientsecure.me" class="spwidget-button" data-spwidget-scope-id="7e6c6359-223a-48a4-b2e5-afa9ce08dfd7" data-spwidget-scope-uri="john-frisbie-lcpc" data-spwidget-application-id="7c72cb9f9a9b913654bb89d6c7b4e71a77911b30192051da35384b4d0c6d505b" data-spwidget-scope-global data-spwidget-autobind>'.esc_attr($atts['button_text']).'</a></div>
<script src="https://widget-cdn.simplepractice.com/assets/integration-1.0.js"></script>
<!-- End SimplePractice Booking Widget Embed Code -->';

    return $html;
}

add_action( 'vc_before_init', 'vc_elem_john_booking_widget' );
function vc_elem_john_booking_widget() {
    vc_map( array(
            "name" => __( "John Simple Practice Booking Widget", "psych-helper" ),
            "base" => "os_john_booking_widget",
            "icon" => "os-admin-icon-window-content",
            "class" => "",
            "category" => __( "Psychology", "psych-helper"),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __( "Button Text", "psych-helper" ),
                    "param_name" => "button_text",
                    "value" => "",
                    "description" => __( "Enter the title of the button", "psych-helper" )
                ),

                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Button Color (Optional)", "psych-helper" ),
                    "param_name" => "button_color",
                    "value" => '',
                    "description" => __( "Choose color for the link text", "psych-helper" )
                ),

                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Text Color (Optional)", "psych-helper" ),
                    "param_name" => "button_text_color",
                    "value" => '',
                    "description" => __( "Choose color for the link text", "psych-helper" )
                ),
            ))
    );
}



// Add Shortcode
function simple_practice_appointment_widtget_john() {

    ?>
    <!-- Start SimplePractice Booking Widget Embed Code -->
    <style>.spwidget-button-wrapper{text-align: center}.spwidget-button{display: inline-block;padding: 12px 24px;color: #fff !important;background: #de6a26;border: 0;border-radius: 4px;font-size: 16px;font-weight: 600;text-decoration: none}.spwidget-button:hover{background: #d15913}.spwidget-button:active{color: rgba(255, 255, 255, .75) !important;box-shadow: 0 1px 3px rgba(0, 0, 0, .15) inset}</style>
    <div class="spwidget-button-wrapper"><a href="https://john-frisbie-lcpc.clientsecure.me" class="spwidget-button" data-spwidget-scope-id="7e6c6359-223a-48a4-b2e5-afa9ce08dfd7" data-spwidget-scope-uri="john-frisbie-lcpc" data-spwidget-application-id="7c72cb9f9a9b913654bb89d6c7b4e71a77911b30192051da35384b4d0c6d505b" data-spwidget-scope-global data-spwidget-autobind>Request Appointment</a></div>
    <script src="https://widget-cdn.simplepractice.com/assets/integration-1.0.js"></script>
    <!-- End SimplePractice Booking Widget Embed Code -->
<?php

}
add_shortcode( 'Simple Practice Booking Widget -  John', 'simple_practice_appointment_widtget_john' );


