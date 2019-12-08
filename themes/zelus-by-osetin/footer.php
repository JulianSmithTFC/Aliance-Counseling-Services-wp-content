<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 */
?>

    <?php if ( osetin_get_field( 'add_instagram_feed_above_footer', 'option' ) || osetin_get_field( 'add_cta_form_above_footer', 'option' ) ) { ?>
      <div class="os-container">
        <div class="above-footer">
          <?php if ( osetin_get_field( 'add_instagram_feed_above_footer', 'option' )){ ?>
          
          
          
          
          
          
            <aside class="widget"><?php echo do_shortcode('[instagram-feed]'); ?></aside>
          <?php } ?>
          <?php if ( osetin_get_field( 'add_cta_form_above_footer', 'option' )){ ?>
            <aside class="widget widget_osetin_newsletter_widget"><div class="os-container">
              <div class="os-cta-small-newsletter" style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('cta_form_background_color', 'option', false)) . osetin_get_css_prop('background-image', osetin_get_field('cta_form_background_image', 'option')); ?>">
                <div class="cta-content">
                  <div class="cta-text">
                    <h4><?php echo osetin_get_field('cta_form_header_text', 'option'); ?></h4>
                    <div class="sub-header-text"><?php echo osetin_get_field('cta_form_sub_header_text', 'option'); ?></div>
                  </div>
                  <div class="cta-form"><i class="os-icon os-icon-envelope"></i><?php echo do_shortcode(osetin_get_field('cta_form_shortcode', 'option', '')); ?></div>
                </div>
              </div>
            </div></aside>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
    <?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
      <div class="os-container">
        <div class="pre-footer widgets-count-<?php echo osetin_count_sidebar_widgets('sidebar-footer'); ?> color-scheme-<?php echo osetin_get_field('pre_footer_section_background_color_type', 'option', 'light'); ?>" style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('pre_footer_section_background_color', 'option'), false, 'background-image: none;') . osetin_get_css_prop('background-image', osetin_get_field('pre_footer_section_background_image', 'option'), false, 'background-repeat: repeat; background-position: top left;'); ?>">
            <?php dynamic_sidebar( 'sidebar-footer' ); ?>
        </div>
      </div>
    <?php } ?>
    <?php if(osetin_get_field('do_not_show_deep_footer', 'option') != true){ ?>
      <div class="os-container">
        <div class="main-footer with-social color-scheme-<?php echo osetin_get_field('footer_section_background_color_type', 'option'); ?>" style="<?php echo osetin_get_css_prop('background-color', osetin_get_field('footer_section_background_color', 'option')) . osetin_get_css_prop('background-image', osetin_get_field('footer_section_background_image', 'option'), false, 'background-repeat: repeat; background-position: top left;'); ?>">
          <div class="footer-copy-and-menu-w">
            <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'container_class' => 'footer-menu', 'fallback_cb' => false ) ); ?>
            <div class="footer-copyright"><?php echo wp_kses_post(osetin_get_field('extra_footer_html', 'option', '<a href="https://themeforest.net/item/therapist-medical-wordpress-theme-for-psychology-therapist-counseling/21659755?ref=Osetin">'.esc_attr__('WordPress theme for psychology therapy professionals.', 'zelus-by-osetin').'</a>')); ?></div>
          </div>
          <?php if(osetin_get_field('show_social_icons_in_footer', 'option')){ ?>
            <div class="footer-social-w">
              <?php osetin_social_share_icons('footer'); ?>
            </div>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
    <div class="main-search-form-overlay">
    </div>
    <div class="main-search-form">
      <?php get_search_form(true); ?>
      <div class="autosuggest-results"></div>
    </div>
    
    <?php if(osetin_get_field('show_peeking_form', 'option')){ ?>
  
      <div class="peeking-form-w position-<?php echo osetin_get_field('peeking_form_position', 'option'); ?>">
        <div class="pf-trigger"><?php echo osetin_get_field('peeking_form_trigger_label', 'option'); ?></div>
        <div class="pf-form">
          <div class="pf-close-trigger">
            <i class="os-icon os-icon-circle-cross"></i>
          </div>
          <?php echo do_shortcode(osetin_get_field('peeking_form_shortcode', 'option')); ?>
        </div>
      </div>

    <?php } ?>
    <div class="display-type"></div>
  </div>
  </div>
  <?php wp_footer(); ?>
</body>
</html>
