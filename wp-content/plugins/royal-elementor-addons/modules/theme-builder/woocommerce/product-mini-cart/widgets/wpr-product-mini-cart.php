<?php
namespace WprAddons\Modules\ThemeBuilder\Woocommerce\ProductMiniCart\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Wpr_Product_Mini_Cart extends Widget_Base {
	
	public function get_name() {
		return 'wpr-product-mini-cart';
	}

	public function get_title() {
		return esc_html__( 'Product Mini Cart', 'wpr-addons' );
	}

	public function get_icon() {
		return 'wpr-icon eicon-product-images';
	}

	public function get_categories() {
		return Utilities::show_theme_buider_widget_on('product_single') ? [] : ['wpr-woocommerce-builder-widgets'];
	}

	public function get_keywords() {
		return [ 'woocommerce', 'product-ini-cart', 'product', 'mini', 'cart' ];
	}

	public function has_widget_inner_wrapper(): bool {
		return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

	public function get_script_depends() {
		return ['wpr-perfect-scroll-js'];
	}

	public function add_control_mini_cart_style() {
		$this->add_control(
			'mini_cart_style',
			[
				'label' => esc_html__( 'Cart Content', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'render_type' => 'template',
				'options' => [
					'none' => esc_html__( 'None', 'wpr-addons' ),
					'pro-dd' => esc_html__( 'Dropdown (Pro)', 'wpr-addons' ),
					'pro-sb' => esc_html__( 'Sidebar (Pro)', 'wpr-addons' )
				],
				'default' => 'none'
			]
		); 
	}

    public function get_custom_help_url() {
        if ( empty(get_option('wpr_wl_plugin_links')) )
        // return 'https://royal-elementor-addons.com/contact/?ref=rea-plugin-panel-progress-bar-help-btn';
            return 'https://wordpress.org/support/plugin/royal-elementor-addons/';
    }

	public function is_reload_preview_required() {
		return true;
	}

	public function add_controls_group_mini_cart_style() {}

	public function add_section_style_mini_cart() {}

	public function add_section_style_remove_icon() {}

	public function add_section_style_buttons() {}

	protected function register_controls() {

		// Tab: Content ==============
		// Section: General ----------
		$this->start_controls_section(
			'section_mini_cart_general',
			[
				'label' => esc_html__( 'General', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Select Icon', 'wpr-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'wpr-addons' ),
                    'cart-light' => esc_html__( 'Cart Light', 'wpr-addons' ),
                    'cart-medium' => esc_html__( 'Cart Medium', 'wpr-addons' ),
                    'cart-solid' => esc_html__( 'Cart Solid', 'wpr-addons' ),
                    'basket-light' => esc_html__( 'Basket Light', 'wpr-addons' ),
                    'basket-medium' => esc_html__( 'Basket Medium', 'wpr-addons' ),
                    'basket-solid' => esc_html__( 'Basket Solid', 'wpr-addons' ),
                    'bag-light' => esc_html__( 'Bag Light', 'wpr-addons' ),
                    'bag-medium' => esc_html__( 'Bag Medium', 'wpr-addons' ),
                    'bag-solid' => esc_html__( 'Bag Solid', 'wpr-addons' )
                ],
                'render_type' => 'template',
                'default' => 'cart-medium',
                'prefix_class' => 'wpr-toggle-icon-',
            ]
        );

		$this->add_control(
			'toggle_text',
			[
				'label' => esc_html__( 'Toggle Prefix', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'wpr-addons' ),
					'price' => esc_html__( 'Total Price', 'wpr-addons' ),
					'title' => esc_html__( 'Extra Text', 'wpr-addons' )
				],
				'default' => 'price',
			]
		);

		$this->add_control(
			'toggle_title',
			[
				'label' => esc_html__( 'Text', 'wpr-addons' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Cart', 'wpr-addons' ),
				'default' => esc_html__( 'Cart', 'wpr-addons' ),
				'condition' => [
					'toggle_text' => 'title'
				]
			]
		);

		$this->add_responsive_control(
			'mini_cart_button_alignment',
			[
				'label' => esc_html__( 'Alignment', 'wpr-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'right',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Start', 'wpr-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'wpr-addons' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'End', 'wpr-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-wrap' => 'text-align: {{VALUE}};',
				]
			]
		);

		$this->add_control_mini_cart_style(); 

		$this->add_controls_group_mini_cart_style();

		// Upgrade to Pro Notice
		Utilities::upgrade_pro_notice( $this, Controls_Manager::RAW_HTML, 'product-mini-cart', 'mini_cart_style', ['pro-dd', 'pro-sb'] );

		$this->end_controls_section();

		// Section: Request New Feature
		Utilities::wpr_add_section_request_feature( $this, Controls_Manager::RAW_HTML, '' );

		// Section: Pro Features
		Utilities::pro_features_list_section( $this, '', Controls_Manager::RAW_HTML, 'product-mini-cart', [
			'Show Mini Cart Content (Products added to cart) on Mini Cart icon click',
			'Display Mini Cart Content as Dropdown or Off-Canvas Layout'
		] );
		
		// Tab: Styles ==============
		// Section: Toggle Button ----------
		$this->start_controls_section(
			'section_mini_cart_button',
			[
				'label' => esc_html__( 'Cart Button', 'wpr-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'toggle_btn_cart_icon',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'wpr-addons' ),
			]
		);

		$this->add_control(
			'toggle_btn_icon_color',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-btn-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpr-mini-cart-btn-icon svg' => 'fill: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'toggle_btn_icon_color_hover',
			[
				'label'  => esc_html__( 'Color (Hover)', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-btn-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpr-mini-cart-btn-icon:hover svg' => 'fill: {{VALUE}}'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_btn_icon_size',
			[
				'label' => esc_html__( 'Size', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpr-mini-cart-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'toggle_btn_cart_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Extra Text', 'wpr-addons' ),
				'separator' => 'before',
				'condition' => [
					'toggle_text!' => 'none'
				]
			]
		);

		$this->add_control(
			'mini_cart_color',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#777777',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'color: {{VALUE}}',
				],
				'condition' => [
					'toggle_text!' => 'none'
				]
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'wpr-addons' ),
                'selector' => '{{WRAPPER}} .wpr-mini-cart-toggle-btn, {{WRAPPER}} .wpr-mini-cart-icon-count',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_size' => [
						'default' => [
							'size' => '13',
							'unit' => 'px',
						]
                    ],
                    'font_style' => [
                        'default' => 'normal'
                    ]
				]
            ]
        );

