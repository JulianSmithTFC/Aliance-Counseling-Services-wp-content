<?php
function osetin_shortcode_categories_icons_func( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
      'limit' => false,
      'include_child_categories' => false,
      'specific_ids' => false
    ), $atts );

    $args = array( 'orderby' => 'name', 'order' => 'ASC' );
    if(($atts['include_child_categories'] == false) && ($atts['specific_ids'] == false)) $args['parent'] = 0;
    if($atts['limit']) $args['number'] = $atts['limit'];
    if($atts['specific_ids']) $args['include'] = $atts['specific_ids'];

    $categories = get_categories($args);

    $output = '';
    $output.= '<div class="shortcode-categories-icons">';
    $output.= '<table>';
    $output.= '<tr>';
    $counter = 0;
    foreach($categories as $category) {
      $category_icon_url = osetin_get_field('category_icon', "category_{$category->cat_ID}");
      if(empty($category_icon_url)) $category_icon_url = plugin_dir_url( __FILE__ ) . 'assets/img/placeholder-category.png';
      if((($counter % 2) == 0) && ($counter > 0)) $output.= '</tr><tr>';
      $output.= '<td>';
      $output.= '<div class="sci-media"><a href="'.get_category_link($category->cat_ID).'"><img src="'.$category_icon_url.'" alt="'.esc_attr($category->name).'"/></a></div>';
      $output.= '<div class="sci-title"><h3><a href="'.get_category_link($category->cat_ID).'">'.$category->name.'</a></h3></div>';
      $output.= '</td>';
      $counter++;
    }
    if(($counter % 2) != 0) $output .= '<td></td>';
    $output.= '</tr>';

    $output.= '</table>';
    $output.= '</div>';
    return $output;
}
add_shortcode( 'osetin_categories_icons', 'osetin_shortcode_categories_icons_func' );