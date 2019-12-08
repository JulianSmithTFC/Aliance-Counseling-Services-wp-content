<?php
/**
 * The template for displaying all pages.
 *
 */

get_header(); ?>

  <?php while ( have_posts() ) : the_post(); ?>



  <?php  
  if(osetin_is_imaged_header(get_the_ID(), 'background') || osetin_is_imaged_header(get_the_ID(), 'background_no_text')){
    $header_with_image = true;
  }else{
    $header_with_image = false;
  }
  if($header_with_image){
    if(osetin_is_bbpress()){
      $page_bg_image_url = get_template_directory_uri().'/assets/img/patterns/flowers_light.jpg';
    }else{
      $page_bg_image_url_arr = wp_get_attachment_image_src( get_post_thumbnail_id(), 'osetin-full-width' );
      $page_bg_image_url = isset($page_bg_image_url_arr[0]) ? $page_bg_image_url_arr[0] : '';
    } ?>
    <div class="os-container">
      <div class="page-intro-header with-curve with-background" style="<?php echo osetin_get_css_prop('background-image', $page_bg_image_url, false, 'background-repeat: repeat;'); ?>">
        <?php 
        if(osetin_is_imaged_header(get_the_ID(), 'background')) echo '<h1><span>'.osetin_get_the_title(get_the_ID()).'</span></h1>';
        osetin_output_breadcrumbs(false);
        if(true) echo '<img src="'.get_template_directory_uri().'/assets/img/page-top-curve.png" class="curve"/>';
        ?>
      </div>
    </div>
    <?php
  }else{
    osetin_output_breadcrumbs();
  }
  ?>

  <div class="os-container always-show">
    
    <?php 
    $sub_pages_navigation_html = osetin_sub_pages_navigation(); ?>
    <div class="page-w <?php echo ($header_with_image) ? 'with-header-image' : 'without-header-image'; ?> <?php if ( osetin_is_active_sidebar( 'sidebar-single-page', false, $sub_pages_navigation_html ) ) echo 'with-sidebar sidebar-location-right'; ?>">
      <?php 
        if ( osetin_is_active_sidebar( 'sidebar-single-page', false, $sub_pages_navigation_html )) { ?>
          <div class="page-sidebar">
            <?php echo osetin_output($sub_pages_navigation_html); ?>
            <?php dynamic_sidebar( 'sidebar-single-page' ); ?>
          </div><?php 
        } 
      ?>
      <div class="page-content <?php echo (osetin_get_field('separate_content_from_intro')) ? 'separate-intro' : ''; ?>">
        <div class="content-style-box"></div>
        <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php 
          if(osetin_is_imaged_header(get_the_ID(), 'above')){
            echo '<div class="page-intro-image">'.get_the_post_thumbnail(get_the_ID(), 'full').'</div>';
          }

          osetin_cta_box();

          // PAGE SUB TITLE
          $sub_title = osetin_get_field('sub_title');
          if ( ! empty( $sub_title ) ) { ?>
            <h5 class="page-content-sub-title"><?php echo esc_html($sub_title); ?></h5>
          <?php }

          // PAGE TITLE
          if(osetin_get_field('hide_title', get_the_ID()) != true){
            echo '<h2 class="page-title">'.get_the_title(get_the_ID()).'</h2>';
          }
          ?>
          <?php 
          if(osetin_get_field('intro_text_block')){
            echo '<div class="page-intro-text">'.osetin_get_field('intro_text_block').'</div>';
          }
          ?>

          <div class="page-content-i">
            <?php the_content(); ?>
          </div>
          <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
              comments_template();
            endif;
          ?>
        </article>
      </div>


    </div>
  </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>