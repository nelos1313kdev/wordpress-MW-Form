<?php

namespace WprAddons\Modules\Date;

use WprAddons\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Module extends Module_Base {

    public function get_widgets() {
        return [ 'WPR_Date' ];
    }
    
    public function get_name() {
        return 'wpr-date';
    }
}
