<?php
namespace WprAddons\Modules\ImageScroll\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Wpr_Image_Scroll extends Widget_Base {
		
	public function get_name() {
		return 'wpr-image-scroll';
	}

	public function get_title() {
		return esc_html__( 'Image Scroll', 'wpr-addons' );
	}

	public function get_icon() {
		return 'wpr-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'wpr-widgets'];
	}

	public function get_keywords() {
		return [ 'royal', 'image scroll' ];
	}

	public function has_widget_inner_wrapper(): bool {
		return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

    public function get_custom_help_url() {
    	if ( empty(get_option('wpr_wl_plugin_links')) )
        // return 'https://royal-elementor-addons.com/contact/?ref=rea-plugin-panel-image-scroll-help-btn';
    		return 'https://wordpress.org/support/plugin/royal-elementor-addons/';
    }

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {
        // Image Section
        $this->start_controls_section(
            'section_image_scroll',
            [
                'label' => esc_html__('Settings', 'wpr-addons'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'wpr-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'full',
            ]
        );

        $this->add_control(
            'scroll_direction',
            [
                'label' => esc_html__('Direction', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical' => esc_html__('Vertical', 'wpr-addons'),
                    'horizontal' => esc_html__('Horizontal', 'wpr-addons'),
                ],
                'render_type' => 'template',
                'prefix_class' => 'wpr-scroll-',
            ]
        );

        $this->add_control(
            'image_fit',
            [
                'label' => esc_html__('Image Fit', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => esc_html__('Cover', 'wpr-addons'),
                    'fill' => esc_html__('Contain', 'wpr-addons'),
                    'auto' => esc_html__('Auto', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap img' => 'object-fit: {{VALUE}};',
                ],
                'condition' => [
                    'scroll_direction' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => esc_html__('Image Position', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top left' => esc_html__('Top Left', 'wpr-addons'),
                    'top center' => esc_html__('Top Center', 'wpr-addons'),
                    'top right' => esc_html__('Top Right', 'wpr-addons'),
                    'center left' => esc_html__('Center Left', 'wpr-addons'),
                    'center center' => esc_html__('Center Center', 'wpr-addons'),
                    'center right' => esc_html__('Center Right', 'wpr-addons'),
                    'bottom left' => esc_html__('Bottom Left', 'wpr-addons'),
                    'bottom center' => esc_html__('Bottom Center', 'wpr-addons'),
                    'bottom right' => esc_html__('Bottom Right', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'scroll_direction' => 'horizontal',
                    'image_fit!' => 'auto',
                ],
            ]
        );

        // $this->end_controls_section();

        // // Advanced Settings
        // $this->start_controls_section(
        //     'section_advanced_settings',
        //     [
        //         'label' => esc_html__('Advanced Settings', 'wpr-addons'),
        //     ]
        // );

        $this->add_control(
            'reverse_direction',
            [
                'label' => esc_html__('Reverse Direction', 'wpr-addons'),
                'type' => Controls_Manager::SWITCHER,
                'render_type' => 'template',
                'separator' => 'before',
                'prefix_class' => 'wpr-direction-',
            ]
        );

        $this->add_control(
            'trigger_type',
            [
                'label' => esc_html__('Trigger', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'hover',
                'options' => [
                    'hover' => esc_html__('Hover', 'wpr-addons'),
                    'scroll' => esc_html__('Mouse Scroll', 'wpr-addons'),
                ],
                'prefix_class' => 'wpr-trigger-',
            ]
        );

        $this->add_control(
            'scroll_speed',
            [
                'label' => esc_html__('Animation Speed', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__('Height', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Width', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 3000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                    'vw' => [
                        'min' => 100,
                        'max' => 300,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-scroll-horizontal img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'scroll_direction' => 'horizontal',
                ],
            ]
        );

        $this->add_control(
            'enable_mask',
            [
                'label' => esc_html__('Enable Mask', 'wpr-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'mask_image',
            [
                'label' => esc_html__('Choose Mask Image', 'wpr-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}}); -webkit-mask-position: center center; mask-position: center center; -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat;',
                ],
                'condition' => [
                    'enable_mask' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'mask_size',
            [
                'label' => esc_html__('Mask Size', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'contain',
                'options' => [
                    'auto' => esc_html__('Auto', 'wpr-addons'),
                    'contain' => esc_html__('Contain', 'wpr-addons'),
                    'cover' => esc_html__('Cover', 'wpr-addons'),
                    'custom' => esc_html__('Custom', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                ],
                'condition' => [
                    'enable_mask' => 'yes',
                    'mask_image[url]!' => '',
                ],
            ]
        );

        $this->add_control(
            'mask_position',
            [
                'label' => esc_html__('Mask Position', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'center center' => esc_html__('Center Center', 'wpr-addons'),
                    'center left' => esc_html__('Center Left', 'wpr-addons'),
                    'center right' => esc_html__('Center Right', 'wpr-addons'),
                    'top center' => esc_html__('Top Center', 'wpr-addons'),
                    'top left' => esc_html__('Top Left', 'wpr-addons'),
                    'top right' => esc_html__('Top Right', 'wpr-addons'),
                    'bottom center' => esc_html__('Bottom Center', 'wpr-addons'),
                    'bottom left' => esc_html__('Bottom Left', 'wpr-addons'),
                    'bottom right' => esc_html__('Bottom Right', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                ],
                'condition' => [
                    'enable_mask' => 'yes',
                    'mask_image[url]!' => '',
                ],
            ]
        );

        $this->add_control(
            'mask_repeat',
            [
                'label' => esc_html__('Mask Repeat', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'no-repeat',
                'options' => [
                    'no-repeat' => esc_html__('No-repeat', 'wpr-addons'),
                    'repeat' => esc_html__('Repeat', 'wpr-addons'),
                    'repeat-x' => esc_html__('Repeat-x', 'wpr-addons'),
                    'repeat-y' => esc_html__('Repeat-y', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                ],
                'condition' => [
                    'enable_mask' => 'yes',
                    'mask_image[url]!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'mask_size_custom',
            [
                'label' => esc_html__('Custom Size', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_mask' => 'yes',
                    'mask_image[url]!' => '',
                    'mask_size' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'enable_wrapper_link',
            [
                'label' => esc_html__('Enable Wrapper Link', 'wpr-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_link',
            [
                'label' => esc_html__('Link', 'wpr-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'wpr-addons'),
                'condition' => [
                    'enable_wrapper_link' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_icon',
            [
                'label' => esc_html__('Icon', 'wpr-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Show Icon', 'wpr-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        
        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Select Icon', 'wpr-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-down',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );
        
        // Add icon style controls
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'wpr-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-icon' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .wpr-image-scroll-icon svg' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .wpr-image-scroll-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'icon_animation',
            [
                'label' => esc_html__('Animation', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => esc_html__('None', 'wpr-addons'),
                    'horizontal' => esc_html__('Horizontal', 'wpr-addons'),
                    'vertical' => esc_html__('Vertical', 'wpr-addons'),
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
                'prefix_class' => 'wpr-icon-animation-',
            ]
        );
        
        $this->add_control(
            'icon_animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'wpr-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 0.1,
                'max' => 10,
                'step' => 0.1,
                'condition' => [
                    'show_icon' => 'yes',
                    'icon_animation!' => 'none',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-icon' => 'animation-duration: {{VALUE}}s; animation-iteration-count: infinite; animation-timing-function: ease-in-out;',
                ],
            ]
        );

        $this->add_control(
            'heading_overlay',
            [
                'label' => esc_html__('Overlay', 'wpr-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_overlay',
            [
                'label' => esc_html__('Show Overlay', 'wpr-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label' => esc_html__('Transition Duration', 'wpr-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0.3,
                'min' => 0.1,
                'max' => 5,
                'step' => 0.1,
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => 'transition-duration: {{VALUE}}s;',
                    '{{WRAPPER}} .wpr-image-scroll-overlay' => 'transition-duration: {{VALUE}}s;',
                    '{{WRAPPER}} .wpr-image-scroll-overlay img' => 'transition-duration: {{VALUE}}s;',
                    '{{WRAPPER}} .wpr-image-scroll-icon' => 'transition-duration: {{VALUE}}s;',
                    '{{WRAPPER}} .wpr-image-scroll-icon-hidden' => 'transition-duration: {{VALUE}}s;'
                ],
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'transition_timing',
            [
                'label' => esc_html__('Transition Timing', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'ease',
                'options' => [
                    'linear' => esc_html__('Linear', 'wpr-addons'),
                    'ease' => esc_html__('Ease', 'wpr-addons'),
                    'ease-in' => esc_html__('Ease In', 'wpr-addons'),
                    'ease-out' => esc_html__('Ease Out', 'wpr-addons'),
                    'ease-in-out' => esc_html__('Ease In Out', 'wpr-addons'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .wpr-image-scroll-wrap img' => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .wpr-image-scroll-overlay' => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .wpr-image-scroll-icon' => 'transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .wpr-image-scroll-icon-hidden' => 'transition-timing-function: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Image', 'wpr-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('image_style_tabs');

        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => esc_html__('Normal', 'wpr-addons'),
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__('Opacity', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap img',
            ]
        );

        $this->add_control(
            'image_blend_mode',
            [
                'label' => esc_html__('Blend Mode', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Normal', 'wpr-addons'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hard-light' => 'Hard Light',
                    'soft-light' => 'Soft Light',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap img' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => esc_html__('Hover', 'wpr-addons'),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => esc_html__('Opacity', 'wpr-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0,
                        'step' => 0.01,
                    ],
                ],
                'default' => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap:hover img',
            ]
        );

        $this->add_control(
            'image_blend_mode_hover',
            [
                'label' => esc_html__('Blend Mode', 'wpr-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Normal', 'wpr-addons'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hard-light' => 'Hard Light',
                    'soft-light' => 'Soft Light',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap:hover img' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'heading_wrapper_style',
            [
                'label' => esc_html__('Wrapper', 'wpr-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->start_controls_tabs( 'tab_style' );

		$this->start_controls_tab(
			'tab_normal_style',
			[
				'label' => esc_html__( 'Normal', 'wpr-addons' )
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'wpr-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap',
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hover_style',
			[
				'label' => esc_html__( 'Hover', 'wpr-addons' )
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border_hover',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap:hover',
            ]
        );

        $this->add_responsive_control(
            'image_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'wpr-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow_hover',
                'selector' => '{{WRAPPER}} .wpr-image-scroll-wrap:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'heading_overlay_style',
            [
                'label' => esc_html__('Overlay', 'wpr-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('overlay_style_tabs');

        $this->start_controls_tab(
            'overlay_normal_tab',
            [
                'label' => esc_html__('Normal', 'wpr-addons'),
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Background Color', 'wpr-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-overlay' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'overlay_hover_tab',
            [
                'label' => esc_html__('Hover', 'wpr-addons'),
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_color_hover',
            [
                'label' => esc_html__('Background Color', 'wpr-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .wpr-image-scroll-wrap:hover .wpr-image-scroll-overlay' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();// Add after your existing controls in register_controls()

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        if (empty($settings['image']['url'])) {
            return;
        }
    
        $this->add_render_attribute('wrapper', 'class', [
            'wpr-image-scroll-wrap',
            'wpr-scroll-' . esc_attr($settings['scroll_direction']),
            'wpr-trigger-' . esc_attr($settings['trigger_type']),
            $settings['reverse_direction'] === 'yes' ? 'wpr-direction-reverse' : ''
        ]);
    
        $this->add_render_attribute('wrapper', 'data-speed', floatval($settings['scroll_speed']['size']));
    
        // Add link wrapper if enabled
        if ('yes' === $settings['enable_wrapper_link'] && !empty($settings['wrapper_link']['url'])) {
            $this->add_link_attributes('link', $settings['wrapper_link']);
            $this->add_render_attribute('link', 'class', 'wpr-image-scroll-link');
        }
        ?>
    
        <?php if ('yes' === $settings['enable_wrapper_link'] && !empty($settings['wrapper_link']['url'])) : ?>
            <a <?php echo $this->get_render_attribute_string('link'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by Elementor ?>>
        <?php endif; ?>
    
        <div <?php echo $this->get_render_attribute_string('wrapper'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by Elementor ?>>
            <?php 
            // Image is handled by Elementor's Group_Control_Image_Size which includes security measures
            echo Group_Control_Image_Size::get_attachment_image_html($settings); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by Elementor
            ?>
            
            <?php if ('yes' === $settings['show_overlay']) : ?>
                <div class="wpr-image-scroll-overlay"></div>
            <?php endif; ?>
        
            <?php if ('yes' === $settings['show_icon']) : ?>
                <div class="wpr-image-scroll-icon">
                    <?php 
                    // Icons are handled by Elementor's Icons_Manager which includes security measures
                    \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by Elementor
                    ?>
                </div>
            <?php endif; ?>
        </div>
    
        <?php if ('yes' === $settings['enable_wrapper_link'] && !empty($settings['wrapper_link']['url'])) : ?>
            </a>
        <?php endif;
    }

    protected function content_template() {
        ?>
        <# if ( settings.image.url ) {
            var image = {
                id: settings.image.id,
                url: settings.image.url,
                size: settings.image_size,
                dimension: settings.image_custom_dimension,
                model: view.getEditModel()
            };

            var image_url = elementor.imagesManager.getImageUrl( image );
            var reverseClass = settings.reverse_direction === 'yes' ? 'wpr-direction-reverse' : '';

            view.addRenderAttribute( 'wrapper', 'class', [
                'wpr-image-scroll-wrap',
                'wpr-scroll-' + settings.scroll_direction,
                'wpr-trigger-' + settings.trigger_type,
                reverseClass
            ]);

            view.addRenderAttribute( 'wrapper', 'data-speed', settings.scroll_speed.size );
        #>
            <div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
                <img src="{{ image_url }}" />
                
                <# if ( settings.show_icon == 'yes' ) { #>
                    <div class="wpr-image-scroll-icon">
                        <# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i', 'object' ); #>
                        {{{ iconHTML.value }}}
                    </div>
                <# } #>
                <# if ( settings.show_overlay == 'yes' ) { #>
                    <div class="wpr-image-scroll-overlay"></div>
                <# } #>
            </div>
        <# } #>
        <?php
    }
}