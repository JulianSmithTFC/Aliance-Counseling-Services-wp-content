<?php

// title // excerpt // author_avatar // author_name // date // like // comments // views // cooking_time // categories // cuisines // share // read_more // rating
function osetin_get_hidden_elements_array(){
  global $osetin_current_page_id;
  if(!empty($osetin_current_page_id)){
    $elements_to_hide = osetin_get_field('elements_to_hide', $osetin_current_page_id, false, true);
  }else{
    $elements_to_hide = osetin_get_field('elements_to_hide_option', 'option', false, true);
  }
  if(is_array($elements_to_hide)){
    return $elements_to_hide;
  }else{
    return array();
  }
}

// title // excerpt // author_avatar // author_name // date // like // comments // views // cooking_time // categories // cuisines // share // read_more // rating
function osetin_is_element_visible($element_name){
  if($element_name){
    $elements_to_hide = osetin_get_hidden_elements_array();
    if(is_array($elements_to_hide)){
      return !in_array($element_name, $elements_to_hide);
    }else{
      return true;
    }
  }else{
    return true;
  }
}

function osetin_get_user_social_links($user_id, $link_class = ''){
  $html = '';

  if ( get_the_author_meta('google_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('google_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-googleplus"></i></a>';
  }
  if ( get_the_author_meta('twitter_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('twitter_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-twitter"></i></a>';
  }
  if ( get_the_author_meta('facebook_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('facebook_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-facebook"></i></a>';
  }
  if ( get_the_author_meta('linkedin_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('linkedin_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-linkedin"></i></a>';
  }
  if ( get_the_author_meta('instagram_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('instagram_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-instagram"></i></a>';
  }
  if ( get_the_author_meta('flickr_profile', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('flickr_profile', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-flickr"></i></a>';
  }
  if ( get_the_author_meta('rss_url', $user_id) ){
    $html.= '<a href="'.esc_url( get_the_author_meta('rss_url', $user_id)).'" class="'.$link_class.'"><i class="os-icon os-icon-social-rss"></i></a>';
  }

  return $html;
}

function osetin_output_post_media($post_id = false, $image_size = 'osetin-full-width'){
  $html = '';
  if(('video' == get_post_format()) && osetin_get_field('video_shortcode')){
    $html.= do_shortcode(osetin_get_field('video_shortcode'));
  }elseif(('gallery' == get_post_format()) && osetin_get_field('gallery_images', false, false, true)){
    $gallery_images = osetin_get_field('gallery_images', false, false, true);
    foreach( $gallery_images as $key => $image ){
      $active_class = ($key == 0) ? 'active' : '';
      $html.= '<div class="single-main-media-image-w has-gallery osetin-lightbox-trigger fader-activator '.$active_class.'" id="singleMainMedia'.$key.'" 
      data-lightbox-caption="'.$image['caption'].'" 
      data-lightbox-img-src="'.$image['sizes']['osetin-full-width'].'" 
      data-lightbox-thumb-src="'.$image['sizes']['osetin-medium-square-thumbnail'].'">
      <span class="image-fader lighter"><span class="hover-icon-w"><i class="os-icon os-icon-plus"></i></span></span>
      <img src="'.$image['sizes'][$image_size].'"/></div>';
    }
    $html.= '<div class="single-post-gallery-images"><div class="single-post-gallery-images-i">';
    foreach( $gallery_images as $key => $image ){
      $active_class = ($key == 0) ? 'active' : '';
      $html.= '<div class="gallery-image-source '.$active_class.' fader-activator" data-image-id="singleMainMedia'.$key.'">
      <span class="image-fader"><span class="hover-icon-w"><i class="os-icon os-icon-plus"></i></span></span>
      <img src="'.$image['sizes']['osetin-medium-square-thumbnail'].'"/></div>';
    }
    $html.= '</div></div>';
  }else{
    if(!$post_id){
      global $post;
      $post_id = $post->ID;
    }


    $img_src = osetin_output_post_thumbnail_url($image_size, false, $post_id);
    $gif_img_attr = '';

    if(pathinfo($img_src, PATHINFO_EXTENSION) == 'gif' && osetin_get_field('is_gif_media')){
      $img_src = osetin_output_post_thumbnail_url('full', false, $post_id);
      $gif_html = '<span class="gif-label"><i class="os-icon os-icon-basic1-082_movie_video_camera"></i><span>'.__('GIF', 'zelus-by-osetin').'</span></span>';

      $extra_img_class = 'gif-media freezeframe-responsive';
      $extra_wrapper_class = 'gif-media-w';
      $is_gif = true;
      if(osetin_get_field('disable_lazy_load_gif') != true){
        if(osetin_get_field('preview_image_for_lazy_gif')){
          $preview_img_src = wp_get_attachment_image_src(osetin_get_field('preview_image_for_lazy_gif'), $image_size);
        }else{
          $preview_img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), $image_size);
        }
        if(!empty($preview_img_src[0])){
          $gif_img_attr = ' data-gif="'.$img_src.'" data-playon="hover" data-wait="true" ';
          $img_src = $preview_img_src[0];
          $extra_img_class = 'gif-media-lazy';
          $extra_wrapper_class = 'gif-media-lazy-w';
        }
      }
    }else{
      $is_gif = false;
      $extra_img_class = '';
      $extra_wrapper_class = ' osetin-lightbox-trigger';
      $gif_html = '';
    }

    if($img_src){
      $html.= '<div class="single-main-media-image-w active fader-activator '.$extra_wrapper_class.'" 
        data-lightbox-caption="'.esc_attr(get_the_title($post_id)).'" 
        data-lightbox-img-src="'.osetin_output_post_thumbnail_url('osetin-full-width', false, $post_id).'">
        <span class="image-fader lighter"><span class="hover-icon-w"><i class="os-icon os-icon-plus"></i></span></span>
        <img class="'.$extra_img_class.'" src="'.$img_src.'" alt="'.esc_attr(get_the_title($post_id)).'" '.$gif_img_attr.'/>'.$gif_html.'</div>';
    }
  }
  return $html;
}


function osetin_build_stars($rating = false){
  $stars_html = '';
  if($rating){
    $stars_html.= '<div class="review-stars-w">';
    for($i = 1; $i <= 5; $i++){
      if(round($rating) < $i) $star_state = 'rating-star-off';
      else $star_state = 'rating-star-on';
      $stars_html.= '<i class="os-icon os-icon-star '.$star_state.'"></i>';
    }
    $stars_html.= '</div>';
  }
  return $stars_html;
}

function osetin_get_sharing_icons(){
  $sharing_url = get_the_permalink();
  $img_to_pin = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : "";
  $osetin_current_title = is_front_page() ? get_bloginfo('description') : wp_title('', false);

  $facebook_share_link = 'http://www.facebook.com/sharer.php?u='.urlencode($sharing_url);
  $pinterest_share_link = '//www.pinterest.com/pin/create/button/?url='.$sharing_url.'&amp;media='.$img_to_pin.'&amp;description='.$osetin_current_title;
  ?>
  <a href="<?php echo esc_url($facebook_share_link); ?>" target="_blank" class="archive-item-share-link aisl-facebook"><i class="os-icon os-icon-facebook"></i></a>
  <a href="<?php echo 'http://twitter.com/share?url='.$sharing_url.'&amp;text='.urlencode($osetin_current_title); ?>" target="_blank" class="archive-item-share-link aisl-twitter"><i class="os-icon os-icon-twitter"></i></a>
  <a href="<?php echo esc_url($pinterest_share_link); ?>" target="_blank" class="archive-item-share-link aisl-pinterest"><i class="os-icon os-icon-pinterest"></i></a>
  <a href="<?php echo 'mailto:?Subject='.urlencode($osetin_current_title).'&amp;Body=%20'.$sharing_url ?>" target="_blank" class="archive-item-share-link aisl-mail"><i class="os-icon os-icon-email-in"></i></a>
  <?php
}



function build_index_posts($layout_type = 'masonry', $sidebar_name = false, $osetin_query = false, $sticky_posts = false, $header_arr = false, $content = false, $content_location = false){
  $archive_class = osetin_get_archive_class($layout_type);
  $archive_wrapper_class = osetin_get_archive_wrapper_class($layout_type);
  $masonry_layout_mode = osetin_get_masonry_layout_mode($layout_type);
  // sidebar
  $sidebar_location = osetin_get_field('sidebar_position_for_index_option', 'option', 'right');
  $sidebar_html = '';

  $content_html = '';
  if($content_location && $content_location != 'none'){
    $content_html = do_shortcode($content);
  }

  if($sidebar_name && is_active_sidebar( $sidebar_name )){
    $sidebar_class = 'with-sidebar sidebar-location-'.$sidebar_location;
    $sidebar_css =  'color-scheme-'.osetin_get_field('sidebar_background_color_type', 'option', 'light').' " style="'.osetin_get_css_prop('background-color', osetin_get_field('sidebar_background_color', 'option')) . osetin_get_css_prop('background-image', osetin_get_field('sidebar_background_image', 'option'));
    $sidebar_html.= '<div class="blog-sidebar">';
    ob_start();
    dynamic_sidebar( $sidebar_name );
    $sidebar_html.= ob_get_clean();
    $sidebar_html.= '</div>';
  }else{
    $sidebar_class = 'no-sidebar ';
  }

  
  $wrapper_step = 0;
  $item_step = 1;
  $counter = 1;

  $html = '';

  if(($content_location == 'before_all') && $content_html){
    $html.= '<div class="page-content-field-w">'.$content_html.'</div>';
  }
  $html.= '<div class="blog-content-w '.$sidebar_class.'">';
    if($sidebar_location == 'left'){
      $html.= $sidebar_html;
    }
    $html.= '<div class="blog-content">';
      if(($content_location == 'before_posts') && $content_html){
        $html.= $content_html;
      }



      // Index Header
      // -------------
      
      if($header_arr){
        $html.= '<div class="archive-title-w">';
          $html.= '<h1 class="page-title">'.$header_arr['title'].'</h1>';
          if ( ! empty( $header_arr['description'] ) ) {
            $html.= '<h2 class="page-content-sub-title">'.$header_arr['description'].'</h2>';
          }
        $html.= '</div>';
      }



      // Sticky posts
      // -------------

      if($sticky_posts){
        $html.= '<div class="sticky-roll-w"><img src="'.get_template_directory_uri().'/assets/img/curve-top-white.png" class="sticky-curve"/><div class="owl-carousel sticky-posts-owl-slider">';
        foreach($sticky_posts as $sticky_post){
          global $post;
          $post = $sticky_post;
          setup_postdata($post);
          $current_step_class = 'full_full_over';
          $limit = osetin_get_limit_by_item_type($current_step_class);
          ob_start(); ?>
          <div class="sticky-post">
            <div class="post-header-image" style="background-image: url('<?php the_post_thumbnail_url("osetin-full-width"); ?>');">
              <div class="post-header-image-contents">
                <div class="highlight-label"><?php _e('Featured Posts', 'zelus-by-osetin') ?></div>
                <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
                <div class="post-header-meta">
                  <?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                  <div class="author-details">
                    <span>By: </span><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author_meta( 'display_name' ); ?></a>
                    <span class="post-header-date-posted"><?php echo get_the_date(); ?></span>
                    <span class="post-header-comments"><?php comments_number( 'no comments', 'one comment', '% responses' ); ?></span>
                    <span class="post-header-categories"><?php echo get_the_category_list(); ?></span>

                  </div>
                </div>
              </div>
            </div>
          </div><?php
          $html.= ob_get_clean();
          wp_reset_postdata();
        }
        $html.= '</div></div>';
      }

      $html.= '<div class="blog-index" data-columns="">';
        if ( $osetin_query->have_posts() ) {
          while ( $osetin_query->have_posts() ) : $osetin_query->the_post();
            ob_start();
            include(locate_template('content.php'));
            $html.= ob_get_clean();
          endwhile;
        }else{
          $html.= osetin_load_template_part( 'content', 'none' ); 
        }
      $html.= '</div>';
      // pagination
      global $wp_query;
      $temp_query = $wp_query;
      $wp_query = $osetin_query;
      ob_start();
      osetin_output_navigation();
      $html.= '<div class="index-navigation">'.ob_get_clean().'</div>';
      $wp_query = $temp_query;
      wp_reset_postdata();
      if(($content_location == 'after_posts') && $content_html){
        $html.= $content_html;
      }
    $html.= '</div>';
    if($sidebar_location == 'right'){
      $html.= $sidebar_html;
    }
  $html.= '</div>';
  if(($content_location == 'after_all') && $content_html){
    $html.= '<div class="page-content-field-w">'.$content_html.'</div>';
  }
  return $html;
}


function osetin_sub_pages_navigation() {
  global $post;
  $html = '';
  $childpages = '';
  $parent_page = '';
  if ( is_page() && $post->post_parent ){
    $parent_page = '<li><a href="'.get_the_permalink($post->post_parent).'">'.get_the_title($post->post_parent).'</a></li>';
    $childpages.= wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  }else{
    $parent_page = '<li class="current_page_item"><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
    $childpages.= wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );
  }
  if ( $childpages != '' ) {
    $html.= '<div class="secondary-menu"><ul>' . $parent_page . $childpages . '</ul></div>';
  }
  return $html;
}


function osetin_get_the_title($post_id){
  $custom_title = osetin_get_field('custom_title', $post_id);
  if($custom_title){
    return $custom_title;
  }else{
    return get_the_title($post_id);
  }
}

function osetin_is_imaged_header($post_id = false, $image_placement = 'background'){
  if(!$post_id) return false;
  return (has_post_thumbnail($post_id) || osetin_is_bbpress()) && (osetin_get_field('featured_image_placement', $post_id, 'background') == $image_placement);
}

function osetin_top_bar_visible(){
  return (osetin_get_field('hide_top_bar', 'option') != 'yes');
}

function osetin_top_bar_cart_button_visible(){
  return (function_exists('WC') && osetin_is_woocommerce_installed() && (osetin_get_field('show_cart_link_in_the_top_bar', 'option') != 'no'));
}

function osetin_top_bar_checkout_button_visible(){
  return (function_exists('WC') && osetin_is_woocommerce_installed() && (osetin_get_field('show_checkout_link_in_the_top_bar', 'option') != 'no'));
}

function osetin_is_woocommerce_installed(){
  return class_exists( 'WooCommerce' );
}

function osetin_is_regular_header($post_id = false){
  if(!$post_id) return true;
  return (osetin_get_field('hide_title', $post_id) != true) && (!has_post_thumbnail($post_id) && !osetin_is_bbpress());
}

function osetin_is_active_sidebar($location = 'sidebar-index', $post_id = false, $sub_pages_navigation_html = false){
  if($post_id){
    if(osetin_get_field('hide_sidebar', $post_id) == true){
      return false;
    } 
  }else{
    if(osetin_get_field('hide_sidebar') == true){
      return false;
    } 
  }
  if($sub_pages_navigation_html) return true;

  switch ($location) {
    case 'sidebar-index':
      if(osetin_is_bbpress_userpage()){
        return false;
      }else{
        return is_active_sidebar($location);
      }
      break;
    
    case 'sidebar-single-page':
      return is_active_sidebar($location);
      break;
    default:
      return true;
      break;
  }
}

function osetin_is_bbpress_userpage(){
  if(osetin_is_bbpress()){
    return bbp_is_single_user();
  }else{
    return false;
  }
}



function osetin_get_limit_by_item_type($item_class, $wrapper_class = false, $archive_class = 'masonry-grid'){
  if($archive_class == 'masonry-grid'){
    switch($item_class){
      case 'hero':
        return 20;
      break;
      case 'full_full_over':
        return 30;
      break;
      case 'full_full':
        switch($wrapper_class){
          case 'half':
            return 30;
            break;
          case 'third':
            return 25;
            break;
          case 'fourth':
            return 20;
            break;
          default:
            return 30;
            break;
        }
      break;
      default:
        return false;
      break;
    }
  }else{
    return 50;
  }
}

function osetin_get_archive_thumb_name($item_class){
  switch($item_class){
    case 'full_full_over':
      return 'osetin-full-width';
    break;
    case 'hero':
      return 'osetin-full-width';
    break;
    case 'full_full':
      return 'large';
    break;
    default:
      return 'osetin-medium-square-thumbnail';
    break;
  }
}

function osetin_get_archive_wrapper_class($layout_type = false){
  if($layout_type == false) $layout_type = osetin_get_settings_field('layout_type_for_index', 'magazine_v1');
  switch($layout_type){
    case 'magazine_v1':
      return 'masonry-grid-w magazine-v1';
    break;
    case 'magazine_v2':
      return 'masonry-grid-w magazine-v2';
    break;
    case 'masonry_2':
      return 'masonry-grid-w per-row-2';
    break;
    case 'masonry_3':
      return 'masonry-grid-w per-row-3';
    break;
    case 'masonry_4':
      return 'masonry-grid-w per-row-4';
    break;
    case 'full_width':
      return 'list-items-w list-items-full-width';
    break;
    case 'half_image':
      return 'list-items-w list-items-half-image';
    break;
    case 'packery':
      return 'masonry-grid-w masonry-title-image';
    break;
    default:
      return 'masonry-grid-w magazine-v1';
    break;
  }
}

function osetin_get_archive_class($layout_type_for_index = 'magazine_v1'){
  if(in_array($layout_type_for_index, array('masonry_2', 'masonry_3', 'masonry_4', 'magazine_v1', 'magazine_v2', 'packery'))){
    return 'masonry-grid';
  }else{
    return 'list-items';
  }
}

function osetin_get_masonry_layout_mode($layout_type_for_index = 'magazine_v1'){
  if(in_array($layout_type_for_index, array('packery'))){
    return 'packery';
  }else{
    return 'fitRows';
  }
}


function osetin_count_sidebar_widgets( $sidebar_id, $echo = false ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return 4;
    $count = count( $the_sidebars[$sidebar_id] );
    if(($count > 4) || ($count == 1)) $count = 4;
    if( $echo )
        echo esc_attr($count);
    else
        return $count;
}

function osetin_get_css_prop($property, $field_value, $default = false, $extra = ''){
  if($field_value){
    if($property == 'background-image'){
      return $property.':url('.$field_value.'); '.$extra;
    }else{
      return $property.':'.$field_value.'; '.$extra;
    }
  }elseif($default){
    return $property.':'.$default.'; '.$extra;
  }else{
    return '';
  }
}

function osetin_get_default_value($field_name = ''){
  global $my_osetin_acf;
  return $my_osetin_acf->get_default_var($field_name);
}


function osetin_have_rows($field_name, $post_id = false){
  if(function_exists('have_rows')){
    return have_rows($field_name, $post_id);
  }else{
    return false;
  }
}

function osetin_output_navigation(){
  if(function_exists('wp_pagenavi')){ ?>
    <div class="archive-pagination pagenavi-pagination">
      <?php wp_pagenavi(); ?>
    </div>
  <?php }else{ ?>
    <?php if(get_next_posts_link() || get_previous_posts_link()){ ?>
      <div class="archive-pagination classic-pagination">
        <?php if(get_previous_posts_link()){ ?>
          <div class="archive-pagination-prev"><?php previous_posts_link( esc_html__('Previous Entries', 'zelus-by-osetin') ); ?></div>
        <?php } ?>
        <?php if(get_next_posts_link()){ ?>
          <div class="archive-pagination-next"><?php next_posts_link( esc_html__('Next Entries', 'zelus-by-osetin'), '' ); ?></div>
        <?php } ?>
      </div>
    <?php } ?>
  <?php }
}

function osetin_get_field($field_name, $post_id = false, $default = '', $expecting_array = false){
  if(function_exists('get_field')){
    $field_value = get_field($field_name, $post_id);
    if(($expecting_array == false) && is_array($field_value)){
      if(reset($field_value)){
        $final_value = reset($field_value);
      }else{
        $final_value = $field_value;
      }
    }else{
      $final_value = $field_value;
    }
    if(empty($final_value)) $final_value = get_field($field_name, $post_id);
    if(empty($final_value) && $default != '') return $default;
    else return $final_value;
  }else{
    if($default == ''){
      return osetin_get_default_value($field_name);
    }else{
      return $default;
    }
  }
}


// Loads get_template_part() into variable
function osetin_load_template_part($template_name, $part_name=null) {
  ob_start();
  get_template_part($template_name, $part_name);
  $var = ob_get_clean();
  return $var;
}

function osetin_get_settings_field($field_name, $default = '', $post_id = false, $forse_single = false, $expecting_array = false)
{
  if(is_single() || is_page() || $forse_single){
    if(!$post_id){
      global $post;
      if(isset($post->ID)) $post_id = $post->ID;
    }
    $temp_val = osetin_get_field($field_name, $post_id, 'default', $expecting_array);
    if(($temp_val === 'default') || (null === $temp_val) || ($temp_val === '')){
      $val = osetin_get_field($field_name.'_option', 'option', $default, $expecting_array);
    }else{
      $val = $temp_val;
    }
  }else{
    $val = osetin_get_field($field_name.'_option', 'option', $default, $expecting_array);
  }
  if(null === $val){
    $val = $default;
  }
  return $val;
}


// ------------
// Customize default wordpress excerpt with a custom length and "more" text depending on user select in admin
// ------------

function osetin_excerpt($limit = false, $more = TRUE, $more_link_class ='read-more-link', $more_appendix = '...') {
  if(!$limit){
    $limit = osetin_get_field('excerpt_length_option', 'option', 20);
  }
  if($more){
    return wp_trim_words(get_the_excerpt(), $limit, osetin_excerpt_more($more_link_class));
  }else{
    return wp_trim_words(get_the_excerpt(), $limit, $more_appendix);
  }

}





// ------------
// Excerpt "more" text settings
// ------------

function osetin_excerpt_more($more_link_class = 'read-more-link') {
  if(get_post_format(get_the_ID()) == 'link'){
    return '...<div class="'.$more_link_class.'"><a href="'. osetin_get_field( 'external_link' ) . '">' . esc_html__('Read More', 'zelus-by-osetin') . '</a></div>';
  }else{
    return '...<div class="'.$more_link_class.'"><a href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('Read More', 'zelus-by-osetin') . '</a></div>';
  }
}
add_filter( 'excerpt_more', 'osetin_excerpt_more' );



function osetin_get_post_thumbnail($post_id, $thumbnail_name = 'osetin-medium-square-thumbnail'){
  if(has_post_thumbnail($post_id)){
    return get_the_post_thumbnail($post_id, $thumbnail_name);
  }else{
    if($thumbnail_name == 'osetin-medium-square-thumbnail'){
      $placeholder_url = osetin_get_placeholder_image_url(true);
    }else{
      $placeholder_url = osetin_get_placeholder_image_url();
    }
    return '<img src="'.$placeholder_url.'" alt="'.esc_attr($post_id).'"/>';
  }
}


function osetin_output_post_thumbnail_url($size = 'post-thumbnail', $forse_single = false, $post_id = false)
{
  if(is_single() || $forse_single){
    if(has_post_thumbnail()) $img_arr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'osetin-full-width');
    else return osetin_get_placeholder_image_url();
  }else{
    if(!$post_id){
      $post_id = get_the_ID();
    }
    $img_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
  }
  if(isset($img_arr[0])){
    return $img_arr[0];
  }else{
    return osetin_get_placeholder_image_url();
  }
}

function osetin_get_placeholder_image_url($squared = false){
  return '';
  $placeholder_url = $squared ? get_template_directory_uri().'/assets/img/placeholder-square.jpg' : get_template_directory_uri().'/assets/img/placeholder.jpg';
  $placeholder_img_id = osetin_get_field('placeholder_image', 'option');
  if ($placeholder_img_id){
    $size_name = $squared ? 'osetin-medium-square-thumbnail' : 'osetin-full-width';
    $img_url_arr = wp_get_attachment_image_src($placeholder_img_id, $size_name);
    if($img_url_arr){
      $placeholder_url = $img_url_arr[0];
    }
  }
  return $placeholder_url;
}

function osetin_output_post_thumbnail_data_arr($size = 'post-thumbnail', $forse_single = false, $post_id = false)
{
  if(is_single() || $forse_single){
    if(has_post_thumbnail()) $img_arr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'osetin-full-width');
  }else{
    if(!$post_id){
      $post_id = get_the_ID();
    }
    $img_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
  }
  if(isset($img_arr)){
    return $img_arr;
  }else{
    return false;
  }
}

function osetin_hex_to_rgb($hex, $tp) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b, $tp);
   return 'rgba('.implode(",", $rgb).')';
}

