<?php
/**
 * Brand Description Widget
 *
 * When viewing a brand archive, show the current brands description + image
 *
 * @package		WooCommerce
 * @category	Widgets
 * @author		WooThemes
 */


class Postcale_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */

	public function __construct() {
		parent::__construct(
	 		'postcale_Widget', // Base ID
			'Postcale_Widget', // Name
			array( 'description' => __( 'A post calender', 'text_domain' ), ) // Args
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
		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$catid = $instance['catid'];

		// global $wpdb;
		// $posts = get_posts('category='.$catid);
		// $rand_num = count($posts)-1;
		// $rand_post = $posts[rand(0,$rand_num)];

		// $out = $rand_post->post_content;
		$cat = get_the_category();

		$out = '<div class="news_title">'.$cat[0]->name.'日历</div>';
		$out.= '<ul class="calendar">';

		echo $before_widget;
		echo $before_title.$title.$after_title;
		echo $out;

		wp_get_archives( 
					array( 
						'type' => 'daily', 
						'limit' => 12, 
						'show_post_count' => true
						) 
					);
		echo '</ul>';
		echo $after_widget;
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
		$instance['title'] = strip_tags( $new_instance['title'] );
  		$instance['catid'] = $new_instance['catid'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'A post calender', 'text_domain' );
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id('catid'); ?>">Category ID:</label>
			<?php wp_dropdown_categories('hide_empty=0&hierarchical=1&id='.$this->get_field_id('catid').'&name='.$this->get_field_name('catid').'&selected='.$instance['catid']); ?>
		</p>


		<?php 
	}

} // class News_Widget