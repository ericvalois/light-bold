<?php
/**
 * Adds address widget
 */
class light_bold_address_widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'light_bold_address_widget', // Base ID
      esc_html__('TTFB Address', 'light-bold'), // Name
      array( 'description' => esc_html__( 'Address widget for Light and Bold', 'light-bold' ), ) // Args
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
    

    $perf_sections = get_field('perf_address_widget', 'widget_' . $args['widget_id']);

    if( is_array($perf_sections) && count($perf_sections) > 0 ){
      foreach( $perf_sections as $section ){
      	?>
      		<div class="table col-12 address_row">
            <div class="table-cell width30 align-top">
                <svg class="fa <?php echo esc_attr( $section['icon'] ); ?>"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<?php echo esc_attr( $section['icon'] ); ?>"></use></svg>
            </div>

            <div class="table-cell small-p align-top">
              <p class="mb0"><?php echo wp_kses( $section['content'], array( 'br' => array() ) ); ?></p>
            </div>
          </div>
      	<?php
      }
    }

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
      $perf_title = $instance['title'];
    }
    else {
      $perf_title = esc_html__( 'New title', 'light-bold' );
    }
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e(  'Title:','light-bold' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $perf_title ); ?>">
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

} // class light_bold_address_widget

// register light_bold_address_widget widget
add_action( 'widgets_init', function(){
  register_widget( 'light_bold_address_widget' );
});