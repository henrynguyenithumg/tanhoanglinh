<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Feeds
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

add_filter( 'feed_link', 'genesis_feed_links_filter', 10, 2 );
/**
 * Filter the feed URI if the user has input a custom feed URI.
 *
 * Applied in the `get_feed_link()` WordPress function.
 *
 * @since 1.3.0
 *
 * @param string $output From the get_feed_link() WordPress function.
 * @param string $feed   Optional. Defaults to default feed. Feed type (rss2, rss, sdf, atom).
 * @return string Amended feed URL.
 */
function genesis_feed_links_filter( $output, $feed ) {

	$feed_uri = genesis_get_option( 'feed_uri' );
	$comments_feed_uri = genesis_get_option( 'comments_feed_uri' );

	if ( $feed_uri && ! mb_strpos( $output, 'comments' ) && in_array( $feed, array( '', 'rss2', 'rss', 'rdf', 'atom' ) ) ) {
		$output = esc_url( $feed_uri );
	}

	if ( $comments_feed_uri && mb_strpos( $output, 'comments' ) ) {
		$output = esc_url( $comments_feed_uri );
	}

	return $output;

}

add_action( 'template_redirect', 'genesis_feed_redirect' );
/**
 * Redirect the browser to the custom feed URI.
 *
 * Exits PHP after redirect.
 *
 * @since 1.3.0
 *
 * @return void Return early if is feed user agent is set and matches Feedblitz,
 *              Feedburner or Feedvalidator. Redirects and exits on success.
 */
function genesis_feed_redirect() {

	if ( ! is_feed() || ( isset( $_SERVER['HTTP_USER_AGENT'] ) && preg_match( '/feed(blitz|burner|validator)/i', $_SERVER['HTTP_USER_AGENT'] ) ) ) {
		return;
	}

	// Don't redirect if viewing archive, search, or post comments feed.
	if ( is_archive() || is_search() || is_singular() ) {
		return;
	}

	$feed_uri = genesis_get_option( 'feed_uri' );
	$comments_feed_uri = genesis_get_option( 'comments_feed_uri' );

	if ( $feed_uri && ! is_comment_feed() && genesis_get_option( 'redirect_feed' ) ) {
		wp_redirect( $feed_uri, 302 );
		exit;
	}

	if ( $comments_feed_uri && is_comment_feed() && genesis_get_option( 'redirect_comments_feed' ) ) {
		wp_redirect( $comments_feed_uri, 302 );
		exit;
	}

}
