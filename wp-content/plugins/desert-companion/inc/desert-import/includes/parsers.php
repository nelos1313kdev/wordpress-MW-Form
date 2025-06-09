<?php
/**
 * WordPress eXtended RSS file parser implementations
 *
 * @package WordPress
 * @subpackage Importer
 */

//_deprecated_file( basename( __FILE__ ), '0.7.0' );

/** DESERT_DESERT_WXR_Parser class */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser.php';

/** DESERT_DESERT_WXR_Parser_SimpleXML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-simplexml.php';

/** DESERT_DESERT_WXR_Parser_XML class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-xml.php';

/** DESERT_DESERT_WXR_Parser_Regex class */
require_once dirname( __FILE__ ) . '/parsers/class-wxr-parser-regex.php';
