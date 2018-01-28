<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Formatting
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

/**
 * Return a phrase shortened in length to a maximum number of characters.
 *
 * Result will be truncated at the last white space in the original string. In this function the word separator is a
 * single space. Other white space characters (like newlines and tabs) are ignored.
 *
 * If the first `$max_characters` of the string does not contain a space character, an empty string will be returned.
 *
 * @since 1.4.0
 *
 * @param string $text           A string to be shortened.
 * @param int    $max_characters The maximum number of characters to return.
 * @return string Truncated string. Empty string if `$max_characters` is falsy.
 */
function genesis_truncate_phrase( $text, $max_characters ) {

	if ( ! $max_characters ) {
		return '';
	}

	$text = trim( $text );

	if ( mb_strlen( $text ) > $max_characters ) {

		// Truncate $text to $max_characters + 1.
		$text = mb_substr( $text, 0, $max_characters + 1 );

		// Truncate to the last space in the truncated string.
		$text_trim = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );

		$text = empty( $text_trim ) ? $text : $text_trim;

	}

	return $text;
}

/**
 * Return content stripped down and limited content.
 *
 * Strips out tags and shortcodes, limits the output to `$max_char` characters, and appends an ellipsis and more link to the end.
 *
 * @since 0.1.0
 *
 * @param int    $max_characters The maximum number of characters to return.
 * @param string $more_link_text Optional. Text of the more link. Default is "(more...)".
 * @param bool   $stripteaser    Optional. Strip teaser content before the more text. Default is false.
 * @return string Limited content.
 */
function get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

	$content = get_the_content( '', $stripteaser );

	// Strip tags and shortcodes so the content truncation count is done correctly.
	$content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );

	// Remove inline styles / scripts.
	$content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );

	// Truncate $content to $max_char.
	$content = genesis_truncate_phrase( $content, $max_characters );

	// More link?
	if ( $more_link_text ) {
		$link   = apply_filters( 'get_the_content_more_link', sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text ), $more_link_text );
		$output = sprintf( '<p>%s %s</p>', $content, $link );
	} else {
		$output = sprintf( '<p>%s</p>', $content );
		$link = '';
	}

	return apply_filters( 'get_the_content_limit', $output, $content, $link, $max_characters );

}

/**
 * Return more link text plus hidden title for screen readers, to improve accessibility.
 *
 * @since 2.2.0
 *
 * @param string $more_link_text Text of the more link.
 * @return string `$more_link_text` with or without the hidden title.
 */
 function genesis_a11y_more_link( $more_link_text )  {

 	if ( ! empty( $more_link_text ) && genesis_a11y( 'screen-reader-text' ) ) {
		$more_link_text .= ' <span class="screen-reader-text">' . __( 'about ', 'genesis' ) . get_the_title() . '</span>';
 	}
 	return $more_link_text;

 }

/**
 * Echo the limited content.
 *
 * @since 0.1.0
 *
 * @param int    $max_characters The maximum number of characters to return.
 * @param string $more_link_text Optional. Text of the more link. Default is "(more...)".
 * @param bool   $stripteaser    Optional. Strip teaser content before the more text. Default is false.
 */
function the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {

	$content = get_the_content_limit( $max_characters, $more_link_text, $stripteaser );
	echo apply_filters( 'the_content_limit', $content );

}

/**
 * Add `rel="nofollow"` attribute and value to links within string passed in.
 *
 * @since 1.0.0
 *
 * @param string $text HTML markup.
 * @return string Amended HTML markup with `rel="nofollow"` attribute.
 */
function genesis_rel_nofollow( $text ) {

	$text = genesis_strip_attr( $text, 'a', 'rel' );
	return stripslashes( wp_rel_nofollow( $text ) );

}

/**
 * Remove attributes from a HTML element.
 *
 * This function accepts a string of HTML, parses it for any elements in the `$elements` array, then parses each element
 * for any attributes in the `$attributes` array, and strips the attribute and its value(s).
 *
 * ~~~
 * // Strip class attribute from an anchor
 * genesis_strip_attr(
 *     '<a class="my-class" href="http://google.com/">Google</a>',
 *     'a',
 *     'class'
 * );
 * // Strips class and id attributes from div and span elements
 * genesis_strip_attr(
 *     '<div class="my-class" id="the-div"><span class="my-class" id="the-span"></span></div>',
 *     array( 'div', 'span' ),
 *     array( 'class', 'id' )
 * );
 * ~~~
 *
 * @since 1.0.0
 *
 * @link http://studiopress.com/support/showthread.php?t=20633
 *
 * @param string       $text       A string of HTML formatted code.
 * @param array|string $elements   Elements that $attributes should be stripped from.
 * @param array|string $attributes Attributes that should be stripped from $elements.
 * @param bool         $two_passes Whether the function should allow two passes.
 * @return string HTML markup with attributes stripped.
 */
