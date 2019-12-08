<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

get_header(); ?>

  <div class="os-container always-show">
    
    <div class="page-w not-found-page-w">

      <div class="page-content">
        <div class="content-style-box"></div>
        <article>
          <h1 class="page-title"><?php _e('Page not Found', 'zelus-by-osetin') ?></h1>
          <h5 class="page-content-sub-title"><?php _e('Try searching for a different keyword...', 'zelus-by-osetin'); ?></h5>
          <div class="page-content-i">
            <div class="post-content">
              <?php echo '<div class="page-intro-text">'.__('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'zelus-by-osetin').'</div>'; ?>
              <div class="search-404">
                <?php get_search_form(); ?>
              </div>
            </div>
          </div>
        </article>
      </div>


    </div>
  </div>
<?php get_footer(); ?>