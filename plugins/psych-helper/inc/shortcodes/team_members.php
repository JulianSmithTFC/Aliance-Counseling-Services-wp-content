<?php


add_shortcode( 'os_team_members', 'os_team_members_func' );
function os_team_members_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'layout_style' => 'style_v1', 
    'color_type' => 'light',
    'css' => '',
    'team_member_ids' => ''), $atts );

  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $form_header_html = '';

  $args = array(
  'orderby' => 'date',
  'order'   => 'ASC',
  'post_type' => 'osetin_team_member',
  'posts_per_page' => -1
  );
  if($atts['team_member_ids']) $args['post__in'] = explode(',', $atts['team_member_ids']);

  $team_query = new WP_Query( $args );


  $color_type = ' color-scheme-light';
  if($atts['color_type'] == 'dark'){
    $color_type = ' color-scheme-dark';
  }


  $fluid_container = ($atts['layout_style'] != 'style_v3') ? 'container-fluid' : 'three-columns';
  $html = '
  <div class="os-container">
    <div class="os-team-members '.$atts['layout_style'].' '.vc_shortcode_custom_css_class($atts['css']).' '. $color_type. '">
      <div class="'.$fluid_container.'">';
          $even = false;
          while ( $team_query->have_posts() ) : $team_query->the_post();
            switch($atts['layout_style']){
              case 'style_v1':
                $row_class = 'row ';
                $image_html = '<div class="col-md-6 os-tm-image" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), "osetin-full-width").');"></div>';
                $desc_class = 'col-md-6';
              break;
              case 'style_v2':
                $row_class = 'row align-items-center';
                $image_html = '<div class="col-md-4 os-tm-image"><img alt="'.esc_attr(get_the_title()).'" src="'.get_the_post_thumbnail_url(get_the_ID(), "large").'"/></div>';
                $desc_class = 'col-md-8';
              break;
              default: 
                $row_class = '';
                $image_html = '<div class="os-tm-image" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(), "osetin-full-width").');"></div>';
                $desc_class = '';
              break;
            }
            if($atts['layout_style'] == 'style_v1'){
            }else{
            }
            $member_info_html = '
              <div class="'.$desc_class.' os-tm-info">
                <div class="os-tm-info-i">
                  <div class="os-tm-info-header">
                    <h5>'.osetin_get_field('sub_title').'</h5>
                    <h3>'.get_the_title().'</h3>
                  </div>
                  <div class="tm-info-content">'.get_the_excerpt().'</div>
                  <div class="tm-info-read-more">
                    <a href="'.get_the_permalink().'" class="os-btn cyan">'. __('Read More', 'psych-helper').'</a>
                    '.osetin_post_social_share_icons().'
                  </div>
                </div>
              </div>';

            $content_html = ($even) ? $member_info_html.$image_html : $image_html.$member_info_html;
            $direction = ($even) ? 'sm-reverse' : '';
            $html.= '<div class="team-member"><div class="team-member-i '.$row_class.' '.$direction.'">'.$content_html.'</div></div>';

            if($atts['layout_style'] == 'style_v1') $even = $even ? false : true;

          endwhile;
          wp_reset_postdata();
  $html.='
      </div>
    </div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_team_members' );
function vs_elem_team_members() {
   vc_map( array(
      "name" => __( "Team Members", "psych-helper" ),
      "base" => "os_team_members",
      "icon" => "os-admin-icon-rolodex-2",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
        array(
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Style", "psych-helper" ),
          "param_name" => "layout_style", 
          "value" => array(  __('Version 1', 'psych-helper') => 'style_v1',   __('Version 2', 'psych-helper') => 'style_v2',   __('Version 3', 'psych-helper') => 'style_v3'),
          "description" => __( "Select Style for the layout", "psych-helper" )
        ),
        array(
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => __( "Team Member ID(s) to show (optional)", "psych-helper" ),
          "param_name" => "team_member_ids",
          "value" => "",
          "description" => __( "Enter comma separated list of post ID(s) of team members you want to show (e.g. 3,5,7). Leave blank to show all team members", "psych-helper" )
        ),
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
          "type" => "css_editor",
          "heading" => __( "Css", "psych-helper" ),
          "param_name" => "css",
          "group" => __( "Design options", "psych-helper" ),
        ),)
      )
   );
}