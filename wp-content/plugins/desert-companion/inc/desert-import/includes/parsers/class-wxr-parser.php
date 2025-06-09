<?php
/**
 * WordPress eXtended RSS file parser implementations
 *
 * @package WordPress
 * @subpackage Importer
 */

/**
 * WordPress Importer class for managing parsing of WXR files.
 */
class DESERT_WXR_Parser {
	function parse( $file ) {
		// Attempt to use proper XML parsers first
		if ( extension_loaded( 'simplexml' ) ) {
			$parser = new DESERT_WXR_Parser_SimpleXML;
			$result = $parser->parse( $file );

			// If SimpleXML succeeds or this is an invalid WXR file then return the results
			if ( ! is_wp_error( $result ) || 'SimpleXML_parse_error' != $result->get_error_code() )
				return $result;
		} else if ( extension_loaded( 'xml' ) ) {
			$parser = new DESERT_WXR_Parser_XML;
			$result = $parser->parse( $file );

			// If XMLParser succeeds or this is an invalid WXR file then return the results
			if ( ! is_wp_error( $result ) || 'XML_parse_error' != $result->get_error_code() )
				return $result;
		}

		// We have a malformed XML file, so display the error and fallthrough to regex
		if ( isset($result) && defined('IMPORT_DEBUG') && IMPORT_DEBUG ) {
			echo '<pre>';
			if ( 'SimpleXML_parse_error' == $result->get_error_code() ) {
				foreach  ( $result->get_error_data() as $error )
					echo esc_html($error->line) . ':' . esc_html($error->column) . ' ' . esc_html( $error->message ) . "\n";
			} else if ( 'XML_parse_error' == $result->get_error_code() ) {
				$error = $result->get_error_data();
				echo wp_kses_post($error[0]) . ':' . wp_kses_post($error[1]) . ' ' . wp_kses_post($error[2]);
			}
			echo '</pre>';
			echo '<p><strong>' . esc_html(__( 'There was an error when reading this WXR file', 'desert-companion' )) . '</strong><br />';
			echo esc_html(__( 'Details are shown above. The importer will now try again with a different parser...', 'desert-companion' )) . '</p>';
		}

		// use regular expressions if nothing else available or this is bad XML
		$parser = new DESERT_WXR_Parser_Regex;
		return $parser->parse( $file );
	}
}