function osetin_get_number_of_posts_per_page(){
  if(osetin_get_field('override_posts_per_page')){
    return osetin_get_field('override_posts_per_page');
  }else{
    return get_option('posts_per_page');
  }
}

function osetin_is_userpro_installed(){
  return function_exists('userpro_is_logged_in');
}

function osetin_is_bbpress(){
  return (function_exists('is_bbpress') && is_bbpress());
}

function osetin_output_breadcrumbs($with_container = true){
  if(osetin_get_field('hide_breadcrumbs_bar') == true) return;
  if($with_container) echo '<div class="os-container breadcrumbs-bar-w">';
  echo '<div class="breadcrumbs-bar">';
  if(osetin_is_bbpress()){
    bbp_breadcrumb();
  }else{
    echo '<ul class="bar-breadcrumbs">';
      if(is_home()){
        echo '<li>'.esc_html__('Home', 'zelus-by-osetin').'</li>';
      }elseif(is_category()){
        echo '<li><a href="'.site_url().'">'.esc_html__('Home', 'zelus-by-osetin').'</a></li>';
        echo '<li>'.get_cat_name(get_query_var('cat')).'</li>';
      }elseif(is_archive()){
        echo '<li><a href="'.site_url().'">'.esc_html__('Home', 'zelus-by-osetin').'</a></li>';
        echo '<li>'.get_the_archive_title().'</li>';
      }else{
        echo '<li><a href="'.site_url().'">'.esc_html__('Home', 'zelus-by-osetin').'</a></li>';
        $categories = get_the_category();
        if(!empty($categories)){
          $category = $categories[0];
          echo '<li><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( esc_html__( "View all posts in %s", 'zelus-by-osetin' ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
        }
        echo '<li>'.get_the_title().'</li>';
      }
    echo '</ul>';
  }
  echo '</div>';
  if($with_container) echo '</div>';
}



