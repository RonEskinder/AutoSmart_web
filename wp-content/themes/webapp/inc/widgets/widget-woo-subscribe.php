<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*---------------------------------------------------------------------------------*/
/* Subscribe widget */
/*---------------------------------------------------------------------------------*/
class tt_webapp_Subscribe extends WP_Widget {
	var $settings = array( 'title', 'form', 'social', 'single', 'page' );

	function tt_webapp_Subscribe() {
		$widget_ops = array( 'description' => 'Add a subscribe/connect widget.' );
		parent::__construct( false, esc_html__( 'TT - Subscribe / Connect', 'webapp' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		$instance = $this->tt_enforce_defaults( $instance );
		extract( $args, EXTR_SKIP );
		extract( $instance, EXTR_SKIP );
		if ( !is_singular() || ($single != 'on' && is_single()) || ($page != 'on' && is_page()) ) {
		?>
			<?php echo wp_kses($before_widget, tt_webapp_allowed_tags()); ?>
			<?php tt_webapp_subs_connect('true', $title, $form, $social); ?>
			<?php echo wp_kses($after_widget, tt_webapp_allowed_tags()); ?>
		<?php
		}
	}

	function update($new_instance, $old_instance) {
		$new_instance = $this->tt_enforce_defaults( $new_instance );
		return $new_instance;
	}

	function tt_enforce_defaults( $instance ) {
		$defaults = $this->tt_get_settings();
		$instance = wp_parse_args( $instance, $defaults );
		$instance['title'] = strip_tags( $instance['title'] );
		if ( '' == $instance['title'] )
			$instance['title'] = esc_html__('Subscribe', 'webapp');
		foreach ( array( 'form', 'social', 'single', 'page' ) as $checkbox ) {
			if ( 'on' != $instance[$checkbox] )
					$instance[$checkbox] = '';
		}
		return $instance;
	}

	/**
	 * Provides an array of the settings with the setting name as the key and the default value as the value
	 * This cannot be called get_settings() or it will override WP_Widget::get_settings()
	 */
	function tt_get_settings() {
		// Set the default to a blank string
		$settings = array_fill_keys( $this->settings, '' );
		// Now set the more specific defaults
		return $settings;
	}

	function form($instance) {
		$instance = $this->tt_enforce_defaults( $instance );
		extract( $instance, EXTR_SKIP );
?>
		<p><em><?php esc_html_e('Setup this widget in your','webapp'); ?> <a href="<?php echo esc_url(admin_url( 'admin.php?page=templatation' )); ?>"><?php esc_html_e('options panel','webapp'); ?></a> <?php wp_kses( esc_html__( 'under <strong>Subscribe &amp; Connect</strong>', 'webapp' ), tt_webapp_allowed_tags() ); ?></em>.</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title (optional):','webapp'); ?></label>
			<input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr(esc_attr( $title )); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('form')); ?>" name="<?php echo esc_attr($this->get_field_name('form')); ?>" type="checkbox" <?php checked( $form, 'on' ); ?>> <?php esc_html_e('Disable Subscription Form', 'webapp'); ?> </input>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('social')); ?>" name="<?php echo esc_attr($this->get_field_name('social')); ?>" type="checkbox" <?php checked( $social, 'on' ); ?>> <?php esc_html_e('Disable Social Icons', 'webapp'); ?> </input>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('single')); ?>" name="<?php echo esc_attr($this->get_field_name('single')); ?>" type="checkbox" <?php checked( $single, 'on' ); ?>> <?php esc_html_e('Disable in Posts', 'webapp'); ?> </input>
		</p>
		<p>
			<input id="<?php echo esc_attr($this->get_field_id('page')); ?>" name="<?php echo esc_attr($this->get_field_name('page')); ?>" type="checkbox" <?php checked( $page, 'on' ); ?>> <?php esc_html_e('Disable in Pages', 'webapp'); ?> </input>
		</p>
<?php
	}
}

register_widget( 'tt_webapp_Subscribe' );
