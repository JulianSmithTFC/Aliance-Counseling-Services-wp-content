<?php get_header('post'); ?>
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

            <div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper"><div class="os-container">
                                <div class="os-cta-small-newsletter" style="background-color: #e7f4fd;background-image: url();">
                                    <div class="cta-content">
                                        <div class="cta-text">
                                            <h4>Get News Directly to Your Email</h4>
                                            <div class="sub-header-text">We will only send you important updates and notices</div>
                                        </div>
                                        <div class="cta-form"><i class="os-icon os-icon-envelope"></i><script>(function() {
                                                    if (!window.mc4wp) {
                                                        window.mc4wp = {
                                                            listeners: [],
                                                            forms    : {
                                                                on: function (event, callback) {
                                                                    window.mc4wp.listeners.push({
                                                                        event   : event,
                                                                        callback: callback
                                                                    });
                                                                }
                                                            }
                                                        }
                                                    }
                                                })();
                                            </script><!-- Mailchimp for WordPress v4.5.0 - https://wordpress.org/plugins/mailchimp-for-wp/ --><form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-517" method="post" data-id="517" data-name=""><div class="mc4wp-form-fields"><input type="email" name="EMAIL" placeholder="Your email address" required=""><input type="submit" value="Sign up"></div><label style="display: none !important;">Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off"></label><input type="hidden" name="_mc4wp_timestamp" value="1555471116"><input type="hidden" name="_mc4wp_form_id" value="517"><input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1"><div class="mc4wp-response"></div></form><!-- / Mailchimp for WordPress Plugin -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>
<?php get_footer(); ?>