function osetin_get_post_sharing_icons(){
  $sharing_url = get_the_permalink();
  $img_to_pin = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : "";
  $osetin_current_title = is_front_page() ? get_bloginfo('name') : wp_title('', false);
  $blog_name = get_bloginfo('name');
  $osetin_current_description = is_front_page() ? get_bloginfo('description') : get_the_excerpt();

  $facebook_share_link = 'http://www.facebook.com/sharer.php?u='.urlencode($sharing_url);
  $pinterest_share_link = '//www.pinterest.com/pin/create/button/?url='.$sharing_url.'&amp;media='.$img_to_pin.'&amp;description='.$osetin_current_title;
  $google_share_link = 'https://plus.google.com/share?url='.$sharing_url;
  $yummly_share_link = 'http://www.yummly.com/urb/verify?url='.$sharing_url.'&title='.$osetin_current_title.'&yumtype=button';
  ?>
  <div class="split-share">
  <a href="<?php echo 'mailto:?Subject='.urlencode($osetin_current_title).'&amp;Body=%20'.$sharing_url ?>" target="_blank" class="archive-item-share-link aisl-mail"><i class="os-icon os-icon-email-in"></i></a>
  <a href="javascript:window.print()" class="archive-item-share-link aisl-print"><i class="os-icon os-icon-printer"></i></a>
  <a href="#" target="_blank" class="archive-item-share-link aisl-font"><i class="os-icon os-icon-characters"></i></a>
  </div>
  <span><?php _e('Share', 'zelus-by-osetin'); ?></span>
  <a href="<?php echo esc_url($facebook_share_link); ?>" target="_blank" class="archive-item-share-link aisl-facebook"><i class="os-icon os-icon-social-facebook"></i></a>
  <a href="<?php echo esc_url($yummly_share_link); ?>" target="_blank" class="archive-item-share-link aisl-linkedin"><img src="<?php echo get_template_directory_uri().'/assets/img/yum-small.png' ?>"/></a>
  <a href="<?php echo 'http://twitter.com/share?url='.$sharing_url.'&amp;text='.urlencode($osetin_current_title); ?>" target="_blank" class="archive-item-share-link aisl-twitter"><i class="os-icon os-icon-social-twitter"></i></a>
  <a href="<?php echo esc_url($pinterest_share_link); ?>" data-pin-custom="true" target="_blank" class="archive-item-share-link aisl-pinterest"><i class="os-icon os-icon-social-pinterest"></i></a>
  <a href="<?php echo esc_url($google_share_link); ?>" target="_blank" class="archive-item-share-link aisl-googleplus"><i class="os-icon os-icon-social-googleplus"></i></a>  
  <?php
}

