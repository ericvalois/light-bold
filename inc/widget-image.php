<?php
/**
 * Adds image widget.
 */
class light_bold_image_widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'light_bold_image_widget', // Base ID
      __('PerfThemes Image', 'light-bold'), // Name
      array( 'description' => __( 'Image widget for Light and Bold', 'light-bold' ), ) // Args
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
    if ( !empty($instance['title']) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    }
    
    $light_bold_nofollow = get_field('perf_image_noffolow_widget', 'widget_' . $args['widget_id']);
    $light_bold_link = get_field('perf_image_link_widget', 'widget_' . $args['widget_id']);
    $light_bold_image = get_field('perf_image_widget', 'widget_' . $args['widget_id']);
  
    ?>
      <?php if( $light_bold_link ): ?>
        <a href="<?php echo $light_bold_link; ?>" target="_blank" rel="noopener noreferrer <?php if( $light_bold_nofollow ){ echo 'nofollow'; } ?>" class="border-none">
      <?php endif; ?>
        <img src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-src="<?php echo $light_bold_image['url']; ?>" title="<?php echo $light_bold_image['title']; ?>" alt="<?php echo $light_bold_image['alt']; ?>" class="lazyload">
      <?php if( $light_bold_link ): ?>
        </a>
      <?php endif; ?>
    <?php
    

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
    if ( isset($instance['title']) ) {
      $light_bold_title = $instance['title'];
    }
    else {
      $light_bold_title = __( 'New title', 'light-bold' );
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','light-bold' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $light_bold_title ); ?>">
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
    $light_bold_instance = array();
    $light_bold_instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $light_bold_instance;
  }

} // class light_bold_image_widget

// register light_bold_image_widget widget
add_action( 'widgets_init', function(){
  register_widget( 'light_bold_image_widget' );
});