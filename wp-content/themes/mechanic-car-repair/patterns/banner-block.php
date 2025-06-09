<?php
/**
 * Title: Banner Block
 * Slug: mechanic-car-repair/banner-block
 * Categories: banner
 * Block Types: core/template-part/banner-block
 */
?>

<!-- wp:cover {"url":"<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/banner-bg.png","id":87,"dimRatio":0,"isUserOverlayColor":true,"minHeight":600,"minHeightUnit":"px","className":" banner-cover","style":{"spacing":{"margin":{"top":"0","bottom":"0"},"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}}} -->
<div class="wp-block-cover banner-cover" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;min-height:600px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-87" alt="" src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/banner-bg.png" data-object-fit="cover"/><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"padding":{"right":"0","left":"0"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group" style="padding-right:0;padding-left:0"><!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"slider-banner","style":{"spacing":{"padding":{"right":"0","left":"0"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center slider-banner" style="padding-right:0;padding-left:0"><!-- wp:column {"verticalAlignment":"center","className":"banner-content"} -->
<div class="wp-block-column is-vertically-aligned-center banner-content"><!-- wp:heading {"style":{"typography":{"fontSize":"25px","fontStyle":"normal","fontWeight":"700","letterSpacing":"0.55px","lineHeight":"1.6"}},"textColor":"base","fontFamily":"titillium-web"} -->
    <h2 class="wp-block-heading has-base-color has-text-color has-titillium-web-font-family" style="font-size:25px;font-style:normal;font-weight:700;letter-spacing:0.55px;line-height:1.6"><?php esc_html_e( 'BEST CAR REPAIR', 'mechanic-car-repair' ); ?> &amp; <br><span><?php esc_html_e( 'MAINTENANCE', 'mechanic-car-repair' ); ?></span><?php esc_html_e( 'SERVICES', 'mechanic-car-repair' ); ?></h2>
    <!-- /wp:heading -->
<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"500"},"spacing":{"padding":{"top":"0","bottom":"0"},"margin":{"top":"10px","bottom":"10px"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontFamily":"roboto"} -->
<p class="has-base-color has-text-color has-link-color has-roboto-font-family" style="margin-top:10px;margin-bottom:10px;padding-top:0;padding-bottom:0;font-size:14px;font-style:normal;font-weight:500"><?php esc_html_e( 'Lorem Ipsum is simply dummy text of the printing', 'mechanic-car-repair' ); ?> <br><?php esc_html_e( 'and typesetting industry.', 'mechanic-car-repair' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:buttons {"className":"banner-btn","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div class="wp-block-buttons banner-btn" style="margin-top:0;margin-bottom:0"><!-- wp:button {"backgroundColor":"base","textColor":"black","className":"theme-btn","style":{"spacing":{"padding":{"left":"25px","right":"25px","top":"8px","bottom":"8px"}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"border":{"radius":"5px"}},"fontFamily":"roboto"} -->
<div class="wp-block-button has-custom-font-size theme-btn has-roboto-font-family" style="font-size:14px;font-style:normal;font-weight:500;text-transform:uppercase"><a class="wp-block-button__link has-black-color has-base-background-color has-text-color has-background wp-element-button" href="#" style="border-radius:5px;padding-top:8px;padding-right:25px;padding-bottom:8px;padding-left:25px"><?php esc_html_e( 'Learn More', 'mechanic-car-repair' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"textColor":"base","className":"theme-btn","style":{"spacing":{"padding":{"left":"25px","right":"25px","top":"8px","bottom":"8px"}},"typography":{"fontSize":"14px","fontStyle":"normal","fontWeight":"500","textTransform":"uppercase"},"border":{"radius":"5px","width":"1px"},"color":{"background":"#ffffff00"}},"fontFamily":"roboto","borderColor":"base"} -->
<div class="wp-block-button has-custom-font-size theme-btn has-roboto-font-family" style="font-size:14px;font-style:normal;font-weight:500;text-transform:uppercase"><a class="wp-block-button__link has-base-color has-text-color has-background has-border-color has-base-border-color wp-element-button" href="#" style="border-width:1px;border-radius:5px;background-color:#ffffff00;padding-top:8px;padding-right:25px;padding-bottom:8px;padding-left:25px"><?php esc_html_e( 'FREE QUOTE', 'mechanic-car-repair' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"40%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:40%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->

<!-- wp:spacer {"height":"25px"} -->
<div style="height:25px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->