function osetin_social_share_icons($location = 'footer', $background_color_css = ''){
  // if social icons are set to appear in footer or header - output them
  if(((osetin_get_field('show_footer_social_icons', 'option') == 'yes') && ($location == 'footer')) || ((osetin_get_field('show_header_social_icons', 'option') == 'yes') && ($location == 'header'))){
    if( osetin_have_rows('social_links', 'option') ){
      echo '<ul class="bar-social" style="'.$background_color_css.'">';

      // loop through the rows of data
      while ( osetin_have_rows('social_links', 'option') ) : the_row();
          echo '<li><a href="'.get_sub_field('social_page_url').'" target="_blank"><i class="os-icon os-icon-'.get_sub_field('social_network').'"></i></a></li>';
      endwhile;

      echo '</ul>';

    }
  }
}


function osetin_post_social_share_icons(){
  $html = '';
  // if social icons are set to appear in footer or header - output them
  if( osetin_have_rows('team_member_social_links') ){
    $html.= '<ul class="social-icons">';

    // loop through the rows of data
    while ( osetin_have_rows('team_member_social_links') ) : the_row();
        $html.= '<li><a href="'.get_sub_field('social_page_url').'" target="_blank"><i class="os-icon os-icon-'.get_sub_field('social_network').'"></i></a></li>';
    endwhile;

    $html.= '</ul>';

  }
  return $html;
}



