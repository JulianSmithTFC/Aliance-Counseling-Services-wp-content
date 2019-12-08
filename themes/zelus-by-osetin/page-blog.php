<?php
/**
 * Template Name: Blog Index
 *
 */

get_header(); 

if ( have_posts() ) : while ( have_posts() ) : the_post();
$layout_type_for_index = osetin_get_settings_field('layout_type_for_index', 'masonry');
if(get_query_var('page')){
  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
}else{
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
}
if($paged == 1){
  $sticky_posts = osetin_get_field('sticky_posts', false, false, true);
}else{
  $sticky_posts = false;
}
$content_location = osetin_get_field('content_location');
$content_field_value = get_the_content();
$os_posts_per_page = osetin_get_number_of_posts_per_page();
$args = array(
  'orderby' => 'date',
  'order' => 'DESC',
  'posts_per_page' => $os_posts_per_page,
  'paged' => $paged,
  'tax_query' => array()
);

  // ---------------
  // FILTERS
  // ---------------
  // FILTER SELECTED CATEGORIES
  if( osetin_get_field('show_posts_from_selected_categories', false, false, true) ) $args['category__in'] = osetin_get_field('show_posts_from_selected_categories', false, false, true);
  // FILTER SELECTED TAGS
  if( osetin_get_field('show_posts_from_selected_tags', false, false, true) ) $args['tag__in'] = osetin_get_field('show_posts_from_selected_tags', false, false, true);
  // FILTER SELECTED POSTS
  if( osetin_get_field('show_only_specific_posts', false, false, true) ) $args['post__in'] = osetin_get_field('show_only_specific_posts', false, false, true);

  if(osetin_is_imaged_header(get_the_ID(), 'background') || osetin_is_imaged_header(get_the_ID(), 'background_no_text')){
    if(osetin_is_bbpress()){
      $page_bg_image_url = get_template_directory_uri().'/assets/img/patterns/flowers_light.jpg';
    }else{
      $page_bg_image_url = wp_get_attachment_url( get_post_thumbnail_id() );
    } ?>
    <div class="os-container">
      <div class="page-intro-header with-background" style="<?php echo osetin_get_css_prop('background-image', $page_bg_image_url, false, 'background-repeat: repeat;'); ?>">
        <?php if(osetin_is_imaged_header(get_the_ID(), 'background')) echo '<h1>'.osetin_get_the_title(get_the_ID()).'</h1>'; ?>
      </div>
    </div>
    <?php
  }
  ?>

<div class="os-container">
  <?php
  $osetin_query = new WP_Query( $args ); 

  $sidebar_name = (osetin_get_field('hide_sidebar') == true) ? false : 'sidebar-index';
  ?>

  <div class="os-container">
    <?php echo build_index_posts($layout_type_for_index, $sidebar_name, $osetin_query, $sticky_posts, false, $content_field_value, $content_location); ?>
  </div>
</div>
  <?php endwhile; endif; ?>
<?php get_footer(); ?>
