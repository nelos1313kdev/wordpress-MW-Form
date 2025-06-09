<?php
namespace WprAddons\Admin\Includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WPR_Templates_Category_Filter setup
 *
 * @since 1.0
 */
class WPR_Templates_Category_Filter {
		
	/**
	** Constructor
	*/
	public function __construct() {
        // $which (the position of the filters form) is either 'top' or 'bottom'
        add_action( 'restrict_manage_posts', function ( $post_type, $which ) {
            if ( 'top' === $which && 'wpr_templates' === $post_type ) {
                $taxonomy = 'wpr_template_type';
                $tax = get_taxonomy( $taxonomy );            // get the taxonomy object/data
                $cat = filter_input( INPUT_GET, $taxonomy ); // get the selected category slug
        
                echo '<label class="screen-reader-text" for="wpr_template_type">Filter by ' .
                    esc_html( $tax->labels->singular_name ) . '</label>';
        
                wp_dropdown_categories( [
                    'walker' => new WPR_Custom_Walker_CategoryDropdown(),
                    'class' => 'wpr-templates-cat-select',
                    'show_option_all' => $tax->labels->all_items,
                    'hide_empty'      => 0, // include categories that have no posts
                    'hierarchical'    => $tax->hierarchical,
                    'show_count'      => 0, // don't show the category's posts count
                    'orderby'         => 'name',
                    'selected'        => $cat,
                    'taxonomy'        => $taxonomy,
                    'name'            => $taxonomy,
                    'value_field'     => 'slug',
                ] );
            }
        }, 10, 2 );
    }
}

new WPR_Templates_Category_Filter();

class WPR_Custom_Walker_CategoryDropdown extends \Walker_CategoryDropdown {
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		$pad = str_repeat('&nbsp;', $depth * 3);
		
		// Here you can modify the category name
		$cat_name = apply_filters('list_cats', $category->name, $category);

		// Customization example: append count
		if( $args['show_count'] ) {
			$cat_name .= ' ('. $category->count .')';
		}

		$output .= "\t<option class=\"level-$depth\" value=\"".$category->slug."\"";
		if ( $category->slug == $args['selected'] ) {
			$output .= ' selected="selected"';
		}
		$output .= '>';
		$output .= str_replace('_', ' ', $pad.$cat_name);
		if ( $args['show_count'] ) {
			$output .= '&nbsp;&nbsp;('. $category->count .')';
		}
		$output .= "</option>\n";
	}
}