		$this->add_responsive_control(
			'toggle_text_distance',
			[
				'label' => esc_html__( 'Distance', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'default' => [
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-btn-text' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpr-mini-cart-btn-price' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
				'condition' => [
					'toggle_text!' => 'none'
				]
			]
		);

		$this->add_control(
			'mini_cart_btn_bg_color',
			[
				'label'  => esc_html__( 'Background Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'background-color: {{VALUE}}',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'mini_cart_btn_border_color',
			[
				'label'  => esc_html__( 'Border Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#E8E8E8',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'border-color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'mini_cart_btn_box_shadow',
				'selector' => '{{WRAPPER}} .wpr-mini-cart-toggle-btn',
			]
		);

		$this->add_responsive_control(
			'mini_cart_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 10,
					'right' => 10,
					'bottom' => 10,
					'left' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'before'
			]
		);

		$this->add_control(
			'mini_cart_btn_border_type',
			[
				'label' => esc_html__( 'Border Type', 'wpr-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'wpr-addons' ),
					'solid' => esc_html__( 'Solid', 'wpr-addons' ),
					'double' => esc_html__( 'Double', 'wpr-addons' ),
					'dotted' => esc_html__( 'Dotted', 'wpr-addons' ),
					'dashed' => esc_html__( 'Dashed', 'wpr-addons' ),
					'groove' => esc_html__( 'Groove', 'wpr-addons' ),
				],
				'default' => 'none',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'border-style: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'mini_cart_btn_border_width',
			[
				'label' => esc_html__( 'Border Width', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default' => [
					'top' => 1,
					'right' => 1,
					'bottom' => 1,
					'left' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'mini_cart_btn_border_type!' => 'none',
				]
			]
		);

		$this->add_control(
			'mini_cart_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wpr-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-toggle-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'toggle_btn_item_count',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Item Count', 'wpr-addons' ),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'toggle_btn_item_count_color',
			[
				'label'  => esc_html__( 'Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-icon-count' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'toggle_btn_item_count_bg_color',
			[
				'label'  => esc_html__( 'Background Color', 'wpr-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#605BE5',
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-icon-count' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'toggle_btn_item_count_font_size',
			[
				'label' => esc_html__( 'Size', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 25,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-icon-count' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'toggle_btn_item_count_box_size',
			[
				'label' => esc_html__( 'Box Size', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 50,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-icon-count' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'toggle_btn_item_count_position',
			[
				'label' => esc_html__( 'Position', 'wpr-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 20,
						'max' => 100,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 65,
				],
				'selectors' => [
					'{{WRAPPER}} .wpr-mini-cart-icon-count' => 'bottom: {{SIZE}}{{UNIT}}; left: {{SIZE}}{{UNIT}};',
				]
			]
		);

        $this->end_controls_section();

		// Tab: Styles ==============
		// Section: Mini Cart ---------------
		$this->add_section_style_mini_cart();

		// Tab: Styles ==============
		// Section: Remove Icon ----------
		$this->add_section_style_remove_icon();

		// Tab: Style ==============
		// Section: Buttons --------
		$this->add_section_style_buttons();

    }

    public function render_svg_inline_icons( $settings ) {
        // Define your SVG icons
        $svg_icons = [
            'cart-light' => '<svg class="e-font-icon-svg e-eicon-cart-light" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M708 854C708 889 736 917 771 917 805 917 833 889 833 854 833 820 805 792 771 792 736 792 708 820 708 854ZM188 167L938 167C950 167 960 178 958 190L926 450C919 502 875 542 822 542L263 542 271 583C281 632 324 667 373 667L854 667C866 667 875 676 875 687 875 699 866 708 854 708L373 708C304 708 244 659 230 591L129 83 21 83C9 83 0 74 0 62 0 51 9 42 21 42L146 42C156 42 164 49 166 58L188 167ZM196 208L255 500 822 500C854 500 880 476 884 445L914 208 196 208ZM667 854C667 797 713 750 771 750 828 750 875 797 875 854 875 912 828 958 771 958 713 958 667 912 667 854ZM250 854C250 797 297 750 354 750 412 750 458 797 458 854 458 912 412 958 354 958 297 958 250 912 250 854ZM292 854C292 889 320 917 354 917 389 917 417 889 417 854 417 820 389 792 354 792 320 792 292 820 292 854Z"></path></svg>',
            'cart-medium' => '<svg class="e-font-icon-svg e-eicon-cart-medium" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M740 854C740 883 763 906 792 906S844 883 844 854 820 802 792 802 740 825 740 854ZM217 156H958C977 156 992 173 989 191L957 452C950 509 901 552 843 552H297L303 581C311 625 350 656 395 656H875C892 656 906 670 906 687S892 719 875 719H394C320 719 255 666 241 593L141 94H42C25 94 10 80 10 62S25 31 42 31H167C182 31 195 42 198 56L217 156ZM230 219L284 490H843C869 490 891 470 895 444L923 219H230ZM677 854C677 791 728 740 792 740S906 791 906 854 855 969 792 969 677 918 677 854ZM260 854C260 791 312 740 375 740S490 791 490 854 438 969 375 969 260 918 260 854ZM323 854C323 883 346 906 375 906S427 883 427 854 404 802 375 802 323 825 323 854Z"></path></svg>',
            'cart-solid' => '<svg class="e-font-icon-svg e-eicon-cart-solid" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M188 167H938C943 167 949 169 953 174 957 178 959 184 958 190L926 450C919 502 875 542 823 542H263L271 583C281 631 324 667 373 667H854C866 667 875 676 875 687S866 708 854 708H373C304 708 244 659 230 591L129 83H21C9 83 0 74 0 62S9 42 21 42H146C156 42 164 49 166 58L188 167ZM771 750C828 750 875 797 875 854S828 958 771 958 667 912 667 854 713 750 771 750ZM354 750C412 750 458 797 458 854S412 958 354 958 250 912 250 854 297 750 354 750Z"></path></svg>',
            'basket-light' => '<svg class="e-font-icon-svg e-eicon-basket-light" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M125 375C125 375 125 375 125 375H256L324 172C332 145 358 125 387 125H655C685 125 711 145 718 173L786 375H916C917 375 917 375 917 375H979C991 375 1000 384 1000 396S991 417 979 417H935L873 798C860 844 820 875 773 875H270C223 875 182 844 169 796L107 417H63C51 417 42 407 42 396S51 375 63 375H125ZM150 417L210 787C217 814 242 833 270 833H773C801 833 825 815 833 790L893 417H150ZM742 375L679 185C676 174 666 167 655 167H387C376 167 367 174 364 184L300 375H742ZM500 521C500 509 509 500 521 500S542 509 542 521V729C542 741 533 750 521 750S500 741 500 729V521ZM687 732C685 743 675 751 663 750 652 748 644 737 646 726L675 520C677 508 688 500 699 502 710 504 718 514 717 526L687 732ZM395 726C397 737 389 748 378 750 367 752 356 744 354 732L325 526C323 515 331 504 343 502 354 500 365 508 366 520L395 726Z"></path></svg>',
            'basket-medium' => '<svg class="e-font-icon-svg e-eicon-basket-medium" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M104 365C104 365 105 365 105 365H208L279 168C288 137 320 115 355 115H646C681 115 713 137 723 170L793 365H896C896 365 897 365 897 365H958C975 365 990 379 990 396S975 427 958 427H923L862 801C848 851 803 885 752 885H249C198 885 152 851 138 798L78 427H42C25 427 10 413 10 396S25 365 42 365H104ZM141 427L199 785C205 807 225 823 249 823H752C775 823 796 807 801 788L860 427H141ZM726 365L663 189C660 182 654 177 645 177H355C346 177 340 182 338 187L274 365H726ZM469 521C469 504 483 490 500 490S531 504 531 521V729C531 746 517 760 500 760S469 746 469 729V521ZM677 734C674 751 658 762 641 760 624 758 613 742 615 725L644 519C647 502 663 490 680 492S708 510 706 527L677 734ZM385 725C388 742 375 757 358 760 341 762 325 750 323 733L293 527C291 510 303 494 320 492 337 489 353 501 355 518L385 725Z"></path></svg>
            ',
            'basket-solid' => '<svg class="e-font-icon-svg e-eicon-basket-solid" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M128 417H63C51 417 42 407 42 396S51 375 63 375H256L324 172C332 145 358 125 387 125H655C685 125 711 145 718 173L786 375H979C991 375 1000 384 1000 396S991 417 979 417H913L853 793C843 829 810 854 772 854H270C233 854 200 829 190 793L128 417ZM742 375L679 185C676 174 666 167 655 167H387C376 167 367 174 364 184L300 375H742ZM500 521V729C500 741 509 750 521 750S542 741 542 729V521C542 509 533 500 521 500S500 509 500 521ZM687 732L717 526C718 515 710 504 699 502 688 500 677 508 675 520L646 726C644 737 652 748 663 750 675 751 686 743 687 732ZM395 726L366 520C364 509 354 501 342 502 331 504 323 515 325 526L354 732C356 744 366 752 378 750 389 748 397 737 395 726Z"></path></svg>',
            'bag-light' => '<svg class="e-font-icon-svg e-eicon-bag-light" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M333 292L333 208C339 100 397 43 501 43 605 43 662 100 667 209V292H750C796 292 833 329 833 375V875C833 921 796 958 750 958H250C204 958 167 921 167 875V375C167 329 204 292 250 292H333ZM375 292H625L625 210C622 125 582 85 501 85 420 85 380 125 375 209L375 292ZM333 333H250C227 333 208 352 208 375V875C208 898 227 917 250 917H750C773 917 792 898 792 875V375C792 352 773 333 750 333H667V454C667 466 658 475 646 475S625 466 625 454L625 333H375L375 454C375 466 366 475 354 475 343 475 333 466 333 454L333 333Z"></path></svg>
            ',
            'bag-medium' => '<svg class="e-font-icon-svg e-eicon-bag-medium" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M323 292L323 207C329 95 391 33 501 33 610 33 673 95 677 209V292H750C796 292 833 329 833 375V875C833 921 796 958 750 958H250C204 958 167 921 167 875V375C167 329 204 292 250 292H323ZM385 292H615L615 210C611 130 577 95 501 95 425 95 390 130 385 209L385 292ZM323 354H250C238 354 229 363 229 375V875C229 887 238 896 250 896H750C762 896 771 887 771 875V375C771 363 762 354 750 354H677V454C677 471 663 485 646 485S615 471 615 454L615 354H385L385 454C385 471 371 485 354 485 337 485 323 471 323 454L323 354Z"></path></svg>',
            'bag-solid' => '<svg class="e-font-icon-svg e-eicon-bag-solid" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M333 292L333 208C339 100 397 43 501 43 605 43 662 100 667 209V292H750C796 292 833 329 833 375V875C833 921 796 958 750 958H250C204 958 167 921 167 875V375C167 329 204 292 250 292H333ZM375 292H625L625 210C622 125 582 85 501 85 420 85 380 125 375 209L375 292Z"></path></svg>',
        ];
    
        // Get the selected icon from the widget settings
        $selected_icon = $settings['icon'];
    
        // Check if the selected icon exists in the SVG icons array
        if ( array_key_exists( $selected_icon, $svg_icons ) ) {
            // Render the SVG icon
            echo $svg_icons[$selected_icon];
        }
    }    

	public function render_mini_cart_toggle($settings) {

		if ( null === WC()->cart ) {
			return;
		}

		$product_count = WC()->cart->get_cart_contents_count();
		$sub_total = WC()->cart->get_cart_subtotal();
		$counter_attr = 'data-counter="' . $product_count . '"';
		if ( \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_font_icon_svg' ) ) {
			$icon_class = $settings['icon']  . ' wpr-inline-svg';
		} else {
			$icon_class = 'eicon';
		}

		if ( !is_plugin_active('wpr-addons-pro/wpr-addons-pro.php') || 'none' == $settings['mini_cart_style'] ) {
			// global $woocommerce;
			$cart_url = wc_get_cart_url();
		} else {
			$cart_url = '#'; 
		}
		?>

		<span class="wpr-mini-cart-toggle-wrap">
			<a href=<?php echo $cart_url ?> class="wpr-mini-cart-toggle-btn" aria-expanded="false">
				<?php if ( 'none' !== $settings['toggle_text']) :
						if ( 'price' == $settings['toggle_text'] ) { ?>
							<span class="wpr-mini-cart-btn-price">
								<?php echo $sub_total;  ?>
							</span>
						<?php } else { ?>
							<span class="wpr-mini-cart-btn-text">
								 <?php esc_html_e( $settings['toggle_title'], 'wpr-addons' ); ?>
							</span>
						<?php } 
				endif; ?>
				<span class="wpr-mini-cart-btn-icon" <?php echo $counter_attr; ?>>
					<i class="<?php echo esc_attr( $icon_class ) ?>">
                        <?php 
                            if ( \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_font_icon_svg' ) ) {
                                $this->render_svg_inline_icons($settings);
                            }
                        ?>
                        <span class="wpr-mini-cart-icon-count <?php echo $product_count ? '' : 'wpr-mini-cart-icon-count-hidden'; ?>">
                            <span><?php echo $product_count ?></span>
                        </span>
                    </i>
				</span>
			</a>
		</span>
		<?php
	}

	public function render_close_cart_icon () {}

	public static function render_mini_cart($settings) {}
    
    protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'mini_cart_attributes',
			[
				'data-animation' => (defined('WPR_ADDONS_PRO_VERSION') && wpr_fs()->can_use_premium_code() && isset($settings['mini_cart_entrance_speed'])) ? $settings['mini_cart_entrance_speed'] : ''
			]
		);

        echo '<div class="wpr-mini-cart-wrap woocommerce"' . $this->get_render_attribute_string( 'mini_cart_attributes' ) . '>';
			echo '<span class="wpr-mini-cart-inner">';
				$this->render_mini_cart_toggle($settings);
				if ( 'none' !== $settings['mini_cart_style'] ) {
					$this->render_mini_cart($settings);
				}
			echo '</span>';
        echo '</div>';
    }    
}        
