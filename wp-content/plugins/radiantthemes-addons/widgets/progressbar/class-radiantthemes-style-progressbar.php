<?php
/**
 * Separator Style Addon
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
 * Elementor Progressbar widget.
 *
 * Elementor widget that displays a Progressbar.
 *
 * @since 1.0.0
 */
class Radiantthemes_Style_Progressbar extends Widget_Base {

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
		return 'radiant-progressbar';
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
		return esc_html__( 'Progress Bar', 'radiantthemes-addons' );
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
		return 'eicon-skill-bar';
	}

	/**
	 * Requires css files.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return [
			'radiantthemes-all',
			'radiantthemes-addons-custom',
		];
	}

	/**
	 * Requires js files.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return [
			'radiantthemes-progressbar',
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
			'section_progressbar',
			[
				'label' => esc_html__( 'Progress Bar', 'radiantthemes-addons' ),
			]
		);
		$this->add_control(
			'progressbar_style',
			[
				'label'       => esc_html__( 'Progressbar Style', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'options'     => [
					'one' => esc_html__( 'Style One', 'radiantthemes-addons' ),
					'two' => esc_html__( 'Style Two', 'radiantthemes-addons' ),
				],
				'default'     => 'one',
			]
		);

		$this->add_control(
			'radiant_progressbar_title',
			[
				'label'       => esc_html__( 'Progressbar Title', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => 'This is progress bar element',
			]
		);

		$this->add_control(
			'radiant_progressbar_striped',
			[
				'label'        => esc_html__( 'Progressbar Striped', 'radiantthemes-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'True', 'radiantthemes-addons' ),
				'label_off'    => esc_html__( 'False', 'radiantthemes-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'radiant_progressbar_animated',
			[
				'label'        => esc_html__( 'Progressbar Animation', 'radiantthemes-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'True', 'radiantthemes-addons' ),
				'label_off'    => esc_html__( 'False', 'radiantthemes-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_progressbar',
			[
				'label' => esc_html__( 'Progress Bar', 'radiantthemes-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'radiant_progressbar_background_color',
			[
				'label'       => esc_html__( 'Background Color', 'radiantthemes-addons' ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .rt-progress-bar > .progress' => 'background-color: {{VALUE}}',
				],
				'default'     => '#000000',
				'description' => esc_html__( 'Set your Progressbar Background Color.', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'radiant_progressbar_color',
			[
				'label'       => esc_html__( 'Color', 'radiantthemes-addons' ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .rt-progress-bar .progress > .progress-bar' => 'background-color: {{VALUE}}',
				],
				'description' => esc_html__( 'Set your Progressbar Color.', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'radiant_progressbar_font_color',
			[
				'label'       => esc_html__( 'Font Color', 'radiantthemes-addons' ),
				'type'        => Controls_Manager::COLOR,
				'selectors'   => [
					'{{WRAPPER}} .rt-progress-bar > .title' => 'color: {{VALUE}}',
				],
				'description' => esc_html__( 'Set your Progressbar Font Color.', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'radiant_progressbar_height',
			[
				'label'       => esc_html__( 'Progressbar Height', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 15,
				],
				'description' => esc_html__( 'Enter measurement units.', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'radiant_progress_width',
			[
				'label'       => esc_html__( 'Progress Percentage', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ '%' ],
				'range'       => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'     => [
					'unit' => '%',
					'size' => 80,
				],
				'description' => esc_html__( 'Enter measurement units.', 'radiantthemes-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'radiant_title_typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar > .title',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
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

		if ( $settings['radiant_progressbar_striped'] ) {
			$striped = 'progress-bar-striped';
		} else {
			$striped = '';
		}

		if ( $settings['radiant_progressbar_animated'] ) {
			$animated = 'active';
		} else {
			$animated = '';
		}

		$output = '';
		if ( 'one' === $settings['progressbar_style'] ) {

			$output .= '<div class="rt-progress-bar element-one" data-progress-bar-width="' . esc_attr( $settings['radiant_progress_width']['size'] ) . esc_attr( $settings['radiant_progress_width']['unit'] ) . '" data-progress-bar-height="' . esc_attr( $settings['radiant_progressbar_height']['size'] ) . esc_attr( $settings['radiant_progressbar_height']['unit'] ) . '">';
			$output .= '<div class="title">' . esc_attr( $settings['radiant_progressbar_title'] );
			$output .= '<span class="progress-width"></span>';
			$output .= '</div>';
			$output .= '<div class="progress">';
			$output .= '<div class="progress-bar ' . esc_attr( $striped ) . ' ' . esc_attr( $animated ) . ' " ></div>';
			$output .= '</div>';
			$output .= '</div>';

		} elseif ( 'two' === $settings['progressbar_style'] ) {
			$output             .= '<div class="rt-progress-bar element-two">';
			$output             .= '<div class="skills">';
				$output         .= '<div class="skill-item">';
					$output     .= '<div class="skill-header">';
						$output .= '<h3 class="skill-title">' . esc_attr( $settings['radiant_progressbar_title'] ) . '</h3>';

						$output     .= '<div class="skill-percentage">';
							$output .= '<div class="count-box"><span class="count-text" data-speed="2000" data-stop="' . esc_attr( $settings['radiant_progress_width']['size'] ) . '">' . esc_attr( $settings['radiant_progress_width']['size'] ) . '</span>%</div>';
						$output     .= '</div>';
					$output         .= ' </div>';

					$output         .= ' <div class="skill-bar">';
						$output     .= '<div class="bar-inner" style="height:' . esc_attr( $settings['radiant_progressbar_height']['size'] ) . 'px;">';
							$output .= '<div class="bar progress-line" data-width="' . esc_attr( $settings['radiant_progress_width']['size'] ) . '" style="height: ' . esc_attr( $settings['radiant_progressbar_height']['size'] ) . 'px;"></div>';
						$output     .= '</div>';
					$output         .= ' </div>';
				$output             .= '</div>';
			$output                 .= '</div>';
			$output                 .= '</div>';

		}

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
