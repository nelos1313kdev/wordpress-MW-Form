<?php
namespace WprAddons\Classes\Modules;

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use WprAddons\Classes\Utilities;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Ajax_Search setup
 *
 * @since 3.4.6
 */

 class WPR_Ajax_Search {

    public function __construct() {
        add_action('wp_ajax_wpr_data_fetch' , [$this, 'data_fetch']);
        add_action('wp_ajax_nopriv_wpr_data_fetch',[$this, 'data_fetch']);
    }

    public function data_fetch() {

        $nonce = $_POST['nonce'];

        if ( !wp_verify_nonce( $nonce, 'wpr-addons-js' ) ) {
            return; // Get out of here, the nonce is rotten!
        }

		$all_post_types = [];

        if ( sanitize_text_field($_POST['wpr_show_attachments']) == 'yes' ) {
            $all_post_types = ['attachment'];
        }

        foreach(  Utilities::get_custom_types_of( 'post', false ) as $key=>$value ) {
            array_push($all_post_types, $key);
        }
        
        $tax_query = '';

        if ( $_POST['wpr_category'] != false && $_POST['wpr_category'] != '' ) {   
                $tax_query = array(
                    array(
                        'taxonomy' => $_POST['wpr_option_post_type'],
                        'field'    => 'term_id',
                        'terms'    => sanitize_text_field($_POST['wpr_category']),
                    ),
                );

            // if ( isset($_POST['wpr_option_post_type']) && !empty($_POST['wpr_option_post_type']) ) {
            //     $tax_query = array(
            //         array(
            //             'taxonomy' => $_POST['wpr_option_post_type'],
            //             'field'    => 'term_id',
            //             'terms'    => sanitize_text_field($_POST['wpr_category']),
            //         ),
            //     );
            // } else {
            //     $tax_query = array(
            //         array(
            //             'taxonomy' => $_POST['wpr_query_type'] == 'product' ? $_POST['wpr_query_type'] . '_cat' : 'category',
            //             'field'    => 'term_id',
            //             'terms'    => sanitize_text_field($_POST['wpr_category']),
            //         ),
            //     );
            // }
        } else if ( $_POST['wpr_category'] == 0 && $_POST['wpr_query_type'] != 'all' ) {
            if ( !empty($_POST['wpr_option_post_type']) ) {
                $tax_query = array(
                    array(
                        'taxonomy' => $_POST['wpr_option_post_type'],
                        'field'    => 'term_id',
                        'terms'    => sanitize_text_field($_POST['wpr_category']),
                    ),
                );
            } else { 
                // Get the string from the POST data
                $taxonomy_type_string = $_POST['wpr_taxonomy_type'];
            
                // Check if the string contains spaces
                if (strpos($taxonomy_type_string, ' ') !== false) {
                    // Split the string into an array based on spaces
                    $taxonomy_types = explode(' ', $taxonomy_type_string);
            
                
                    $tax_query = [
                        'relation' => 'OR'
                    ];
                    
                    foreach( $taxonomy_types as $taxonomy_type ) {
                        array_push($tax_query, [
                            'taxonomy' => $taxonomy_type,
                            'operator'    => 'EXISTS'
                        ]);
                    }
                } else {
                    // If there are no spaces, leave it as a single-item array
                    $taxonomy_types = $taxonomy_type_string;

                    $tax_query = array(
                        array(
                            'taxonomy' => $_POST['wpr_taxonomy_type'],
                            'operator'    => 'EXISTS',
                        ),
                    );
                }
            } 
        }
        
        $can_view_protected_posts = current_user_can('read_private_posts');
        
        if ( ( 'yes' !== sanitize_text_field($_POST['wpr_show_ps_pt'] ) ) || !$can_view_protected_posts ) {
            $the_query = new \WP_Query( 
                [
                    'posts_per_page' => sanitize_text_field($_POST['wpr_number_of_results']), 
                    's' => sanitize_text_field( $_POST['wpr_keyword'] ), 
                    'post_type' => $_POST['wpr_query_type'] === 'all' || (!defined('WPR_ADDONS_PRO_VERSION') || !wpr_fs()->can_use_premium_code())  ? $all_post_types : array( sanitize_text_field($_POST['wpr_query_type']) ),
                    'offset' => sanitize_text_field($_POST['wpr_search_results_offset']),
                    'meta_query' => 'yes' === sanitize_text_field($_POST['wpr_exclude_without_thumb']) ? [
                        ['key' => '_thumbnail_id']
                    ] : '',
                    'tax_query' => $tax_query,
                    'post_status' => in_array('attachment', $all_post_types) ? ['publish', 'inherit'] : 'publish',
                    'post_password' => ''
                ]
            );
        } else {
            $the_query = new \WP_Query( 
                [
                    'posts_per_page' => sanitize_text_field($_POST['wpr_number_of_results']), 
                    's' => sanitize_text_field( $_POST['wpr_keyword'] ), 
                    'post_type' => $_POST['wpr_query_type'] === 'all' || (!defined('WPR_ADDONS_PRO_VERSION') || !wpr_fs()->can_use_premium_code())  ? $all_post_types : array( sanitize_text_field($_POST['wpr_query_type']) ),
                    'offset' => sanitize_text_field($_POST['wpr_search_results_offset']),
                    'meta_query' => 'yes' === sanitize_text_field($_POST['wpr_exclude_without_thumb']) ? [
                        ['key' => '_thumbnail_id']
                    ] : '',
                    'tax_query' => $tax_query,
                    'post_status' => in_array('attachment', $all_post_types) ? ['publish', 'inherit'] : 'publish',
                ]
            );
        }
        
        if( $the_query->have_posts() ) :
            $number_of_queried_posts = $the_query->found_posts;
            $post_count = 0;

                while( $the_query->have_posts() ) : $the_query->the_post();

                // if ( ( !has_post_thumbnail() && 'yes' === sanitize_text_field($_POST['wpr_exclude_without_thumb'])) ) : 
                //     continue;
                // endif;

                ob_start();
                // the_post_thumbnail(sanitize_text_field($_POST['ajax_search_img_size']));
                the_post_thumbnail('medium');
                $post_thumb = ob_get_clean();
                ?>

                <li data-number-of-results = <?php echo $the_query->found_posts ?>>
                    
                    <?php if ( !post_password_required() || $can_view_protected_posts ) : ?>

                        <?php if ( 'yes' === sanitize_text_field($_POST['wpr_show_ajax_thumbnail']) ) :
                            if ( has_post_thumbnail() ) :
                                echo '<a class="wpr-ajax-img-wrap" target="'. esc_attr($_POST['wpr_ajax_search_link_target']) .'" href="'. esc_url( get_the_permalink() ) .'">'.  $post_thumb .'</a>';
                                // echo '<a class="wpr-ajax-img-wrap" target="'. sanitize_text_field($_POST['ajax_search_link_target']) .'" href="'. esc_url( get_the_permalink() ) .'">'.  '<img src="'. Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'ajax_search_image', [$_POST['ajax_search_image_size']] ) .'"/>' .'</a>';
                            else :
                                echo '<a class="wpr-ajax-img-wrap" target="'. esc_attr($_POST['wpr_ajax_search_link_target']) .'" href='. esc_url( get_the_permalink() ) .'><img src='.Utils::get_placeholder_image_src().'></a>';
                            endif ;
                        endif ; ?>

                        <div class="wpr-ajax-search-content">
                            <a target="<?php echo esc_attr($_POST['wpr_ajax_search_link_target']) ?>" class="wpr-ajax-title" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title();?></a>

                            <?php if ( sanitize_text_field($_POST['wpr_show_description']) == 'yes' ) : ?>
                                <p class="wpr-ajax-desc"><a target="<?php echo esc_attr($_POST['wpr_ajax_search_link_target']) ?>" href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words(get_the_content(), sanitize_text_field($_POST['wpr_number_of_words'])); ?></a></p>
                            <?php endif; ?>

                            <?php if ( 'yes' === sanitize_text_field($_POST['wpr_show_product_price']) && 
                                    get_post_type() === 'product' && 
                                    class_exists('WooCommerce') ) :
                                $product = wc_get_product(get_the_ID());
                                if ($product) {
                                    $price_html = '<div class="wpr-search-product-price">'. $product->get_price_html() .'</div>';

                                    echo $price_html;
                                }
                            endif; ?>

                            <?php if ( sanitize_text_field($_POST['wpr_show_view_result_btn']) ) : ?>
                                <a target="<?php echo esc_attr($_POST['wpr_ajax_search_link_target']) ?>" class="wpr-view-result" href="<?php echo esc_url( the_permalink() ); ?>"><?php echo sanitize_text_field($_POST['wpr_view_result_text']) ?></a>
                            <?php endif; ?>
                        </div>
                    
                    <?php else: ?>

                        <?php if ( 'yes' === sanitize_text_field($_POST['wpr_show_ajax_thumbnail']) ) :
                            echo '<a class="wpr-ajax-img-wrap" target="'. esc_attr($_POST['wpr_ajax_search_link_target']) .'" href='. esc_url( get_the_permalink() ) .'><img src='.Utils::get_placeholder_image_src().'></a>';
                        endif ; ?>

                        <div class="wpr-ajax-search-content">
                            <a target="<?php echo esc_attr($_POST['wpr_ajax_search_link_target']) ?>" class="wpr-ajax-title" href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title();?></a>
                        </div>
                    
                    <?php endif; ?>

                </li>
                <?php 
                $post_count++;
                endwhile;

            wp_reset_postdata();
            
        else :
            if (0 < sanitize_text_field($_POST['wpr_search_results_offset'])) {
            } else {
                echo '<p class="wpr-no-results">'. sanitize_text_field($_POST['wpr_no_results']) .'</p>';
            }

        endif;
        
        die();
    }
 }

 new WPR_Ajax_Search();