function genesis_strip_attr( $text, $elements, $attributes, $two_passes = true ) {

	// Cache elements pattern.
	$elements_pattern = implode( '|', (array) $elements );

	// Build patterns.
	$patterns = array();
	foreach ( (array) $attributes as $attribute ) {
		// Opening tags.
		$patterns[] = sprintf( '~(<(?:%s)[^>]*)\s+%s=[\\\'"][^\\\'"]+[\\\'"]([^>]*[^>]*>)~', $elements_pattern, $attribute );

		// Self closing tags.
		$patterns[] = sprintf( '~(<(?:%s)[^>]*)\s+%s=[\\\'"][^\\\'"]+[\\\'"]([^>]*[^/]+/>)~', $elements_pattern, $attribute );
	}

	// First pass.
	$text = preg_replace( $patterns, '$1$2', $text );

	if ( $two_passes ) { // Second pass.
		$text = preg_replace( $patterns, '$1$2', $text );
	}

	return $text;

}

/**
 * Return the special URL of a paged post.
 *
 * Taken from _wp_link_page() in WordPress core, but instead of anchor markup, just return the URL.
 *
 * @since 2.2.0
 *
 * @param int $i       The page number to generate the URL from.
 * @param int $post_id The post ID.
 * @return string Unescaped URL for the a paged post.
 */
function genesis_paged_post_url( $i, $post_id = 0 ) {

	global $wp_rewrite;

	$post = get_post( $post_id );

	if ( 1 == $i ) {
		$url = get_permalink( $post_id );
	} else {
		if ( '' == get_option( 'permalink_structure' ) || in_array( $post->post_status, array( 'draft', 'pending' ) ) ) {
			$url = add_query_arg( 'page', $i, get_permalink( $post_id ) );
		} elseif ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_on_front' ) == $post->ID ) {
			$url = trailingslashit( get_permalink( $post_id ) ) . user_trailingslashit( "$wp_rewrite->pagination_base/" . $i, 'single_paged' );
		} else {
			$url = trailingslashit( get_permalink( $post_id ) ) . user_trailingslashit( $i, 'single_paged' );
		}
	}

	return $url;

}

/**
 * Sanitize multiple HTML classes in one pass.
 *
 * Accepts either an array of `$classes`, or a space separated string of classes and sanitizes them using the
 * `sanitize_html_class()` WordPress function.
 *
 * @since 2.0.0
 *
 * @param array|string $classes       Classes to be sanitized.
 * @param string       $return_format Optional. The return format, 'input', 'string', or 'array'. Default is 'input'.
 * @return array|string String of multiple sanitized classes.
 */
function genesis_sanitize_html_classes( $classes, $return_format = 'input' ) {

	if ( 'input' === $return_format ) {
		$return_format = is_array( $classes ) ? 'array' : 'string';
	}

	$classes = is_array( $classes ) ? $classes : explode( ' ', $classes );

	$sanitized_classes = array_map( 'sanitize_html_class', $classes );

	if ( 'array' === $return_format ) {
		return $sanitized_classes;
	} else {
		return implode( ' ', $sanitized_classes );
	}

}

/**
 * Return an array of allowed tags for output formatting.
 *
 * Mainly used by `wp_kses()` for sanitizing output.
 *
 * @since 1.6.0
 *
 * @return array Allowed elements and attributes, used with KSES.
 */
function genesis_formatting_allowedtags() {

	return apply_filters(
		'genesis_formatting_allowedtags',
		array(
			'a'          => array( 'href' => array(), 'title' => array(), ),
			'b'          => array(),
			'blockquote' => array(),
			'br'         => array(),
			'div'        => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'em'         => array(),
			'i'          => array(),
			'p'          => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'span'       => array( 'align' => array(), 'class' => array(), 'style' => array(), ),
			'strong'     => array(),
		)
	);

}

