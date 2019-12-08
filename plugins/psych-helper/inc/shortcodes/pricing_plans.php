<?php

add_shortcode( 'os_pricing_plans', 'os_pricing_plans_func' );
function os_pricing_plans_func( $atts, $content = null ) { // New function parameter $content is added!
  $atts = shortcode_atts( array(
    'price_value_color' => false,
    'plan_bg_color' => '',
    'color_type' => 'light',
    'css' => ''), $atts );



  $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

  $form_header_html = '';

  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
  $args = array(
  'orderby' => 'date',
  'order'   => 'ASC',
  'post_type' => 'osetin_pricing_plan',
  'posts_per_page' => -1
  );
  $pricing_plans_query = new WP_Query( $args );
  $price_value_css = '';
  if($atts['price_value_color']){
    $price_value_css = 'color: '.$atts['price_value_color'];
  }
  $html = '
  <div class="os-container">
    <div class="os-pricing_plans">';
          while ( $pricing_plans_query->have_posts() ) : $pricing_plans_query->the_post();

          $plan_features = '';
          if( have_rows('plan_features') ){
            $plan_features.= '<ul>';
            while( have_rows('plan_features') ): the_row();
              $plan_features.= '<li class="status-'.esc_attr(get_sub_field('status')).'">'.get_sub_field('feature_name').'</li>';
            endwhile;
            $plan_features.= '</ul>';
          }

            $icon_html = '';
            if(osetin_get_field('plan_icon_class')) $icon_html = '<div class="pp-icon"><i class="'.osetin_get_field('plan_icon_class').'"></i></div>';

            $html.= '<div class="pricing_plan">';
              $html.= '
              <div class="pricing-plan-header">'.$icon_html.'
                <div class="pp-name">
                  <h3 class="pp-title">'.get_the_title().'</h3>
                  <div class="pp-subtitle">'.osetin_get_field('sub_title').'</div>
                </div>
                <div class="pp-price"><div class="pp-price-value" style="'.$price_value_css.'">'.osetin_get_field('price').'</div><div class="pp-price-period">'.osetin_get_field('price_period').'</div></div>
              </div>
              <div class="pricing-plan-features">
                <h6>'.__('Plan Features', 'psych-helper').'</h6>
                '.$plan_features.'
              </div>
              <div class="pricing-plan-description">
                <div>'.get_the_content().'</div>
              </div>
              <div class="pricing-plan-link">
                <a href="'.osetin_get_field('plan_link_url').'" class="os-btn small cyan">'.osetin_get_field('plan_link_label').'</a>
              </div>';
            $html.= '</div>';
          endwhile;
          wp_reset_postdata();
  $html.='
    </div>
  </div>';
  return $html;
}

add_action( 'vc_before_init', 'vs_elem_pricing_plans' );
function vs_elem_pricing_plans() {
   vc_map( array(
      "name" => __( "Pricing Plans", "psych-helper" ),
      "base" => "os_pricing_plans",
      "icon" => "os-admin-icon-banknote-coins",
      "class" => "",
      "category" => __( "Psychology", "psych-helper"),
      "params" => array(
         array(
            "type" => "colorpicker",
            "class" => "",
            "heading" => __( "Color of price value", "psych-helper" ),
            "param_name" => "price_value_color",
            "value" => '',
            "description" => __( "Choose color for price value", "psych-helper" )
         ))
      )
   );
}