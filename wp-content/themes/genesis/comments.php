<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) {
	printf( '<p class="alert">%s</p>', __( 'This post is password protected. Enter the password to view comments.', 'genesis' ) );
	return;
}

// Output semantically correct header if accessibility is supported.
if ( genesis_a11y( 'headings' ) ) {
	printf( '<h2 class="screen-reader-text">%s</h2>', __( 'Reader Interactions', 'genesis' ) );
}

do_action( 'genesis_before_comments' );
do_action( 'genesis_comments' );
do_action( 'genesis_after_comments' );

do_action( 'genesis_before_pings' );
do_action( 'genesis_pings' );
do_action( 'genesis_after_pings' );

do_action( 'genesis_before_comment_form' );
do_action( 'genesis_comment_form' );
do_action( 'genesis_after_comment_form' );