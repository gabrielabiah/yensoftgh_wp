<?php
/**
 * Header Nav Menu
 *
 * @package Radiantthemes
 */

namespace RadiantthemesAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Radiantthemes_Menu_Walker;

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
class Radiantthemes_Header_Custom_Menu extends Widget_Base {

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
		return 'radiant-header_custom_menu';
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
		return esc_html__( 'Header Custom Menu', 'radiantthemes-addons' );
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
		return 'eicon-nav-menu';
	}

	/**
	 * Requires css files.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array(
			'radiantthemes-addons-custom',
			'radiant-style-nav',
			'radiant-responsive-nav',
		);
	}

	/**
	 * Requires js files.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array(
			'radiantthemes-addons-custom',
			'rt-velocity',
			'rt-velocity-ui',
			'rt-vertical-menu',
		);
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
		return array( 'radiant-widgets-category' );
	}

	/**
	 * Get all case Custom Post Type Categories.
	 *
	 * @return array case categories.
	 */
	public function radiantthemes_navmenu_navbar_menu_choices() {
		$menus = wp_get_nav_menus();
		$items = array();
		$i     = 0;
		foreach ( $menus as $menu ) {
			if ( $i == 0 ) {
				$default = $menu->term_id;
				$i++;
			}
			$items[ $menu->term_id ] = $menu->name;
		}

		return $items;
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
			'section_content',
			array(
				'label' => esc_html__( 'Navigation', 'radiantthemes-addons' ),
			)
		);

		$this->add_control(
			'header_cus_nav_style',
			array(
				'label'       => esc_html__( 'Select Header Navigation Style', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'one'   => esc_html__( 'Style One', 'radiantthemes-addons' ),
					'two'   => esc_html__( 'Style Two', 'radiantthemes-addons' ),
					'three' => esc_html__( 'Style Three', 'radiantthemes-addons' ),
				),
				'default'     => 'one',
			)
		);

		$this->add_control(
			'header_cus_nav_menu',
			array(
				'label'       => esc_html__( 'Select Menu', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT,
				'options'     =>
				radiantthemes_navmenu_navbar_menu_choices(),
				'default'     => '',

			)
		);

		$this->add_control(
			'header_cus_menu_location',
			array(
				'label'       => esc_html__( 'Menu Location', 'radiantthemes-addons' ),
				'description' => esc_html__( 'Select a location for your menu. This option facilitate the ability to create up to 2 mobile enabled menu locations', 'radiantthemes-addons' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'primary'   => esc_html__( 'Primary', 'radiantthemes-addons' ),
					'secondary' => esc_html__( 'Secondary', 'radiantthemes-addons' ),
				),
				'default'     => 'primary',
				'condition'   => array(
					'header_cus_nav_style!' => 'three',
				),
			)
		);

		$this->add_control(
			'header_cus_menu_logo',
			array(
				'label'       => esc_html__( 'Upload Image', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::MEDIA,
				'condition'   => array(
					'header_cus_nav_style!' => 'one',
				),
			)
		);

		$this->add_control(
			'header_cus_menu_title',
			array(
				'label'       => esc_html__( 'Title', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'condition'   => array(
					'header_cus_nav_style!' => 'one',
				),
				'default'     => esc_html__( 'Responsive Multi-Purpose Theme', 'radiantthemes-addons' ),
			)
		);

		$this->add_control(
			'header_cus_menu_background_image',
			array(
				'label'       => esc_html__( 'Upload Background Image', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::MEDIA,
				'condition'   => array(
					'header_cus_nav_style!' => 'one',
				),
			)
		);

		$this->add_control(
			'header_cus_menu_toggle_icon_color',
			array(
				'label'     => esc_html__( 'Toggle Icon Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .rt-main-toggle-menu-trigger span:before, .rt-main-toggle-menu-trigger span:after, .rt-main-toggle-menu-trigger span, .rt-main-toggle-menu-open .rt-main-toggle-menu-trigger span:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style!' => 'one',
				),
			)
		);

		$this->add_control(
			'header_cus_menu_toggle_sticky_icon_color',
			array(
				'label'     => esc_html__( 'Toggle Icon Color on Sticky', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .rt-main-toggle-menu-trigger span.sticky-toggle-menu:before, .rt-main-toggle-menu-trigger span.sticky-toggle-menu:after, .rt-main-toggle-menu-trigger span.sticky-toggle-menu, .rt-main-toggle-menu-open .rt-main-toggle-menu-trigger span.sticky-toggle-menu:after' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style!' => 'one',
				),
			)
		);
		$this->add_responsive_control(
			'align_nav',
			[
				'label' => __( 'Alignment', 'radiantthemes-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'radiantthemes-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'radiantthemes-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'radiantthemes-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'radiantthemes-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .header_holder .wraper_header_main > nav' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'header_cus_parent_menu_color',
			array(
				'label'     => esc_html__( 'Parent Menu Link Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ul.rt-tree a' => 'color: {{VALUE}};',
				),
				'default'   => '#FFFFFF',
				'condition' => array(
					'header_cus_nav_style!' => 'three',
				),
			)
		);

		$this->add_control(
			'header_cus_second_child_menu_color',
			array(
				'label'     => esc_html__( 'Second Level Menu Link Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .rt-mobile-menu ul.rt-tree ul li a' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#FFFFFF',
				'condition' => array(
					'header_cus_nav_style!' => 'three',
				),
			)
		);

		$this->add_control(
			'header_cus_third_child_menu_color',
			array(
				'label'     => esc_html__( 'Third Level Menu Link Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .rt-mobile-menu ul.rt-tree ul li ul li a' => 'color: {{VALUE}} !important;',
				),
				'default'   => '#FFFFFF',
				'condition' => array(
					'header_cus_nav_style!' => 'three',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => esc_html__( 'Navbar/Toggle Alignment', 'radiantthemes-addons' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'prefix_class' => 'elementor%s-align-',
				'default'      => '',
				'condition'    => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'item_align',
			array(
				'label'     => esc_html__( 'Mobile Item Alignment', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-navigation ul li, .elementor-navigation ul ul li' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'text_padding',
			array(
				'label'      => esc_html__( 'Text Padding - Default 1em', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-navigation a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'submenu_content',
			array(
				'label'     => esc_html__( 'Submenu', 'radiantthemes-addons' ),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'submenu_align',
			array(
				'label'     => esc_html__( 'Item Alignment', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'radiantthemes-addons' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .elementor-navigation .sub-menu .menu-item a' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'sub_padding',
			array(
				'label'      => esc_html__( 'Item Padding', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-navigation .sub-menu .menu-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_style',
			array(
				'label'     => esc_html__( 'Navbar', 'radiantthemes-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'nav_bar_bg',
			array(
				'label'     => esc_html__( 'Navbar Background', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#00215e',
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'menu_link_color',
			array(
				'label'     => esc_html__( 'Main Menu Link Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .menu-item a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'menu_link_bg',
			array(
				'label'     => esc_html__( 'Main Menu Link Background', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#00215e',
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .menu-item a' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'menu_link_hover_color',
			array(
				'label'     => esc_html__( 'Main Menu Link Hover Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .menu-item a:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'link_hover_bg_color',
			array(
				'label'     => esc_html__( 'Main Menu Link Background Hover Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .menu-item a:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'menu_border',
				'label'     => esc_html__( 'Border', 'radiantthemes-addons' ),
				'default'   => '1px',
				'selector'  => '{{WRAPPER}} .elementor-nav-menu .menu-item a',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_responsive_control(
			'menu_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-nav-menu .menu-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'active_color',
			array(
				'label'     => esc_html__( 'Current/Active', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::SECTION,
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'menu_link_active_color',
			array(
				'label'     => esc_html__( 'Active Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .current-menu-item > a, .elementor-nav-menu .current_page_item > a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'link_active_bg_color',
			array(
				'label'     => esc_html__( 'Active Background', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .current-menu-item > a, .elementor-nav-menu .current_page_item > a' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'active_hover_color',
			array(
				'label'     => esc_html__( 'Active Link', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .current-menu-item > a:hover, .elementor-nav-menu .current_page_item > a:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'active_hover_bg_color',
			array(
				'label'     => esc_html__( 'Active Background', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .current-menu-item > a:hover, .elementor-nav-menu .current_page_item > a:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'active_border',
				'label'     => esc_html__( 'Border', 'radiantthemes-addons' ),
				'default'   => '1px',
				'selector'  => '{{WRAPPER}} .elementor-nav-menu .current-menu-item > a, .elementor-nav-menu .current_page_item > a',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'active_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-nav-menu .current-menu-item > a, .elementor-nav-menu .current_page_item > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'submenu_color',
			array(
				'label'     => esc_html__( 'Submenu', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::SECTION,
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'submenu_link_color',
			array(
				'label'     => esc_html__( 'Submenu Links', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'submenu_link_bg',
			array(
				'label'     => esc_html__( 'Submenu Background', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#00215e',
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'submenu_link_hover',
			array(
				'label'     => esc_html__( 'Submenu Link Hover', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a:hover, {{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item .sub-menu .menu-item a:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'submenu_hover_bg_color',
			array(
				'label'     => esc_html__( 'Submenu Hover BG', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'submenu_border',
				'label'     => esc_html__( 'Border', 'radiantthemes-addons' ),
				'default'   => '1px',
				'selector'  => '{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'submenu_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-nav-menu .sub-menu .menu-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_toggle',
			array(
				'label'     => esc_html__( 'Mobile Toggle', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::SECTION,
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .elementor-menu-toggle >span.ti-menu' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '#333333',
				'selectors' => array(
					'{{WRAPPER}} .elementor-menu-toggle' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_icon_hover',
			array(
				'label'     => esc_html__( 'Icon Hover', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-menu-toggle:hover i.fa.fa-navicon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_bg_hover',
			array(
				'label'     => esc_html__( 'Background Hover', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-menu-toggle:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_text_padding',
			array(
				'label'      => esc_html__( 'Text Padding - Default 1em', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-menu-toggle i.fa.fa-navicon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'toggle_border',
				'label'     => esc_html__( 'Border', 'radiantthemes-addons' ),
				'default'   => '1px',
				'selector'  => '{{WRAPPER}} .elementor-menu-toggle',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->add_control(
			'toggle_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'radiantthemes-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-menu-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'menu_typography',
			array(
				'label'     => esc_html__( 'Typography', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::SECTION,
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header_cus_nav_style!' => 'two',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_typography',
				'label'     => esc_html__( 'Typography', 'radiantthemes-addons' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .elementor-nav-menu .menu-item',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'sub_menu_typography',
				'label'     => esc_html__( 'Submenu Typography', 'radiantthemes-addons' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'selector'  => '{{WRAPPER}} .header_holder .wraper_header_main > nav ul.elementor-nav-menu > li > ul > li > a,
				.header_holder .wraper_header_main > nav ul.elementor-nav-menu > li > ul > li > ul > li > a,
				.header_holder .wraper_header_main > nav ul.elementor-nav-menu > li > ul > li > ul > li > ul > li > a,
				.header_holder .wraper_header_main > nav ul.elementor-nav-menu > li > ul > li > ul > li > ul > li ul li a,
				.header_holder .wraper_header_main > nav ul.elementor-nav-menu > li > ul > li > ul > li > ul > li ul li > ul > li > a',
				'condition' => array(
					'header_cus_nav_style' => 'one',
				),
			)
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
		$settings      = $this->get_settings_for_display();
		$menu_location = $settings['header_cus_menu_location'];
		// Get menu.
		$nav_menu = ! empty( $settings['header_cus_nav_menu'] ) ? wp_get_nav_menu_object( $settings['header_cus_nav_menu'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_class'     => 'elementor-nav-menu',
			'theme_location' => 'default_navmenu', // creating a fake location for better functional control.
			'menu'           => $nav_menu,
			'echo'           => true,
			'depth'          => 0,
			'walker'         => new Radiantthemes_Menu_Walker(),

		);

		if ( 'one' === $settings['header_cus_nav_style'] ) {
			echo '<div class="header_holder">';
			?>
				<button class="elementor-menu-toggle  hidden-lg hidden-md visible-sm visible-xs"><span class="ti-menu"></span></button>
				<div class="wraper_header_main">
					<nav itemscope="itemscope" class="elementor-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Elementor Menu', 'navmenu-addon-for-elementor' ); ?>">
							<?php
							wp_nav_menu(
								apply_filters(
									'widget_nav_menu_args',
									$nav_menu_args,
									$nav_menu,
									$settings
								)
							);
							?>
					</nav>
				</div>
			</div>
			<?php
		} elseif ( 'two' === $settings['header_cus_nav_style'] ) {
				$nav_menu_args_two = array(
					'fallback_cb'    => false,
					'container'      => false,
					'menu_class'     => 'rt-tree',
					'menu_id'        => 'main-menu',
					'theme_location' => 'default_navmenu', // creating a fake location for better functional control.
					'menu'           => $nav_menu,
					'echo'           => true,
					'depth'          => 0,
				);

				$css = '@media only screen and (max-width: 767px) { .main-header {display: block;} } @media only screen and (min-width: 768px) and (max-width: 1024px) { .main-header {display: block;} } .rt-mobile-menu ul.rt-tree ul > li ul li a { color: green; }';
				wp_register_style( 'radiant-side-panel-right-menu', false );
				wp_enqueue_style( 'radiant-side-panel-right-menu' );
				wp_add_inline_style( 'radiant-side-panel-right-menu', $css );

				?>
				<nav id="rt-main-toggle-menu" class="rt-main-toggle-menu rt-main-toggle-menu-close">
					<span class="rt-main-toggle-menu-trigger"><span>Menu</span></span>
				</nav>
				<div class="rt-menu-wrap">
					<div class="rt-mobile-menu-toggle">
						<div class="rt-menu-overlay">
							<div class="rt-menu-background-image">
								<?php echo wp_get_attachment_image( $settings['header_cus_menu_background_image']['id'], 'full' ); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="rt-mobile-menu">
					<div class="rt-dashboard-columns">
						<nav>
							<?php
							wp_nav_menu(
								apply_filters(
									'widget_nav_menu_args',
									$nav_menu_args_two,
									$nav_menu,
									$settings
								)
							);
							?>
						</nav>
						<div class="cleafix"></div>
						<div class="rt-menu-btm-area">
							<?php if ( $settings['header_cus_menu_logo']['id'] ) : ?>
								<div class="rt-menu-logo">
									<?php echo wp_get_attachment_image( $settings['header_cus_menu_logo']['id'], 'full' ); ?>
								</div>
							<?php endif; ?>
							<?php if ( $settings['header_cus_menu_title'] ) : ?>
								<div class="rt-menu-text">
									<?php echo esc_html( $settings['header_cus_menu_title'] ); ?>
								</div>
							<?php endif; ?>
							<div class="rt-social-link">
								<ul>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-googleplus', '', false ) ) ) : ?>
										<li><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-googleplus', '', false ) ); ?>" ><i class="fa fa-google-plus"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-facebook', '', false ) ) ) : ?>
										<li><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-facebook', '', false ) ); ?>"><i class="fa fa-facebook"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-twitter', '', false ) ) ) : ?>
										<li class="twitter"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-twitter', '', false ) ); ?>"><i class="fa fa-twitter"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-vimeo', '', false ) ) ) : ?>
										<li class="vimeo"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-vimeo', '', false ) ); ?>"><i class="fa fa-vimeo"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-youtube', '', false ) ) ) : ?>
										<li class="youtube"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-youtube', '', false ) ); ?>"><i class="fa fa-youtube-play"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-flickr', '', false ) ) ) : ?>
										<li class="flickr"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-flickr', '', false ) ); ?>"><i class="fa fa-flickr"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-linkedin', '', false ) ) ) : ?>
										<li class="linkedin"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-linkedin', '', false ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-pinterest', '', false ) ) ) : ?>
										<li class="pinterest"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-pinterest', '', false ) ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-xing', '', false ) ) ) : ?>
										<li class="xing"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-xing', '', false ) ); ?>"><i class="fa fa-xing"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-viadeo', '', false ) ) ) : ?>
										<li class="viadeo"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-viadeo', '', false ) ); ?>"><i class="fa fa-viadeo"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-vkontakte', '', false ) ) ) : ?>
										<li class="vkontakte"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-vkontakte', '', false ) ); ?>"><i class="fa fa-vk"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-tripadvisor', '', false ) ) ) : ?>
										<li class="tripadvisor"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-tripadvisor', '', false ) ); ?>"><i class="fa fa-tripadvisor"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-tumblr', '', false ) ) ) : ?>
										<li class="tumblr"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-tumblr', '', false ) ); ?>"><i class="fa fa-tumblr"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-behance', '', false ) ) ) : ?>
										<li class="behance"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-behance', '', false ) ); ?>"><i class="fa fa-behance"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-instagram', '', false ) ) ) : ?>
										<li class="instagram"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-instagram', '', false ) ); ?>"><i class="fa fa-instagram"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-dribbble', '', false ) ) ) : ?>
										<li class="dribbble"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-dribbble', '', false ) ); ?>"><i class="fa fa-dribbble"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-skype', '', false ) ) ) : ?>
										<li class="skype"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-skype', '', false ) ); ?>"><i class="fa fa-skype"></i></a></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?php
		} elseif ( 'three' === $settings['header_cus_nav_style'] ) {
			?>
		 <div class="rt-menu-wrapper-style-three">
			<nav id="rt-main-toggle-menu" class="rt-main-toggle-menu rt-main-toggle-menu-close">
					<span class="rt-main-toggle-menu-trigger"><span>Menu</span></span>
				</nav>
				<div class="rt-menu-wrap">
					<div class="rt-mobile-menu-toggle">
						<div class="rt-menu-overlay">
							<div class="rt-menu-background-image">

							</div>
						</div>
					</div>
				</div>
				<div class="rt-mobile-menu">
<div class="rt-dashboard-columns" style="background: url('<?php echo wp_get_attachment_image_url( $settings['header_cus_menu_background_image']['id'], 'full' ); ?>') bottom right no-repeat #fff;">
			<div class="rt-mobile-menu-logo-sec">
			<?php if ( $settings['header_cus_menu_logo']['id'] ) : ?>
			<div class="rt-menu-logo">
				<?php echo wp_get_attachment_image( $settings['header_cus_menu_logo']['id'], 'full' ); ?>
			</div>
			<?php endif; ?>
			<?php if ( $settings['header_cus_menu_title'] ) : ?>
			<div class="rt-menu-text">
				<?php echo esc_html( $settings['header_cus_menu_title'] ); ?>
			</div>
			<?php endif; ?>
			</div>
						<?php dynamic_sidebar( 'radiantthemes-hamburger-sidebar' ); ?>
						<div class="cleafix"></div>
						<div class="rt-menu-btm-area">

							<div class="rt-social-link">
								<ul>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-googleplus', '', false ) ) ) : ?>
										<li><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-googleplus', '', false ) ); ?>" ><i class="fa fa-google-plus"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-facebook', '', false ) ) ) : ?>
										<li><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-facebook', '', false ) ); ?>"><i class="fa fa-facebook"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-twitter', '', false ) ) ) : ?>
										<li class="twitter"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-twitter', '', false ) ); ?>"><i class="fa fa-twitter"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-vimeo', '', false ) ) ) : ?>
										<li class="vimeo"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-vimeo', '', false ) ); ?>"><i class="fa fa-vimeo"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-youtube', '', false ) ) ) : ?>
										<li class="youtube"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-youtube', '', false ) ); ?>"><i class="fa fa-youtube-play"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-flickr', '', false ) ) ) : ?>
										<li class="flickr"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-flickr', '', false ) ); ?>"><i class="fa fa-flickr"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-linkedin', '', false ) ) ) : ?>
										<li class="linkedin"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-linkedin', '', false ) ); ?>"><i class="fa fa-linkedin"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-pinterest', '', false ) ) ) : ?>
										<li class="pinterest"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-pinterest', '', false ) ); ?>"><i class="fa fa-pinterest-p"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-xing', '', false ) ) ) : ?>
										<li class="xing"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-xing', '', false ) ); ?>"><i class="fa fa-xing"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-viadeo', '', false ) ) ) : ?>
										<li class="viadeo"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-viadeo', '', false ) ); ?>"><i class="fa fa-viadeo"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-vkontakte', '', false ) ) ) : ?>
										<li class="vkontakte"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-vkontakte', '', false ) ); ?>"><i class="fa fa-vk"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-tripadvisor', '', false ) ) ) : ?>
										<li class="tripadvisor"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-tripadvisor', '', false ) ); ?>"><i class="fa fa-tripadvisor"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-tumblr', '', false ) ) ) : ?>
										<li class="tumblr"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-tumblr', '', false ) ); ?>"><i class="fa fa-tumblr"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-behance', '', false ) ) ) : ?>
										<li class="behance"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-behance', '', false ) ); ?>"><i class="fa fa-behance"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-instagram', '', false ) ) ) : ?>
										<li class="instagram"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-instagram', '', false ) ); ?>"><i class="fa fa-instagram"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-dribbble', '', false ) ) ) : ?>
										<li class="dribbble"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-dribbble', '', false ) ); ?>"><i class="fa fa-dribbble"></i></a></li>
									<?php endif; ?>
									<?php if ( ! empty( radiantthemes_global_var( 'social-icon-skype', '', false ) ) ) : ?>
										<li class="skype"><a href="<?php echo esc_url( radiantthemes_global_var( 'social-icon-skype', '', false ) ); ?>"><i class="fa fa-skype"></i></a></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				</div>
			<?php
		}
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
