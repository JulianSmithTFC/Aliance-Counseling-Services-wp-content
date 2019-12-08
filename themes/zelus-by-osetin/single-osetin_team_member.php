<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="os-container">
  <div class="team-member-single">
    <div class="tms-main-info">
      <div class="tms-image" style="background-image: url('<?php the_post_thumbnail_url("osetin-full-width"); ?>');"></div>
      <div class="tms-info">
        <h4><?php echo osetin_get_field('sub_title'); ?></h4>
        <h1><?php the_title(); ?></h1>
        <div class="tms-quote"><?php echo osetin_get_field('quote'); ?></div>
      </div>
      <img class="curve-top-img" src="<?php echo get_template_directory_uri(); ?>/assets/img/curve-top-white.png" alt="<?php echo esc_attr(get_the_title()); ?>">
    </div>
    <div class="tms-content-w">
      <div class="tms-content-i">
        <div class="tms-content">
          <?php the_content(); ?>
        </div>
        <div class="tms-side">
          <?php 
          osetin_cta_box(); ?>
          <div class="tms-social-w">
            <h4><?php _e('Connect on Social', 'zelus-by-osetin'); ?></h4>
            <?php echo osetin_post_social_share_icons(); ?>
          </div>
        </div>
      </div>
      <h3><?php _e('Other Team Members', 'zelus-by-osetin'); ?></h3>
      <div class="tms-other-members">
        <?php echo do_shortcode( '[os_team_members layout_style="style_v2"]' ); ?>
      </div>
    </div>
  </div>
</div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>