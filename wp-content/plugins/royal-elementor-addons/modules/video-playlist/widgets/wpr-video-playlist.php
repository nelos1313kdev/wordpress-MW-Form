<?php
namespace WprAddons\Modules\VideoPlaylist\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Wpr_Video_Playlist extends Widget_Base {

	public function get_name() {
		return 'wpr-video-playlist';
	}

	public function get_title() {
		return esc_html__( 'Video Playlist', 'wpr-addons' );
	}

	public function get_icon() {
		return 'wpr-icon eicon-video-playlist';
	}

	public function get_categories() {
		return [ 'wpr-widgets' ];
	}

	public function get_keywords() {
		return [ 'royal', 'video playlist' ];
	}

	public function has_widget_inner_wrapper(): bool {
		return ! \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}

	public function get_custom_help_url() {
		if ( empty(get_option('wpr_wl_plugin_links')) )
        // return 'https://royal-elementor-addons.com/contact/?ref=rea-plugin-panel-video-playlist-help-btn';
    		return 'https://wordpress.org/support/plugin/royal-elementor-addons/';
    }

	public function is_reload_preview_required() {
		return true;
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'wpr-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'query_group_title',
            [
                'label' => esc_html__( 'Query', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'playlist_query',
			[
				'label' => esc_html__( 'Playlist Query', 'wpr-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom' => esc_html__( 'Custom URLs', 'wpr-addons' ),
					'playlist' => esc_html__( 'YouTube Playlist', 'wpr-addons' ),
				],
			]
		);

		$this->add_control(
			'youtube_api_key',
			[
				'label' => esc_html__( 'YouTube API Key', 'wpr-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'description' => 'To get your <strong>Youtube API Key</strong> please watch this <strong><a href="https://youtu.be/LLAZUTbc97I" target="_blank">Video Tutorial</a></strong>.',
				'condition' => [
					'playlist_query' => 'playlist',
				],
			]
		);

		$this->add_control(
			'youtube_playlist_id',
			[
				'label' => esc_html__( 'YouTube Playlist ID', 'wpr-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'description' => 'To get your <strong>Youtube Playlist ID</strong> go to YouTube Channel, select Playlist and find E.g: <strong>list=PLjFiZESrp9558M7Rghnk5s4sMq6m3RyOb</strong> in the URL and copy the ID.',
                'condition' => [
                    'playlist_query' => 'playlist',
                ],
			]
		);
        $this->add_control(
            'title_group_title',
            [
                'label' => esc_html__( 'Title', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
    
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'HTML Tag', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h6',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'P' => 'p'
                ]
            ]
        );
    
        $this->add_control(
            'playlist_title',
            [
                'label' => esc_html__( 'Playlist Title', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Now Playing', 'wpr-addons' ),
            ]
        );
    
        $this->add_control(
            'urls_group_title',
            [
                'label' => esc_html__( 'Custom Video URLs', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater = new \Elementor\Repeater();
    
        $repeater->add_control(
            'video_url',
            [
                'label' => esc_html__( 'Video URL', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => 'https://youtu.be/OrtzJs-wzlw',
                ],
                'label_block' => true,
            ]
        );
    
        $this->add_control(
            'video_urls',
            [
                'label' => esc_html__( 'Video URLs', 'wpr-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [ 'video_url' => [ 'url' => 'https://youtu.be/OrtzJs-wzlw' ] ],
                    [ 'video_url' => [ 'url' => 'https://youtu.be/zCfzzUuX8HE' ] ],
                    [ 'video_url' => [ 'url' => 'https://youtu.be/Abw5LIIfgEo' ] ],
                    [ 'video_url' => [ 'url' => 'https://youtu.be/dcpehUVAx0k' ] ],
                    [ 'video_url' => [ 'url' => 'https://youtu.be/-wTaxzBxo6E' ] ],
                    [ 'video_url' => [ 'url' => 'https://youtu.be/9qJH__RF--I' ] ],
                ],
                'title_field' => '{{ video_url.url }}',
                'condition' => [
                    'playlist_query' => 'custom',
                ],
            ]
        );    

		$this->end_controls_section();

		$this->start_controls_section(
			'general_section',
			[
				'label' => esc_html__( 'General', 'wpr-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'widget_accent_color',
			[
				'label' => esc_html__( 'Accent Color', 'wpr-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpr-vplaylist-controller' => 'background-color: {{VALUE}};',
                ],
				'default' => '#f84643',
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'wpr-addons' ),
                'selector' => '{{WRAPPER}} .wpr-vplaylist-current-title, {{WRAPPER}} .wpr-vplaylist-info-title',
				'fields_options' => [
					'typography' => [
						'default' => 'custom',
					],
					'font_size' => [
						'default' => [
							'size' => '15',
							'unit' => 'px'
						]
					]
				]
            ]
        );

		$this->end_controls_section();

		// Add more sections and controls as needed
	}
    
    private function get_youtube_playlist_videos($playlist_id, $api_key) {
        $videos = [];
    
        if ( empty($api_key) ) {
            return $videos;
        }
    
        $api_url = sprintf(
            'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=%s&key=%s',
            urlencode($playlist_id),
            urlencode($api_key)
        );
    
        $response = wp_remote_get($api_url);
    
        if ( is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200 ) {
            return $videos;
        }
    
        $body = json_decode(wp_remote_retrieve_body($response), true);
    
        if ( !empty($body['items']) ) {
            foreach ( $body['items'] as $item ) {
                if ( !empty($item['snippet']['resourceId']['videoId']) ) {
                    $videos[] = 'https://youtu.be/' . sanitize_text_field($item['snippet']['resourceId']['videoId']);
                }
            }
        }
    
        return $videos;
    }

    public function wpr_get_svg_icon( $icon ) {
        static $icons_array = null;
    
        if ( is_null( $icons_array ) ) {
            $url = trailingslashit( WPR_ADDONS_ASSETS_URL ) . 'img/svg/svg-icons.json';
    
            $response = wp_remote_get( $url );
    
            if ( is_wp_error( $response ) ) {
                $icons_array = [];
            } else {
                $body = wp_remote_retrieve_body( $response );
                $icons_array = json_decode( $body, true );
            }
        }
    
        $output  = '<span class="wpr-svg-icon wpr-inline-flex">';
        $output .= isset( $icons_array[ $icon ] ) ? $icons_array[ $icon ] : '';
        $output .= '</span>';
    
        return $output;
    }    
    
    protected function render() {
        $settings = $this->get_settings_for_display();

        $title_tag       = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h6';
        $playlist_title  = !empty($settings['playlist_title']) ? $settings['playlist_title'] : esc_html__('Now Playing', 'wpr-addons');
        $playlist_query  = !empty($settings['playlist_query']) ? $settings['playlist_query'] : 'custom';

        $video_urls = [];

        if ( 'playlist' === $playlist_query && !empty($settings['youtube_playlist_id']) ) {
            $video_urls = $this->get_youtube_playlist_videos($settings['youtube_playlist_id'], $settings['youtube_api_key']);
        } elseif ( !empty($settings['video_urls']) && is_array($settings['video_urls']) ) {
            foreach ( $settings['video_urls'] as $video_item ) {
                if ( !empty($video_item['video_url']['url']) ) {
                    $video_urls[] = esc_url($video_item['video_url']['url']);
                }
            }
        }

        if ( empty($video_urls) ) {
            return;
        }

        echo '<div class="wpr-vplaylist-wrap">';

            // Video Player
            echo '<div class="video-player-wrap">';
                echo '<div class="video-player">';
                    echo '<div class="wpr-vplaylist-main"></div>';
                echo '</div>';
            echo '</div>';

            // Playlist Panel
            echo '<div class="wpr-vplaylist-thumbs-wrap">';

                echo '<div class="wpr-vplaylist-highlight">';
                    echo '<div class="wpr-vplaylist-heading">';
                        echo '<span>' . esc_html($playlist_title) . '</span>';
                        echo '<' . esc_attr($title_tag) . ' class="wpr-vplaylist-current-title"></' . esc_attr($title_tag) . '>';
                    echo '</div>';

                    echo '<div class="wpr-vplaylist-controller">';
                        echo '<div class="wpr-play">' . $this->wpr_get_svg_icon('play') . '</div>';
                        echo '<div class="wpr-pause">' . $this->wpr_get_svg_icon('pause') . '</div>';
                    echo '</div>';
                echo '</div>';

                echo '<div class="wpr-vplaylist-thumbs" data-urls=\'' . esc_attr(wp_json_encode($video_urls)) . '\'>';
                    echo '<ul></ul>';
                echo '</div>';

            echo '</div>';

        echo '</div>';
    }

}
