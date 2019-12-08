<?php


// WIDGETS




/**
 * Adds Osetin_Newsletter_Widget widget.
 */
class Osetin_Newsletter_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'osetin_newsletter_widget', // Base ID
      __( 'Osetin Newsletter CTA', 'psych-helper' ), // Name
      array( 'description' => __( 'Newsletter CTA Widget', 'psych-helper' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      $title = apply_filters( 'widget_title', $instance['title'] );
    }else{
      $title = '';
    }


    $bg_image_url = osetin_get_field('bg_image_url', 'widget_'.$args['widget_id']);
    $bg_color = osetin_get_field('bg_color', 'widget_'.$args['widget_id']);
    $sub_header_text = osetin_get_field('sub_header_text', 'widget_'.$args['widget_id']);
    $form_code = osetin_get_field('form_code', 'widget_'.$args['widget_id']);


    $attr_string = '';
    if($title) $attr_string.= ' header_text="'.$title.'"';
    if($bg_image_url) $attr_string.= ' bg_image_url="'.$bg_image_url.'"';
    if($bg_color) $attr_string.= ' bg_color="'.$bg_color.'"';
    if($sub_header_text) $attr_string.= ' sub_header_text="'.$sub_header_text.'"';


    echo do_shortcode('[os_small_newsletter_form_cta'.$attr_string.']'.$form_code.'[/os_small_newsletter_form_cta]');

    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Osetin_Newsletter_Widget




/**
 * Adds Osetin_Cta_Widget widget.
 */
class Osetin_Cta_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'osetin_cta_widget', // Base ID
      __( 'Osetin Call To Action', 'psych-helper' ), // Name
      array( 'description' => __( 'Call to Action Widget', 'psych-helper' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];

    if ( ! empty( $instance['title'] ) ) {
      $title = apply_filters( 'widget_title', $instance['title'] );
    }else{
      $title = '';
    }


    $bg_image = osetin_get_field('background_image', 'widget_'.$args['widget_id']);
    $bg_color = osetin_get_field('background_color', 'widget_'.$args['widget_id']);
    $sub_title = osetin_get_field('sub_title', 'widget_'.$args['widget_id']);
    $link_url = osetin_get_field('link_url', 'widget_'.$args['widget_id']);
    $link_text = osetin_get_field('link_text', 'widget_'.$args['widget_id']);
    $offer_image = osetin_get_field('offer_image', 'widget_'.$args['widget_id']);
    $specific_ids = osetin_get_field('specific_ids', 'widget_'.$args['widget_id']);

    $cta_content = '<h3 class="widget-title">'.$title.'</h3><p>'.$sub_title.'</p>';

    $attr_string = '';
    if($bg_color) $attr_string.= ' bg_color="'.$bg_color.'"';
    if($bg_image) $attr_string.= ' bg_image_url="'.$bg_image.'"';
    if($offer_image) $attr_string.= ' offer_image_url="'.$offer_image.'"';
    if($link_text) $attr_string.= ' link_label="'.$link_text.'"';
    if($link_url) $attr_string.= ' link_url="'.$link_url.'"';
    if($specific_ids) $attr_string.= ' specific_ids="'.implode($specific_ids, ',').'"';

    echo do_shortcode('[os_cta_block'.$attr_string.']'.$cta_content.'[/os_cta_block]');

    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Osetin_Cta_Widget






/**
 * Adds Osetin_Categories_Widget widget.
 */
class Osetin_Categories_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'osetin_categories_widget', // Base ID
      __( 'Osetin Categories', 'psych-helper' ), // Name
      array( 'description' => __( 'Catogories Table Widget', 'psych-helper' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    $limit = osetin_get_field('limit', 'widget_'.$args['widget_id']);
    $include_child_categories = osetin_get_field('include_child_categories', 'widget_'.$args['widget_id']);
    $specific_ids = osetin_get_field('specific_ids', 'widget_'.$args['widget_id'], false, true);
    $attr_string = '';
    if($limit) $attr_string.= ' limit="'.$limit.'"';
    if($include_child_categories) $attr_string.= ' include_child_categories="true"';
    if($specific_ids) $attr_string.= ' specific_ids="'.implode($specific_ids, ',').'"';
    echo do_shortcode('[osetin_categories_icons'.$attr_string.']');
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Osetin_Categories_Widget





/**
 * Adds Osetin_Testimonial_Widget widget.
 */
class Osetin_Testimonial_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'osetin_testimonial_widget', // Base ID
      __( 'Osetin Testimonial', 'psych-helper' ), // Name
      array( 'description' => __( 'Testimonial Widget', 'psych-helper' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }



    $testimonial = osetin_get_field('testimonial_to_show', 'widget_'.$args['widget_id']);

    if( $testimonial ):
      global $post;
      // override $post
      $post = $testimonial;
      setup_postdata( $post );

      echo '<div class="widget-testimonial-text">'.get_the_content().'</div>';
      echo '<div class="widget-testimonial-author"><div class="wt-author-thumb">'.get_the_post_thumbnail().'</div> <div class="wt-author-name">'.get_the_title().'</div></div>';

      wp_reset_postdata();

    endif;

    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Osetin_Testimonial_Widget





/**
 * Adds Osetin_Social_Widget widget.
 */
class Osetin_Social_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'osetin_Social_widget', // Base ID
      __( 'Osetin Social Links', 'psych-helper' ), // Name
      array( 'description' => __( 'Social Links Widget', 'psych-helper' ), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    echo do_shortcode('[osetin_social_links]');
    echo $args['after_widget'];
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class Osetin_Social_Widget



// register widgets
function register_osetin_widgets() {
    register_widget( 'Osetin_Categories_Widget' );
    register_widget( 'Osetin_Social_Widget' );
    register_widget( 'Osetin_Cta_Widget' );
    register_widget( 'Osetin_Testimonial_Widget' );
    register_widget( 'Osetin_Newsletter_Widget' );
}
add_action( 'widgets_init', 'register_osetin_widgets' );