/**
 * Wrapper for `wp_kses()` that can be used as a filter function.
 *
 * @since 1.8.0
 *
 * @param string $string Content to filter through KSES.
 * @return string Filtered content with only allowed HTML elements.
 */
function genesis_formatting_kses( $string ) {

	return wp_kses( $string, genesis_formatting_allowedtags() );

}

/**
 * Calculate the time difference - a replacement for `human_time_diff()` until it is improved.
 *
 * Based on BuddyPress function `bp_core_time_since()`, which in turn is based on functions created by
 * Dunstan Orchard - http://1976design.com
 *
 * This function will return an text representation of the time elapsed since a
 * given date, giving the two largest units e.g.:
 *
 *  - 2 hours and 50 minutes
 *  - 4 days
 *  - 4 weeks and 6 days
 *
 * @since 1.7.0
 *
 * @param int      $older_date     Unix timestamp of date you want to calculate the time since for`.
 * @param int|bool $newer_date     Optional. Unix timestamp of date to compare older date to. Default false (current time).
 * @param int      $relative_depth Optional, how many units to include in relative date. Default 2.
 * @return string The time difference between two dates.
 */
function genesis_human_time_diff( $older_date, $newer_date = false, $relative_depth = 2 ) {

	// If no newer date is given, assume now.
	$newer_date = $newer_date ? $newer_date : time();

	// Difference in seconds.
	$since = absint( $newer_date - $older_date );

	if ( ! $since ) {
		return '0 ' . _x( 'seconds', 'time difference', 'genesis' );
	}

	// Hold units of time in seconds, and their pluralised strings (not translated yet).
	$units = array(
		array( 31536000, _nx_noop( '%s year', '%s years', 'time difference', 'genesis' ) ),  // 60 * 60 * 24 * 365
		array( 2592000, _nx_noop( '%s month', '%s months', 'time difference', 'genesis' ) ), // 60 * 60 * 24 * 30
		array( 604800, _nx_noop( '%s week', '%s weeks', 'time difference', 'genesis' ) ),    // 60 * 60 * 24 * 7
		array( 86400, _nx_noop( '%s day', '%s days', 'time difference', 'genesis' ) ),       // 60 * 60 * 24
		array( 3600, _nx_noop( '%s hour', '%s hours', 'time difference', 'genesis' ) ),      // 60 * 60
		array( 60, _nx_noop( '%s minute', '%s minutes', 'time difference', 'genesis' ) ),
		array( 1, _nx_noop( '%s second', '%s seconds', 'time difference', 'genesis' ) ),
	);

	// Build output with as many units as specified in $relative_depth.
	$relative_depth = (int) $relative_depth ? (int) $relative_depth : 2;
	$i = 0;
	$counted_seconds = 0;
	$date_partials = array();
	while ( count( $date_partials ) < $relative_depth && $i < count( $units ) ) {
		$seconds = $units[$i][0];
		if ( ( $count = floor( ( $since - $counted_seconds ) / $seconds ) ) != 0 ) {
			$date_partials[] = sprintf( translate_nooped_plural( $units[$i][1], $count, 'genesis' ), $count );
			$counted_seconds += $count * $seconds;
		}
		$i++;
	}

	if ( empty( $date_partials ) ) {
		$output = '';
	} elseif ( 1 == count( $date_partials ) ) {
		$output = $date_partials[0];
	} else {

		// Combine all but last partial using commas.
		$output = implode( ', ', array_slice( $date_partials, 0, -1 ) );

		// Add 'and' separator.
		$output .= ' ' . _x( 'and', 'separator in time difference', 'genesis' ) . ' ';

		// Add last partial.
		$output .= end( $date_partials );
	}

	return $output;

}

/**
 * Mark up content with code tags.
 *
 * Escapes all HTML, so `<` gets changed to `&lt;` and displays correctly.
 *
 * Used almost exclusively within labels and text in user interfaces added by Genesis.
 *
 * @since 2.0.0
 *
 * @param string $content Content to be wrapped in code tags.
 * @return string Content wrapped in `code` tags.
 */
function genesis_code( $content ) {

	return '<code>' . esc_html( $content ) . '</code>';

}

/**
 * Remove paragraph tags from content.
 *
 * @since 2.5.0
 *
 * @param string $content Content possibly containing paragraph tags.
 * @return string Content without paragraph tags.
 */
function genesis_strip_p_tags( $content ) {

	return preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '$1', $content );

}
