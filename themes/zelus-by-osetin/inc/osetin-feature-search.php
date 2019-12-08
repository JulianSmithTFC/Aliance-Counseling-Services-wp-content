<?php

if (!defined('OSETIN_FEATURE_SEARCH_VERSION')) define('OSETIN_FEATURE_SEARCH_VERSION', '1.0');

// --------------------------
// VOTING FUNCTIONS BY OSETIN
// --------------------------


function osetin_search_init(){
  add_action( 'wp_ajax_osetin_search_process_request', 'osetin_search_process_request' );
  add_action( 'wp_ajax_nopriv_osetin_search_process_request', 'osetin_search_process_request' );
}


function osetin_search_process_request(){
  if(isset($_POST['search_ingredient_ids'])){

    $args = array(  
    'post_status' => 'publish',
    'post_type' => 'osetin_recipe',
    'tax_query' => array(
        array(
           'taxonomy' => 'recipe_ingredient',
           'field' => 'term_id',
           'terms' => $_POST['search_ingredient_ids'],
           'operator' => 'IN'
        )
     ));
    $osetin_recipes_query = new WP_Query( $args );

    $response_html = '';
    
    $layout_type = 'masonry_4';
    $response_html = build_index_posts($layout_type, false, $osetin_recipes_query);
    echo wp_send_json(array('status' => 200, 'message' => $response_html));

  }else{
    echo wp_send_json(array('status' => 422, 'message' => esc_html__('Invalid data supplied', 'zelus-by-osetin')));
  }
  exit();  
}
