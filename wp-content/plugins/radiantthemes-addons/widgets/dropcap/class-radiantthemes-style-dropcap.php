<?php
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
 * @since 1.1.0
 */
class Radiantthemes_Style_Dropcap extends Widget_Base {

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
		return 'radiant-dropcap';
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
		return esc_html__( 'Dropcap', 'radiantthemes-addons' );
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
		return 'eicon-product-title';
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
			'general_section',
			[
				'label' => __( 'General', 'radiantthemes-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'dropcap_style',
			[
				'label'       => esc_html__( 'Dropcap Style', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'options'     => [
					'one'   => esc_html__( 'Style One (Basic)', 'radiantthemes-addons' ),
					'two'   => esc_html__( 'Style Two (Bordered)', 'radiantthemes-addons' ),
					'three' => esc_html__( 'Style Three (Solid)', 'radiantthemes-addons' ),
					'four' => esc_html__( 'Style Four (Top-Left Bordered)', 'radiantthemes-addons' ),
					'five' => esc_html__( 'Style Five (Bottom-Right Bordered)', 'radiantthemes-addons' ),
					'six' => esc_html__( 'Style Six (Bordered Rounded)', 'radiantthemes-addons' ),
					'seven' => esc_html__( 'Style Seven (Solid Rounded)', 'radiantthemes-addons' ),
					'eight' => esc_html__( 'Style Eight (Solid Circle)', 'radiantthemes-addons' ),
					'nine' => esc_html__( 'Style Nine (Solid Circle - Dark)', 'radiantthemes-addons' ),
				],
				'default'     => 'one',
			]
		);
		$this->add_control(
			'dropcap_letter',
			[
				'label'       => esc_html__( 'Dropcap Letter', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'R', 'radiantthemes-addons' ),
				
			]
		);
		$this->add_control(
			'dropcap_content',
			[
				'label'       => esc_html__( 'Content', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Hola! I am content of dropcap element.', 'radiantthemes-addons' ),
				
			]
		);
		$this->add_control(
			'dropcap_color',
			[
				'label' => __( 'Color Scheme', 'radiantthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'dropcap_content_color',
			[
				'label' => __( 'Content Color', 'radiantthemes-addons' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'dropcap_extra_id',
			[
				'label'       => esc_html__( 'Element ID', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				
			]
		);
		$this->add_control(
			'dropcap_extra_class',
			[
				'label'       => esc_html__( 'Extra class name for the container', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				
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

		$settings         = $this->get_settings_for_display();
		// ADD RADIANTTHEMES MAIN CSS.
			wp_register_style(
				'radiantthemes-addons-custom',
				plugins_url( 'css/radiantthemes-addons-custom.css', __FILE__ ),
				array(),
				time()
			);
			wp_enqueue_style( 'radiantthemes-addons-custom' );

		// GENERATE RANDOM CLASS.
			$random_class = 'rt' . rand();

			// ADD ID.
			$dropcaps_id = $settings['dropcap_extra_id'] ? 'id="' . $settings['dropcap_extra_id'] . '"' : '';
			
			
			// MAIN LAYOUT.
			$output  = '<div class="radiantthemes-dropcaps element-' . $settings['dropcap_style'] . ' ' . $settings['dropcap_extra_class'] . '"  ' . $dropcaps_id . '>';
            $output  .= '<div class="holder" style="color:' . $settings['dropcap_content_color'] . ';">';
            if ( "one" == $settings['dropcap_style'] ) {
                $output  .= '<div class="radiantthemes-dropcap-letter">';
            } elseif ( "two" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter" style="border-color:' . $settings['dropcap_color'] . ';">';
            } elseif ( "three" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter" style="background-color:' . $settings['dropcap_color'] . ';">';
            } elseif ( "four" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter">';
            } elseif ( "five" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter">';
            } elseif ( "six" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter">';
            } elseif ( "seven" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter" style="background-color:' . $settings['dropcap_color'] . ';">';
            } elseif ( "eight" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter" style="background-color:' . $settings['dropcap_color'] . ';">';
            } elseif ( "nine" == $settings['dropcap_style'] ){
                $output  .= '<div class="radiantthemes-dropcap-letter">';
            }
            $output  .= esc_html( $settings['dropcap_letter'] );
            $output  .= '</div>';
            $output  .= esc_html( $settings['dropcap_content'] );
            $output  .= '</div>';
			$output  .= '</div>' . "\r";
			$output  .= '<!-- dropcap -->' . "\r";
			echo $output;

		


	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _content_template() {

	}
}
