<?php
namespace RadiantthemesAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

/**
 * @since 1.1.0
 */
class Radiantthemes_Style_Blob extends Widget_Base {

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
		return 'radiant-blob';
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
		return __( 'Blob Box', 'radiantthemes-addons' );
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
		return 'eicon-inner-section';
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
	 * Get all team Custom Post Type Categories.
	 *
	 * @return array team categories.
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
				'label' => __( 'Content', 'radiantthemes-addons' ),
			]
		);

		$this->add_control(
			'blob_box_style',
			[
				'label'       => esc_html__( 'Select Style', 'radiantthemes-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::SELECT2,
				'options'     => [
					'one'   => esc_html__( 'Style One(Default Style)', 'radiantthemes-addons' ),
					
				],
				'default'     => 'one',
			]
		);
        
        
		$this->add_control(
			'blob_image1',
			[
				'label'     => __( 'Add Image one ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'blob_image2',
			[
				'label'     => __( 'Add Image Two ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'blob_image3',
			[
				'label'     => __( 'Add Image Three ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'blob_image7',
			[
				'label'     => __( 'Add Image Four ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
			$this->add_control(
			'blob_image5',
			[
				'label'     => __( 'Add Image Five ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'blob_image4',
			[
				'label'     => __( 'Add Image six ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
	
		$this->add_control(
			'blob_image6',
			[
				'label'     => __( 'Add Image Seven ', 'radiantthemes-addons' ),
				'type'      => Controls_Manager::MEDIA,
			]
		);
		
	    $this->add_control(
			'blob_image_link',
			[
				'label'       => __( 'Blob Image | Link', 'radiantthemes-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'input_type'  => 'url',
				'placeholder' => __( 'https://your-link.com', 'radiantthemes-addons' ),
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
    ?>
		
	<div class="rt_svg_div">
                <div class="vertical_anim1">
                    <?php echo wp_get_attachment_image( $settings['blob_image2']['id'], 'full' ); ?>
                </div>
                <div class="vertical_anim2">
                    <?php echo wp_get_attachment_image( $settings['blob_image1']['id'], 'full' ); ?>
                </div>
                <div class="vertical_anim3">
                   <?php echo wp_get_attachment_image( $settings['blob_image3']['id'], 'full' ); ?>
                </div>
                 <div class="radiantthemes_avatar4" style="width:62%;position: absolute;top:1px;
    left: -1px; z-index: 9999999;">
                    <a href="<?php echo $settings['blob_image_link'] ?>">
                         <?php echo wp_get_attachment_image( $settings['blob_image7']['id'], 'full' ); ?>
                    </a>
                </div>
                <div class="radiantthemes_avatar" style="width:50%;position: absolute; top: 34%; right:37%; z-index: 9999999;">
                    <a href="<?php echo $settings['blob_image_link'] ?>">
                        <?php echo wp_get_attachment_image( $settings['blob_image5']['id'], 'full' ); ?>
                    </a>
                </div>
                <div class="radiantthemes_avatar2" style="width:50%; position: absolute; top: 3%; left: 75%; z-index: 9999999;">
                    <a href="<?php echo $settings['blob_image_link'] ?>">
                         <?php echo wp_get_attachment_image( $settings['blob_image4']['id'], 'full' ); ?>
                    </a>
                </div>

                <div class="radiantthemes_avatar3" style="width:45%;position: absolute; top: 55%; right:5%; z-index: 9999999;">
                    <a href="<?php echo $settings['blob_image_link'] ?>">
                       <?php echo wp_get_attachment_image( $settings['blob_image6']['id'], 'full' ); ?>
                    </a>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-10 0 180 180">
                    <linearGradient id="PSgrad_0" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(239,239,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(239,239,225)" stop-opacity="1" />
                    </linearGradient>
                    <path fill="url(#PSgrad_0)" d="">

                        <animate repeatCount="indefinite" attributeName="d" dur="10s" values="&#10;M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1&#10;c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1&#10;c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7&#10;c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z;&#10;M163.7,95.5c0.2-2,0.3-4,0.3-4c0.5-7.2,1.2-15.6,0.3-24.7c-1.1-12-4.4-21.6-6.6-27.1c-2.4-5.8-4-9.7-7.1-13.8&#10;C138.2,9.3,113.4,3.8,95.3,8.2c-2.5,0.6-1.8,0.6-6.7,2c-16.3,4.5-23.5,3.9-32.3,6.3c0,0-12.6,3.5-23,12.9&#10;c-17.4,16-26.2,47.3-14.7,63.4c8.4,11.8,20.7,5.7,29,19.7c3.5,5.9,5.8,14.5,15.3,24.7c0,0,1.4,1.5,3,3c9.4,8.8,52.1,35.9,76.3,19.3 C158.7,148.2,161.3,120.5,163.7,95.5z;&#10;M161.5,95.7c-0.3-0.7-0.8-2.2-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1&#10;c-3.2-12.6-12.8-20.4-15.4-22.4c-15.7-12.3-37-11.6-51.3-5.5c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1&#10;C46,24,39.6,26,33.5,29.4C14,40.3-1,72.5,8.9,90.6c11.4,21,51.5,14.4,57.8,36.1c1.1,3.9,0.8,7.3,0.4,9.4c0.1,0.3,0.3,0.6,0.4,0.9&#10;c12.2,24.8,41.2,35.8,65.5,26.3C166.2,150.1,167.2,107.6,161.5,95.7z;&#10;M161.5,95.7c-0.6-1.5-1.2-2.9-1.9-4.3c-4.1-8.1-4.7-17.5-2.1-26.6c3.8-13.2,1.3-20.5,0.1-25.1&#10;c-3.2-12.6-12.8-20.4-15.4-22.4C126.5,5,105.2,5.7,90.9,11.8c-0.2,0.1-0.1,0-0.5,0.2c-12.2,5.3-25,9.3-38,11.1&#10;c-6.4,0.9-12.8,2.9-18.9,6.3C10.4,41.9-0.2,68.5,8.9,90.6c6,14.4,18.7,23.8,33.4,26.8c11.1,2.3,20.3,9,24.8,18.7&#10;c0.1,0.3,0.3,0.6,0.4,0.9c11.6,24,42.7,32.7,68.6,19C158.9,144,169.9,117.9,161.5,95.7z" />

                    </path>

                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="-10 10 200 200" style="position: absolute; top: 0; right: 0; width: 100%;
    height: 100%;">
                    <linearGradient id="PSgrad_1" x1="60.711%" x2="0%" y1="60.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(224,224,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(239,239,255)" stop-opacity="1" />
                    </linearGradient>
                    <path fill="url(#PSgrad_1)" d="">

                        <animate repeatCount="indefinite" attributeName="d" dur="15s" values="&#10;M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-5,5.3-10.5,11-15.9,19c-4.9,7.2-11.9,17.7-14.5,32.8&#10;c-1.4,8.1-3.6,21.1,3.3,34.2c7.9,14.9,22.7,20.5,30.2,23.3c14.7,5.5,27.3,4.4,36,3.5c17.8-1.8,30.5-8.1,37-11.4&#10;c14.4-7.4,22.8-15.7,24.8-17.7c7-7.1,16.6-16.8,15.4-29c-0.3-3.1-1.2-5.6-2-7.3c-3.8-7.8-12-10.7-19.7-21.8c-9.7-13.9,9-32.9,3-47.9&#10;c-2.7-6.7-8.7-10.3-10.8-11.8c-9.6-6.7-19.7-6.7-24-6.7C95.2,12.3,84.5,18.3,78.8,23.2z;&#10;M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-8.6,9-12.9,13.5-15.9,19c-7,12.9-6.5,25.7-6.2,32.6&#10;c0.3,7.5,0.7,18.7,8,30.7C40,148,50.8,153.8,55,156c6.4,3.3,23.5,12.3,35.7,5.3c9-5.2,5.4-13.5,14.3-20c13.1-9.5,26.7,4.6,42.3-4.7&#10;c9.8-5.8,16.7-18.6,15.4-29c-0.5-3.5-1.4-3.4-2-7.3c-1.8-12.1,7.2-17.3,9.3-28c3.1-16.1-11.2-35.8-25.9-41.7c-5-2-6.1-0.8-12.7-3.7&#10;c-13.5-5.8-13.6-12.6-22.1-14.8C98.4,9.4,86.4,16.7,78.8,23.2z;&#10;M82,8.3c-4.8,3-9.3,11.4-18.1,28.2c-5.2,9.9-5.8,12-10.2,19.5C47.4,66.7,44.3,72,40,76C27.5,87.6,16.6,81.5,8.7,89.7&#10;c-10.8,11.1-6.6,38.7,7,55c20,23.9,57.6,20,64,18.7c0.8-0.2,5.1-1.1,11-2c6.6-1,11.4-1.2,12.7-1.3c13.9-1.1,31.1-16,40.7-27.3&#10;c3.5-4.2,10.2-12.3,14.3-24.3c1.3-3.8,1-4.2,2.4-8c5.1-14.4,11.6-16.6,14-24c4.9-15.3-12.2-40-30.6-45.7c-5.1-1.5-7.5-0.8-12.7-3.7&#10;c-10.8-5.9-10-14.3-18.3-19.7C104.1,1.6,90.5,3,82,8.3z;&#10;M78.8,23.2c-3.5,3-8.7,7.6-14.9,13.3c-8.9,8.3-13.5,12.4-17.5,16.6c-5,5.3-10.5,11-15.9,19c-4.9,7.2-11.9,17.7-14.5,32.8&#10;c-1.4,8.1-3.6,21.1,3.3,34.2c7.9,14.9,22.7,20.5,30.2,23.3c14.7,5.5,27.3,4.4,36,3.5c17.8-1.8,30.5-8.1,37-11.4&#10;c14.4-7.4,22.8-15.7,24.8-17.7c7-7.1,16.6-16.8,15.4-29c-0.3-3.1-1.2-5.6-2-7.3c-3.8-7.8-12-10.7-19.7-21.8c-9.7-13.9,9-32.9,3-47.9&#10;c-2.7-6.7-8.7-10.3-10.8-11.8c-9.6-6.7-19.7-6.7-24-6.7C95.2,12.3,84.5,18.3,78.8,23.2z" />

                    </path>

                </svg>


            </div>
		
		<?php
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
