<?php

get_header(); 

$header_bg_image_url = false;
if(is_category()){
  $cat_id =  get_query_var('cat');
  $page_bg_image_url = osetin_get_field('category_header_bg', "category_{$cat_id}");
  $css_extra_class = ($page_bg_image_url) ? 'with-background' : 'without-background smaller';
}else{
  $css_extra_class = 'smaller';
  $page_bg_image_url = '';
}
?>
<div class="os-container">
  <div class="page-intro-header with-curve with-background <?php echo esc_attr($css_extra_class); ?>" style="<?php echo osetin_get_css_prop('background-image', $page_bg_image_url, false, 'background-repeat: repeat;'); ?>">
    <?php 
    the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' );
    osetin_output_breadcrumbs(false);
    the_archive_description( '<div class="taxonomy-description">', '</div>' );
    if(true) echo '<img src="'.get_template_directory_uri().'/assets/img/page-top-curve.png" class="curve"/>';
    ?>
  </div>
</div>
<div class="os-container always-show">
  <div class="blog-content-w">
    <div class="blog-content">
      <div class="blog-index" data-columns="">
        <?php
        if ( have_posts() ) {
          while ( have_posts() ) : the_post();
            get_template_part('content');
          endwhile;
        }else{ ?>
          <div class="not-found-page-w search-results">
            <h1 class="page-title"><?php _e('No results for your search', 'zelus-by-osetin') ?></h1>
            <h5 class="page-content-sub-title"><?php _e('Try searching for a different keyword...', 'zelus-by-osetin'); ?></h5>
            <div class="post-content">
              <?php echo '<div class="page-intro-text">'.__('If you\'re not happy with the results, please do another search', 'zelus-by-osetin').'</div>'; ?>
              <div class="search-404">
                <?php get_search_form(); ?>
              </div>
            </div>
          </div> <?php
        } ?>
      </div>
      <div class="index-navigation">
        <?php 
        the_posts_pagination( array(
          'prev_text'          => __( 'Previous page', 'zelus-by-osetin' ),
          'next_text'          => __( 'Next page', 'zelus-by-osetin' )
        ) ); 
        ?>
      </div>
    </div>
    <?php if ( is_active_sidebar( 'sidebar-index' ) ){ ?>
	    <div class="blog-sidebar with-curve">
	    	<div class="curve"></div>
	      <?php
	        dynamic_sidebar( 'sidebar-index' );
	      ?>
	    </div>
    <?php } ?>
  </div>
</div>
<?php get_footer(); ?>
