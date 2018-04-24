<?php

class The_Green_Web_Widget extends WP_Widget {

	/**
	 * Sets up the widget's name
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'the_green_web_widget',
			'description' => __('Show The Green Web Foundation badge', 'the-green-web-widget' ),
		);
		parent::__construct( 'the_green_web_widget', 'The Green Web Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$url_parse = wp_parse_url( home_url() );
		$domain = $url_parse['host'];
		echo '<img src="https://api.thegreenwebfoundation.org/greencheckimage/' . $domain . '" alt="' . __( 'This website is hosted Green - checked by thegreenwebfoundation.org', 'the-green-web-widget' ) . '">'; // WPCS: XSS ok.
	}

}
