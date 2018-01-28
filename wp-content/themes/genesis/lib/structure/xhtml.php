<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Markup
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

add_filter( 'genesis_markup_open', 'genesis_markup_open_xhtml', 10, 2 );
/**
 * Replace HTML5 opening markup with XHTML equivalent.
 *
 * @since 2.4.0
 *
 * @param string $open Opening markup.
 * @param array  $args Markup arguments.
 * @return string XHTML opening markup.
 */
function genesis_markup_open_xhtml( $open, $args ) {

	if ( empty( $args['context'] ) ) {
		return $open;
	}

	if ( substr( $args['context'], 0, 4 ) === 'nav-' ) {

		if ( 'nav-link-wrap' === $args['context'] ) {
			return '';
		}

		$xhtml_id = isset( $args['params'] ) && ! empty( $args['params']['theme_location'] ) ? $args['params']['theme_location'] : '';
		if ( 'primary' === $xhtml_id ) {
			$xhtml_id = 'nav';
		} elseif ( 'secondary' === $xhtml_id ) {
			$xhtml_id = 'subnav';
		}

		return '<div id="' . $xhtml_id . '">';

	}

	if ( 'entry-content' == $args['context'] && ! is_main_query() && ! genesis_is_blog_template() ) {
		return '';
	}

	switch( $args['context'] ) {

		case 'archive-pagination':
		case 'adjacent-entry-pagination':
		case 'comments-pagination':
			$open = '<div class="navigation">';
			break;

		case 'body':
			$open = sprintf( '<body class="%s">', implode( ' ', get_body_class() ) );
			break;

		case 'comments-shortcode':
			$open = '<span class="post-comments">';
			break;

		case 'content':
			$open = '<div id="content" class="hfeed">';
			break;

		case 'content-sidebar-wrap':
			$open = '<div id="content-sidebar-wrap">';
			break;

		case 'default-widget-content-wrap':
			$open = '<div class="widget widget_text">';
			break;

		case 'entry':
			$open = sprintf( '<div class="%s">', implode( ' ', get_post_class() ) );
			break;

		case 'entry-404':
			$open = '<div class="post hentry">';
			break;

		case 'entry-comments':
			$open = '<div id="comments">';
			break;

		case 'entry-image-link':
			$open = '<a href="' . get_permalink() . '" class="entry-image-link" aria-hidden="true">';
			break;

		case 'entry-meta-after-content':
			$open = '<div class="post-meta">';
			break;

		case 'entry-meta-before-content':
			$open = '<div class="post-info">';
			break;

		case 'entry-pings':
			$open = '<div id="pings">';
			break;

		case 'entry-pagination':
			$open = '<p class="pages">';
			break;

		case 'entry-title':
			$wrap = isset( $args['params'] ) && ! empty( $args['params']['wrap'] ) ? $args['params']['wrap'] : '';
			$open = sprintf( '<%s class="entry-title">', $wrap );
			break;

		case 'footer-widgets':
			$open = '<div id="footer-widgets" class="footer-widgets">';
			break;

		case 'header-widget-area':
			$open = '<div class="widget-area header-widget-area">';
			break;

		case 'sidebar-primary':
			$open = '<div id="sidebar" class="sidebar widget-area">';
			break;

		case 'sidebar-secondary':
			$open = '<div id="sidebar-alt" class="sidebar widget-area">';
			break;

		case 'site-container':
			$open = '<div id="wrap">';
			break;

		case 'site-footer':
			$open = '<div id="footer" class="footer">';
			break;

		case 'site-header':
			$open = '<div id="header">';
			break;

		case 'site-inner':
			$open = '<div id="inner">';
			break;

		case 'site-description':
			$wrap = isset( $args['params'] ) && ! empty( $args['params']['wrap'] ) ? $args['params']['wrap'] : '';
			$open = sprintf( '<%s id="description">', $wrap );
			break;

		case 'site-title':
			$wrap = isset( $args['params'] ) && ! empty( $args['params']['wrap'] ) ? $args['params']['wrap'] : '';
			$open = sprintf( '<%s id="title">', $wrap );
			break;

		case 'title-area':
			$open = '<div id="title-area">';
			break;

		case 'entry-header':
		case 'header-nav':
		case 'semantic-description':
		case 'semantic-title':
		case 'widget-entry-content':
			$open = '';
			break;

		case 'widget-area-wrap':
			$open = '<div class="widget-area">';
			break;

		case 'widget-entry-title':
			$open = genesis_a11y( 'headings' ) ? '<h4>' : '<h2>';
			break;

		case 'widget-entry-meta':
			$open = '<p class="byline post-info">';
			break;

		case 'widget-wrap':
			$open = '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">';
			break;

	}

	return $open;

}

add_filter( 'genesis_markup_close', 'genesis_markup_close_xhtml', 10, 2 );
/**
 * Replace HTML5 closing markup with XHTML equivalent.
 *
 * @since 2.4.0
 *
 * @param string $close Closing markup.
 * @param array  $args  Markup arguments.
 * @return string XHTML closing markup.
 */
function genesis_markup_close_xhtml( $close, $args ) {

	if ( empty( $args['context'] ) ) {
		return $close;
	}

	if ( substr( $args['context'], 0, 4 ) == 'nav-' ) {
		return 'nav-link-wrap' == $args['context'] ? '' : '</div>';
	}

	if ( 'entry-content' == $args['context'] && ! is_main_query() && ! genesis_is_blog_template() ) {
		return '';
	}

	switch( $args['context'] ) {

		case 'default-widget-content-wrap':
		case 'entry':
		case 'content-sidebar-wrap':
		case 'content':
		case 'entry-404':
		case 'entry-meta-after-content':
		case 'entry-meta-before-content':
		case 'sidebar-primary':
		case 'sidebar-secondary':
		case 'site-footer':
		case 'site-header':
		case 'widget-area-wrap':
			$close = '</div>';
			break;

		case 'entry-header':
		case 'header-nav':
		case 'semantic-description':
		case 'semantic-headings':
		case 'widget-entry-content':
			$close = '';
			break;

		case 'entry-pagination':
			$close = '</p>';
			break;

		case 'entry-title':
		case 'site-description':
		case 'site-title':
			$wrap = isset( $args['params'] ) && ! empty( $args['params']['wrap'] ) ? $args['params']['wrap'] : '';
			$close = "</{$wrap}>";
			break;

		case 'widget-entry-title':
			$close = genesis_a11y( 'headings' ) ? '</h4>' : '</h2>';
			break;

		case 'widget-wrap':
			$close = '</div></div>' . "\n";
			break;

	}

	return $close;

}

/**
 * Alters the widget area params array for HTML5 compatibility.
 *
 * @since 2.0.0
 *
 * @global array $wp_registered_sidebars Holds all of the registered sidebars.
 */
function _genesis_builtin_sidebar_params() {

	global $wp_registered_sidebars;

	foreach ( $wp_registered_sidebars as $id => $params ) {

		if ( ! isset( $params['_genesis_builtin'] ) && '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">' != $wp_registered_sidebars[ $id ]['before_widget'] ) {
			continue;
		}

		$wp_registered_sidebars[ $id ]['before_widget'] = '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">';
		$wp_registered_sidebars[ $id ]['after_widget']  = '</div></div>';

	}

}
