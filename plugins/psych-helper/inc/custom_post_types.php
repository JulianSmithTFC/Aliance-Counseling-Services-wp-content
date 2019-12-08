<?php

// Register Custom Post Types:

// osetin_pricing_plan
// osetin_slide
// osetin_team_member
// osetin_service
// osetin_testimonial


// Pricing Plan post type
add_action( 'init', 'osetin_create_pricing_plan_post_type' );
function osetin_create_pricing_plan_post_type() {
  $pricing_plan_slug = __('pricing_plan', 'psych-helper');
  register_post_type( 'osetin_pricing_plan',
    array(
      'labels' => array(
        'name' => __( 'Pricing Plans', 'psych-helper' ),
        'singular_name' => __( 'Pricing Plan', 'psych-helper' ),
        'add_new' => __('Add Pricing Plan', 'psych-helper'),
        'add_new_item' => __('Add New Pricing Plan', 'psych-helper'),
        'edit_item' => __('Edit Pricing Plan', 'psych-helper'),
        'new_item' => __('New Pricing Plan', 'psych-helper'),
        'view_item' => __('View Pricing Plan', 'psych-helper'),
        'search_items' => __('Search Pricing Plans', 'psych-helper'),
        'not_found' => __('No Pricing Plans Found', 'psych-helper'),
      ),
      'rewrite' => array( 'slug' => $pricing_plan_slug ),
      'taxonomies' => array(),
      'supports' => array( 'title', 'editor' ),
      'menu_position' => 4,
      'public' => true,
      'has_archive' => false,
    )
  );
}


// Slides post type
add_action( 'init', 'osetin_create_slide_post_type' );
function osetin_create_slide_post_type() {
  $slide_slug = __('slide', 'psych-helper');
  register_post_type( 'osetin_slide',
    array(
      'labels' => array(
        'name' => __( 'Slides', 'psych-helper' ),
        'singular_name' => __( 'Slide', 'psych-helper' ),
        'add_new' => __('Add Slide', 'psych-helper'),
        'add_new_item' => __('Add New Slide', 'psych-helper'),
        'edit_item' => __('Edit Slide', 'psych-helper'),
        'new_item' => __('New Slide', 'psych-helper'),
        'view_item' => __('View Slide', 'psych-helper'),
        'search_items' => __('Search Slides', 'psych-helper'),
        'not_found' => __('No Slides Found', 'psych-helper'),
      ),
      'rewrite' => array( 'slug' => $slide_slug ),
      'taxonomies' => array(),
      'supports' => array( 'title', 'editor', 'thumbnail' ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => false,
    )
  );
}

// Team Member post type
add_action( 'init', 'osetin_create_team_member_post_type' );
function osetin_create_team_member_post_type() {
  $team_member_slug = __('team_member', 'psych-helper');
  register_post_type( 'osetin_team_member',
    array(
      'labels' => array(
        'name' => __( 'Team Members', 'psych-helper' ),
        'singular_name' => __( 'Team Member', 'psych-helper' ),
        'add_new' => __('Add Team Member', 'psych-helper'),
        'add_new_item' => __('Add New Team Member', 'psych-helper'),
        'edit_item' => __('Edit Team Member', 'psych-helper'),
        'new_item' => __('New Team Member', 'psych-helper'),
        'view_item' => __('View Team Member', 'psych-helper'),
        'search_items' => __('Search Team Members', 'psych-helper'),
        'not_found' => __('No Team Members Found', 'psych-helper'),
      ),
      'rewrite' => array( 'slug' => $team_member_slug ),
      'taxonomies' => array(),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
    )
  );

}

// service post type
add_action( 'init', 'osetin_create_service_post_type' );
function osetin_create_service_post_type() {
  $service_slug = __('service', 'psych-helper');
  register_post_type( 'osetin_service',
    array(
      'labels' => array(
        'name' => __( 'Services', 'psych-helper' ),
        'singular_name' => __( 'Service', 'psych-helper' ),
        'add_new' => __('Add Service', 'psych-helper'),
        'add_new_item' => __('Add New Service', 'psych-helper'),
        'edit_item' => __('Edit Service', 'psych-helper'),
        'new_item' => __('New Service', 'psych-helper'),
        'view_item' => __('View Service', 'psych-helper'),
        'search_items' => __('Search Services', 'psych-helper'),
        'not_found' => __('No Services Found', 'psych-helper'),
      ),
      'rewrite' => array( 'slug' => $service_slug ),
      'taxonomies' => array(),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes' ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
    )
  );

}



// Testimonial post type
add_action( 'init', 'osetin_create_testimonial_post_type' );
function osetin_create_testimonial_post_type() {
  $testimonial_slug = __('testimonial', 'psych-helper');
  register_post_type( 'osetin_testimonial',
    array(
      'labels' => array(
        'name' => __( 'Testimonials', 'psych-helper' ),
        'singular_name' => __( 'Testimonial', 'psych-helper' ),
        'add_new' => __('Add Testimonial', 'psych-helper'),
        'add_new_item' => __('Add New Testimonial', 'psych-helper'),
        'edit_item' => __('Edit Testimonial', 'psych-helper'),
        'new_item' => __('New Testimonial', 'psych-helper'),
        'view_item' => __('View Testimonial', 'psych-helper'),
        'search_items' => __('Search Testimonials', 'psych-helper'),
        'not_found' => __('No Testimonials Found', 'psych-helper'),
      ),
      'rewrite' => array( 'slug' => $testimonial_slug ),
      'taxonomies' => array(),
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'author' ),
      'menu_position' => 8,
      'public' => true,
      'has_archive' => true,
    )
  );

}