function osetin_get_image_url_by_id($attachment_id = false, $size = 'full', $default = false){
  if($attachment_id){
    $img_arr = wp_get_attachment_image_src($attachment_id, $size);
    if(isset($img_arr[0])) return $img_arr[0];
  }
  return $default;
}




if ( ! function_exists( 'osetin_cta_box' ) ) :
    function osetin_cta_box() {
      if(osetin_get_field('show_call_to_action_box')){
        $cta_box_color = 'cta-box-color-cyan';
        echo '<div class="cta-box '.$cta_box_color.'">';
          echo '<h4>'.osetin_get_field('cta_box_title').'</h4>';
          echo '<div class="cta-box-content">'.osetin_get_field('cta_box_content').'</div>';
        echo '</div>';
      }
    }
endif;



function osetin_output($html){
  return $html;
}



function osetin_get_services_query() {

  $args = array(
  'orderby' => 'menu_order title',
  'order'   => 'ASC',
  'post_type' => 'osetin_service',
  'posts_per_page' => -1
  );

  
  if( osetin_get_field('show_selected_services_in_the_sidebar', false, false, true) ) $args['post__in'] = osetin_get_field('show_selected_services_in_the_sidebar', false, false, true);

  $services_query = new WP_Query( $args );
  return $services_query;
}