<?php
/**
 * Case Studies Addon
 *
 * @package Radiantthemes
 */

namespace RadiantthemesAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Blog widget.
 *
 * Elementor widget that displays posts in different styles.
 *
 * @since 1.0.0
 */
class Radiantthemes_style_Custom_Cart extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'radiant-custom-cart';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Custom Cart', 'radiantthemes-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-cart-solid';
	}

	/**
	 * Requires css files.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return [
			'radiantthemes-addons-custom',
		];
	}

	/**
	 * Requires js files.
	 *
	 * @return array
	 */
	// public function get_script_depends() {
	// return [
	// 'radiantthemes-blog',
	// ];
	// }

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'radiant-widgets-category' ];
	}

	/**
	 * Get all case Custom Post Type Categories.
	 *
	 * @return array case categories.
	 */
	


	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Custom Cart', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'cart_icon_color',
			[
				'label'       => esc_html__( 'Choose Cart Icon Color', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-cart-bar .header-cart-bar-icon' => 'color: {{VALUE}}',
				],
				
			]
		);
		$this->add_control(
			'cart_counter_color',
			[
				'label' =>  esc_html__( 'Choose Cart Counter Color', 'radiantthemes-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .header-cart-bar .cart-count' => 'color: {{VALUE}}',
				],
			]
		);
		
		
		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	 
	
	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( ( class_exists( 'WooCommerce' ) ))  {
		echo '<div class="header-cart-bar">
								<a class="header-cart-bar-icon" href="'.  get_permalink( wc_get_page_id( 'cart' ) ) .'">
								<span class="ti-shopping-cart"></span>
									<span class="cart-count">'. $fragments  .'</span></a>
							</div>';
		
		
		 } 
	}
	 
	protected function _content_template() {

	}
}
