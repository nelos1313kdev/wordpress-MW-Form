<?php 
/**
 * Takes Ranges Control JSON values, decodes and ouputs accordingly
 * @param  [string] $css_prop CSS Property to add
 * @param  [JSON Object] $obj_value Json Object Value
 * @param  [string] $ext css value extension, eg. px, in, pc
 * @return [string]
 */
function corpiva_media_range( $css_prop, $obj_value, $default, $media = 'desktop', $ext = '' ) {
    if( is_string( $obj_value ) && is_array( json_decode( $obj_value, true ) ) ){
        /* It means that we have media queries active */
        $json    = json_decode( $obj_value );
        $value   = '';
        if ( $media == 'desktop' && $json->desktop != $default ) {
            if ( is_array( $css_prop ) ) {
                $value   = $css_prop[0] . ': ' . esc_attr ( $json->desktop ) . $ext . ';';
                if ( count( $css_prop ) > 1 ) {
                    $value  .= $css_prop[1] . ': ' . esc_attr ( $json->desktop ) . $ext . ';';
                }
            } else {
                $value   = $css_prop . ': ' . esc_attr ( $json->desktop ) . $ext . ';';
            }
        }

        if ( $media == 'mobile' && $json->mobile != $default ) {
            if ( is_array( $css_prop ) ) {
                $value   = $css_prop[0] . ': ' . esc_attr ( $json->mobile ) . $ext . ';';
                if ( count( $css_prop ) > 1 ) {
                    $value  .= $css_prop[1] . ': ' . esc_attr ( $json->mobile ) . $ext . ';';
                }
            } else {
                $value   = $css_prop . ': ' . esc_attr ( $json->mobile ) . $ext . ';';
            }
        }

        if ( $media == 'tablet' && $json->tablet != $default ) {
            if ( is_array( $css_prop ) ) {
                $value   = $css_prop[0] . ': ' . esc_attr ( $json->tablet ) . $ext . ';';
                if ( count( $css_prop ) > 1 ) {
                    $value  .= $css_prop[1] . ': ' . esc_attr ( $json->tablet ) . $ext . ';';
                }
            } else {
                $value   = $css_prop . ': ' . esc_attr ( $json->tablet ) . $ext . ';';
            }
        }

        return $value;
    }

    return false;
}

/**
 * Takes Ranges Control applies to corpiva_media_range function and ouputs Full css with @media query
 * @param  [string] $css_prop CSS Property to add
 * @param  [string] $control control / settings
 * @param  [string] $ext css value extension, eg. px, in, pc
 * @return [string]
 */
function corpiva_customizer_value( $control, $css_selector, $css_prop, array $default, $ext = '' ) {
    if ( $control ) {
        $control        = get_theme_mod( $control );
        $return         = '';

        if( is_string( $control ) && is_array( json_decode( $control, true ) ) ){
            $desktop_val    = corpiva_media_range( $css_prop, $control,  $default[0], 'desktop', $ext );
            $tablet_val     = corpiva_media_range( $css_prop, $control, $default[1], 'tablet', $ext );
            $mobile_val     = corpiva_media_range( $css_prop, $control, $default[2], 'mobile', $ext );

            if ( !empty( $desktop_val ) ) {
                $return         = $css_selector . ' { ';
                $return        .= $desktop_val;
                $return        .= '} ';
            }

            if ( !empty( $tablet_val ) ) {
                $return        .= '@media (max-width:768px) {';
                $return        .= $css_selector . ' { ';
                $return        .= $tablet_val;
                $return        .= '} } ';
            }

            if ( !empty( $mobile_val ) ) {
                $return        .= '@media (max-width:480px) {';
                $return        .= $css_selector . ' { ';
                $return        .= $mobile_val;
                $return        .= '} } ';
            }
        } else {
            if ( !empty( $control ) && $control != $default[0] ) {
                $return        .= $css_selector . ' { ';
                $return        .= esc_attr( $control ) . $ext . ';';
                $return        .= ' } ';
            }
        }

        return $return;
    }

    return false;
}