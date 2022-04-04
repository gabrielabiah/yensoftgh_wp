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
class Radiantthemes_style_Custom_Logo extends Widget_Base {

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
		return 'radiant-custom-logo';
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
		return esc_html__( 'Custom Logo', 'radiantthemes-addons' );
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
		return 'eicon-site-logo';
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
				'label' => esc_html__( 'Custom Logo', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label'       => esc_html__( 'Choose Image', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::MEDIA,
				
			]
		);
		$this->add_control(
			'logo_dimension',
			[
				'label' =>  esc_html__( 'Image Dimension', 'radiantthemes-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::IMAGE_DIMENSIONS,
				'description' => esc_html__( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'radiantthemes-addons' ),
				'default' => [
					'width' => '200',
					'height' => '200',
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
		if($settings['logo_image']['url']!='' && $settings['logo_dimension']['width']!='' && $settings['logo_dimension']['height']!='' )
		{
	       echo '<a href="'. esc_url( home_url( ) ) .'"><img src="' . $settings['logo_image']['url'] . '" alt="logo" width="' . $settings['logo_dimension']['width'] . '" height="' . $settings['logo_dimension']['height'] . '"></a>';
		}elseif($settings['logo_image']['url']!='' && $settings['logo_dimension']['width']!='' ){
		echo '<a href="'. esc_url( home_url( ) ) .'"><img src="' . $settings['logo_image']['url'] . '" alt="logo" width="' . $settings['logo_dimension']['width'] . '"></a>';
		}elseif($settings['logo_image']['url']!=''  && $settings['logo_dimension']['height']!=''){
		echo '<a href="'. esc_url( home_url( ) ) .'"><img src="' . $settings['logo_image']['url'] . '" alt="logo"  height="' . $settings['logo_dimension']['height'] . '"></a>';
		}elseif($settings['logo_image']['url']!=''){
		echo '<a href="'. esc_url( home_url( ) ) .'"><img src="' . $settings['logo_image']['url'] . '" alt="logo"></a>';
	
		}else {
		 echo '<a href="'. esc_url( home_url( ) ) .'"><p class="site-title">'.esc_html( get_bloginfo( 'name' ) ).'</p></a>';	
			
		}
		
		
	}
	 
	protected function _content_template() {

	}
}
