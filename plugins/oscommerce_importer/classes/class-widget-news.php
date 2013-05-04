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


class News_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */

	public function __construct() {
		parent::__construct(
	 		'news_Widget', // Base ID
			'News_Widget', // Name
			array( 'description' => __( 'A News Widget', 'text_domain' ), ) // Args
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
		$width = $instance['width'];
		$count = $instance['count'];

		// global $wpdb;
		$posts = get_posts('category='.$catid);
		$out = '<ul class="news_image_slider">';
		foreach($posts as $post) {
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'medium' );
			$url = $thumb['0'];
			$out .= '<li><a href="'.get_permalink($post->ID).'" style="background-image:url('.$url.');"></a></li>';
		}
		$out .= '</ul>';

		echo $before_widget;
		echo $before_title.$title.$after_title;
		// echo $out;
		woocommerce_get_template( 'widgets/category_slider.php', array(
			'posts'	=> $posts,
			'width' => $width,
			'count' => $count
		), 'oscommerce_importer', untrailingslashit( plugin_dir_path( dirname( dirname( __FILE__ ) ) ) ) . '/oscommerce_importer/templates/' );


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
  		$instance['width'] = $new_instance['width'];
  		$instance['count'] = $new_instance['count'];

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
			$title = __( 'News Slider', 'text_domain' );
		}

		if ( isset( $instance[ 'width' ] ) ) {
			$width = $instance[ 'width' ];
		}
		else {
			$width = __( '250', 'text_domain' );
		}

		if ( isset( $instance[ 'count' ] ) ) {
			$count = $instance[ 'count' ];
		}
		else {
			$count = __( '4', 'text_domain' );
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

		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
		</p>
		<?php 
	}

} // class News_Widget