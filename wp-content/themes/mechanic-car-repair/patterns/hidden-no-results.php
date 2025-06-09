<?php
/**
 * Title: Hidden No Results Content
 * Slug: mechanic-car-repair/hidden-no-results-content
 * Inserter: no
 */
?>
<!-- wp:paragraph -->
<p>
<?php esc_html_x( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'Message explaining that there are no results returned from a search', 'mechanic-car-repair' ); ?>
</p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php esc_html_x( 'Search', 'label', 'mechanic-car-repair' ); ?>","placeholder":"<?php echo esc_attr_x( 'Search...', 'placeholder for search field', 'mechanic-car-repair' ); ?>","showLabel":false,"buttonText":"<?php esc_attr_e( 'Search', 'mechanic-car-repair' ); ?>","buttonUseIcon":true} /-->
