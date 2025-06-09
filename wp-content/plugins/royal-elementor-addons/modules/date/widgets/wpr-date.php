<?php

namespace WprAddons\Modules\Date\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WPR_Date extends Widget_Base {

    public function get_name() {
        return 'wpr-date';
    }

    public function get_title() {
        return __( 'Date', 'wpr-addons' );
    }

    public function get_icon() {
        return 'wpr-icon eicon-calendar';
    }

	public function get_categories() {
		return [ 'wpr-widgets'];
	}

	public function get_keywords() {
		return [ 'royal', 'date time' ];
	}

	public function has_widget_inner_wrapper(): bool {
		return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'General', 'wpr-addons' ),
            ]
        );

		$this->add_control(
			'date_format',
			[
				'label' => esc_html__( 'Date Format', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'wpr-addons' ),
					'' => esc_html__( 'None', 'wpr-addons' ),
					'Y' => gmdate( 'Y' ),
					'F j, Y' => gmdate( 'F j, Y' ),
					'Y-m-d' => gmdate( 'Y-m-d' ),
					'Y, M, D' => gmdate( 'Y, M, D' ),
					'm/d/Y' => gmdate( 'm/d/Y' ),
					'd/m/Y' => gmdate( 'd/m/Y' ),
					'j. F Y' => gmdate( 'j. F Y' ),
                    'l, F j, Y' => gmdate( 'l, F j, Y' )
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'time_format',
			[
				'label' => esc_html__( 'Time Format', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'wpr-addons' ),
					'' => esc_html__( 'None', 'wpr-addons' ),
					'g:i a' => gmdate( 'g:i a' ),
					'g:i A' => gmdate( 'g:i A' ),
					'H:i' => gmdate( 'H:i' ),
				],
				'default' => 'default',
			]
		);

        $this->add_control(
            'extra_text_before',
            [
                'label' => esc_html__( 'Extra Text (Before)', 'wpr-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Before Text - ', 'wpr-addons' ),
            ]
        );

        $this->add_control(
            'extra_text_after',
            [
                'label' => esc_html__( 'Extra Text (After)', 'wpr-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( ' - After Text', 'wpr-addons' ),
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Text Alignment', 'wpr-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wpr-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wpr-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wpr-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpr-date' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Start Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'wpr-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Date Color', 'wpr-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'extra_text_color',
            [
                'label' => __( 'Extra Text Color', 'wpr-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .wpr-date .wpr-extra-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .wpr-date',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $date_format = $settings['date_format'];
        $time_format = $settings['time_format'];
        $extra_text_before = $settings['extra_text_before'];
        $extra_text_after = $settings['extra_text_after'];
        $format = '';


        if ( 'default' === $date_format ) {
            $date_format = get_option( 'date_format' );
        }

        if ( 'default' === $time_format ) {
            $time_format = get_option( 'time_format' );
        }

        if ( $date_format ) {
            $format = $date_format;
            $has_date = true;
        } else {
            $has_date = false;
        }

        if ( $time_format ) {
            if ( $has_date ) {
                $format .= ' ';
            }
            $format .= $time_format;
        }
        
		$value = date_i18n( $format );

        // Build output with extra text before/after
        $output = '<div class="wpr-date">';
        if (!empty($extra_text_before)) {
            $output .= '<span class="wpr-extra-text">'. $extra_text_before .'</span>';
        }
        $output .= $value;
        if (!empty($extra_text_after)) {
            $output .= '<span class="wpr-extra-text">'. $extra_text_after .'</span>';
        }
        $output .= '</div>';

		echo wp_kses_post( $output );
    }
}
