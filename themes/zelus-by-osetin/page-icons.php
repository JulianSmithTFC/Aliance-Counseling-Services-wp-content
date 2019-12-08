<?php
/**
 * Template Name: Icons Shortcodes
 *
 */

get_header(); ?>

  <?php while ( have_posts() ) : the_post(); ?>



  <?php  
  if(osetin_is_imaged_header(get_the_ID(), 'background') || osetin_is_imaged_header(get_the_ID(), 'background_no_text')){
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
    <div class="page-w <?php if ( osetin_is_active_sidebar( 'sidebar-single-page', false, $sub_pages_navigation_html ) ) echo 'with-sidebar sidebar-location-right'; ?>">
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
	          <?php
	          $icons = array(
							'os-icon-appreciations',
							'os-icon-company_meeting',
							'os-icon-legal_documents',
							'os-icon-timing',
							'os-icon-focus_group',
							'os-icon-innovation_research',
							'os-icon-startup_launch',
							'os-icon-top_class_award',
							'os-icon-chess_strategy',
							'os-icon-office_clock',
							'os-icon-thumbs_up',
							'os-icon-archive_files',
							'os-icon-business_portfolio',
							'os-icon-global_business',
							'os-icon-speech_bubble',
							'os-icon-timetable_events',
							'os-icon-business_opportunity',
							'os-icon-career_advancement',
							'os-icon-head_hunting',
							'os-icon-leadership_growth',
							'os-icon-partnership_cooperation',
							'os-icon-personal_development',
							'os-icon-personal_features',
							'os-icon-race_winner',
							'os-icon-workgroup_people',
							'os-icon-company_structure',
							'os-icon-human_resource',
							'os-icon-personal_connection',
							'os-icon-personal_idea',
							'os-icon-success_mission',
							'os-icon-user_profile',
							'os-icon-working_hours',
							'os-icon-money_savings',
							'os-icon-market_vision',
							'os-icon-marketing_idea',
							'os-icon-schedule_planning',
							'os-icon-career_raise',
							'os-icon-consulting_manager',
							'os-icon-handshake_agreement',
							'os-icon-solution_puzzle',
							'os-icon-success_mark',
							'os-icon-team_leader',
							'os-icon-teamwork_collaboration',
							'os-icon-balance_scales',
							'os-icon-crossroad_arrows',
							'os-icon-key_to_success',
							'os-icon-navigation_compass',
							'os-icon-social_engagement',
							'os-icon-target_audience',
							'os-icon-life_heart_level',
							'os-icon-puzzle_quest',
							'os-icon-scenario_scroll',
							'os-icon-content_sharing',
							'os-icon-global_connection',
							'os-icon-client_service',
							'os-icon-solution_tricks',
							'os-icon-user_interaction',
							'os-icon-accessibility_for_disabled',
							'os-icon-restroom_sign',
							'os-icon-science_of_innovation',
							'os-icon-imagination_form',
							'os-icon-relationship_harmony',
							'os-icon-green_energy_source',
							'os-icon-green_innovation',
							'os-icon-plant_conservation',
							'os-icon-power_of_nature',
							'os-icon-computer_security',
							'os-icon-virtruvian_man',
							'os-icon-caduceus_medicine',
							'os-icon-hiv_ribbon',
							'os-icon-medical_board',
							'os-icon-sexology',
							'os-icon-long_range_planning',
							'os-icon-returning_visitor',
							'os-icon-care_about_peoples',
							'os-icon-compassion_feelings',
							'os-icon-grows_of_gratitude',
							'os-icon-helping_hands',
							'os-icon-power_of_forgiveness',
							'os-icon-emotional_intelligence',
							'os-icon-daily_tasks_and_routine',
							'os-icon-focusing_on_solution',
							'os-icon-partners_collaboration',
							'os-icon-opening_ceremony',
							'os-icon-risk_management',
							'os-icon-launch_optimization',
							'os-icon-measure_body_form',
							'os-icon-muscle_growth_training',
							'os-icon-google',
							'os-icon-wechat',
							'os-icon-pinterest',
							'os-icon-whatsapp',
							'os-icon-behance',
							'os-icon-reddit',
							'os-icon-google2',
							'os-icon-skype',
							'os-icon-instagram',
							'os-icon-slack',
							'os-icon-yelp',
							'os-icon-snapchat',
							'os-icon-youtube',
							'os-icon-soundcloud',
							'os-icon-linkedin',
							'os-icon-yelp.1',
							'os-icon-ebay',
							'os-icon-facebook',
							'os-icon-twitter',
							'os-icon-facebook-messenger',
							'os-icon-flickr',
							'os-icon-viber',
							'os-icon-vimeo',
							'os-icon-clock',
							'os-icon-envelope',
							'os-icon-map-marker',
							'os-icon-location2',
							'os-icon-plus2',
	          	'os-icon-arrow-left',
							'os-icon-arrow-right',
							'os-icon-check',
							'os-icon-check-circle',
							'os-icon-chevron-left',
							'os-icon-chevron-right',
							'os-icon-corner-up-left',
							'os-icon-eye',
							'os-icon-eye-off',
							'os-icon-grid',
							'os-icon-layers',
							'os-icon-mail',
							'os-icon-map',
							'os-icon-map-pin',
							'os-icon-menu',
							'os-icon-minus-circle',
							'os-icon-minus-square',
							'os-icon-paperclip',
							'os-icon-plus-circle',
							'os-icon-plus-square',
							'os-icon-search',
							'os-icon-x',
							'os-icon-x-circle',
							'os-icon-x-square',
							'os-icon-zoom-in',
							'os-icon-zoom-out',
							'os-icon-right-quote-alt',
							'os-icon-left-quote-alt',
							'os-icon-right-quote',
							'os-icon-left-quote',
							'os-icon-phone',
							'os-icon-phone2',
							'os-icon-phone-wave',
							'os-icon-phone-hang-up',
							'os-icon-location',
							'os-icon-location4',
							'os-icon-plus',
							'os-icon-plus22',
							'os-icon-arrow-up',
							'os-icon-arrow-up2',
							'os-icon-arrow-right2',
							'os-icon-arrow-right22',
							'os-icon-arrow-down',
							'os-icon-arrow-down2'
	        );

	          $counter = 0;
	          echo '<div class="row icon-info-bordered-row">';
	          foreach($icons as $icon){ ?>
	            <div class="col-lg-4">
	              <div class="icon-info-w">
	                <div class="icon-info-icon-w"><i class="<?php echo $icon; ?> os-icon"></i></div>
	                <label for="">CSS Class</label><input type="text" value="os-icon <?php echo $icon; ?>"><label for="">Shortcode</label><textarea rows="4">[os_icon icon_class="<?php echo $icon; ?>" icon_color="#165cda" icon_font_size="60px"]</textarea>
	              </div>
	            </div>
	            <?php
	            $counter++;
	            if($counter == 3){
	              $counter = 0;
	              echo '</div><div class="row icon-info-bordered-row">';
	            }
	          }
	          echo '</div>';
	          ?>
          </div>
        </article>
      </div>


    </div>
  </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>