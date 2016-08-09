<?php
/**
 * Adds image widget.
 */
class perf_image_widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'perf_image_widget', // Base ID
      __('Perf Image', 'lightbold'), // Name
      array( 'description' => __( 'Image widget for Light and Bold', 'lightbold' ), ) // Args
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
    
    $nofollow = get_field('perf_image_noffolow_widget', 'widget_' . $args['widget_id']);
    $link = get_field('perf_image_link_widget', 'widget_' . $args['widget_id']);
    $image = get_field('perf_image_widget', 'widget_' . $args['widget_id']);
  
    ?>
      <?php if( $link ): ?>
        <a href="<?php echo $link; ?>" <?php if( $nofollow ){ echo 'rel="nofollow"'; } ?> target="_blank" class="border-none">
      <?php endif; ?>
        <img src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" data-src="<?php echo $image['sizes']['medium']; ?>" title="<?php echo $image['title']; ?>" alt="<?php echo $image['alt']; ?>" class="lazyload">
      <?php if( $link ): ?>
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
      $title = $instance['title'];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
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

} // class perf_image_widget

// register perf_image_widget widget
add_action( 'widgets_init', function(){
  register_widget( 'perf_image_widget' );
});