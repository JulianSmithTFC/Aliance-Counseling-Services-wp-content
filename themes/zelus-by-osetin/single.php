<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="blog-content-w <?php if(!has_post_thumbnail()){ echo 'without-thumbnail'; } ?> <?php if ( !is_active_sidebar( 'sidebar-single-post' ) ){ echo ' without-sidebar'; } ?>">
    <div class="blog-content">
      <?php
        if(has_post_thumbnail()){
          $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "osetin-full-width" );
          $proportion = 100;
          if($image_data && isset($image_data[1]) && isset($image_data[2]) && $image_data[1] > 0 && $image_data[2] > 0){
            $width = $image_data[1];
            $height = $image_data[2];
            $proportion = round($height / $width * 100);
          }
          ?>
          <div class="post-header-image" style="background-image: url('<?php the_post_thumbnail_url("osetin-full-width"); ?>'); padding-bottom: <?php echo esc_attr($proportion).'%'; ?>">
            <div class="post-header-image-contents">
              <h1><?php the_title(); ?></h1>
              <div class="post-header-meta">
              <?php if(osetin_get_field('show_author_on_featured_image', 'option', false)){ ?>
                <div class="author-details">
                  <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                  <span>By: </span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                  <span class="post-header-date-posted"><?php echo get_the_date(); ?></span>
                  <span class="post-header-comments"><?php comments_number( 'no comments', 'one comment', '% responses' ); ?></span>
                  <span class="post-header-categories"><?php echo get_the_category_list(); ?></span>
                </div>
              <?php } ?>
              </div>
              <?php if(true) echo '<img src="'.get_template_directory_uri().'/assets/img/page-top-curve.png" class="curve"/>'; ?>
            </div>
          </div>
          <?php
        }
      ?>  
      <div class="blog-content-text-and-meta">
        <div class="blog-content-meta">
          <div class="meta-author meta-block">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>

            <div class="author-details">
              <h6 class="author-name"><span>By: </span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta( 'display_name' ); ?></a></h6>
              <div class="single-post-date-posted"><?php echo get_the_date(); ?></div>
            </div>
          </div>
          <?php 
          if(get_comments_number()){ ?>
            <div class="meta-comments meta-block">
              <?php comments_number( __('no comments', 'zelus-by-osetin'), __('one comment', 'zelus-by-osetin'), __('% responses', 'zelus-by-osetin') ); ?>
            </div>
          <?php } ?>
          <?php if(osetin_get_field('share_post_code', 'option')){ ?>
            <div class="meta-share meta-block">
              <h6><?php _e('Share This Post', 'zelus-by-osetin'); ?></h6>
              <div class="meta-share-box">
                <div class="addthis_inline_share_toolbox"></div>
                <script type="text/javascript" src="<?php echo esc_attr(osetin_get_field('share_post_code', 'option')); ?>"></script>
              </div>
            </div>
          <?php } ?>
          <div class="meta-categories-w meta-block">
            <h6 class="post-categories-label"><?php esc_html_e('Categories:', 'zelus-by-osetin'); ?></h6>
            <div class="meta-categories-list">
              <?php echo get_the_category_list(); ?>
            </div>
          </div>
          <?php if(has_tag()){ ?>
            <div class="meta-tags-w meta-block">
              <h6 class="post-categories-label"><?php esc_html_e('Tags:', 'zelus-by-osetin'); ?></h6>
              <div class="meta-tag-list">
                <?php echo get_the_tag_list('', ', '); ?>
              </div>
            </div>
          <?php } ?>

        </div>
        <div class="blog-content-text">
          <?php 
          if(has_post_thumbnail()){ 
            echo '<h4 class="styled-header">'.get_the_title().'</h4>';
          }else{
            echo '<h1 class="post-title styled-header">'.get_the_title().'</h1>';
          }


          ?>
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<div class="content-link-pages">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>


        <div class="sidebar-under-post">
          <?php 
          $args = array(
            'post__not_in'        => array(get_the_ID()),
            'posts_per_page'      => 4,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'orderby'             => 'post_date',
            'order'               => 'DESC',
          );
          $recent_posts_query = new WP_Query( $args );
          if ($recent_posts_query->have_posts()){ ?>
            <div class="latest-posts-w">
              <h3><?php _e('Latest Posts', 'zelus-by-osetin') ?></h3>
              <div class="latest-posts-i">
                <?php
                while ($recent_posts_query->have_posts()){
                  $recent_posts_query->the_post(); ?>
                  <div class="lp-post">
                    <a href="<?php the_permalink(); ?>" class="lp-media" style="background-image:url('<?php the_post_thumbnail_url("large"); ?>');"></a>
                    <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
                    <div class="lp-meta">
                      <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                      <span>By: </span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                      <span class="lp-header-date-posted"><?php echo get_the_date(); ?></span>
                    </div>
                  </div>
                  <?php
                } ?>
              </div>
            </div><?php
          }
          wp_reset_postdata(); ?>
        </div>
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
          comments_template();
        } ?>
        </div>
      </div>
    </div>
    <?php 
      if ( is_active_sidebar( 'sidebar-single-post' ) ){ ?>
        <div class="blog-sidebar">
          <?php
            dynamic_sidebar( 'sidebar-single-post' );
          ?>
        </div>
        <?php
      } ?>
  </div>

      
  <?php get_template_part('cta-2'); ?>
<?php endwhile; endif; ?>
<?php get_footer(); ?>