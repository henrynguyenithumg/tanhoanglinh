<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * These functions are intended to provide simple compatibility for those that don't have the mbstring
 * extension enabled. WordPress already provides a proper working definition for `mb_substr()`.
 *
 * @package Genesis\Compatibility
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

if ( ! function_exists( 'mb_strpos' ) ) {
	/**
	 * Add compatibility for undefined mb_strpos() by deferring to strpos().
	 *
	 * @since 2.0.0
	 *
	 * @param string $haystack The string being checked, for the last occurrence of `$needle`.
	 * @param string $needle   The string to find in `$haystack`.
	 * @param int    $offset   Optional. May be specified to begin searching an arbitrary number of characters
	 *                         into the string. Negative values will stop searching at an arbitrary
	 *                         point prior to the end of the string. Default is 0.
	 * @param string $encoding Optional. The encoding parameter is not used in `strpos()`. Default is an empty string.
	 * @return bool|int The numeric position of the first occurrence of `$needle` in the `$haystack` string.
	 *                  If needle is not found, it returns `false`.
	 */
	function mb_strpos( $haystack, $needle, $offset = 0, $encoding = '' ) {
		return strpos( $haystack, $needle, $offset );
	}
}

if ( ! function_exists( 'mb_strrpos' ) ) {
	/**
	 * Add compatibility for undefined mb_strrpos() by deferring to strrpos().
	 *
	 * @since 2.0.0
	 *
	 * @param string $haystack The string being checked, for the last occurrence of `$needle`.
	 * @param string $needle   The string to find in `$haystack`.
	 * @param int    $offset   Optional. May be specified to begin searching an arbitrary number of characters
	 *                         into the string. Negative values will stop searching at an arbitrary
	 *                         point prior to the end of the string. Default is 0.
	 * @param string $encoding Optional. The encoding parameter is not used in `strrpos()`. Default is an empty string.
	 * @return bool|int Numeric position of the last occurrence of `$needle` in the `$haystack` string.
	 *                  If needle is not found, it returns `false`.
	 */
	function mb_strrpos( $haystack, $needle, $offset = 0, $encoding = '' ) {
		return strrpos( $haystack, $needle, $offset );
	}
}

if ( ! function_exists( 'mb_strlen' ) ) {
	/**
	 * Add compatibility for undefined mb_strlen() by deferring to strlen().
	 *
	 * @since 2.0.0
	 *
	 * @param string $string   The string being checked for length.
	 * @param string $encoding Optional. The encoding parameter is not used in `strlen()`. Default is an empty string.
	 * @return int The number of characters in the string having character encoding `$encoding`.
	 *             A multi-byte character is counted as 1. Returns false if the given encoding is invalid.
	 */
	function mb_strlen( $string, $encoding = '' ) {
		return strlen( $string );
	}
}

if ( ! function_exists( 'mb_strtolower' ) ) {
	/**
	 * Add compatibility for undefined mb_strtolower() by deferring to strtolower().
	 *
	 * @since 2.0.0
	 *
	 * @param string $string   The string being converted to lowercase.
	 * @param string $encoding Optional. The encoding parameter is the character encoding.
	 *                         If it is omitted, the internal character encoding value will be used.
	 * @return string `str` with all alphabetic characters converted to lowercase.
	 */
	function mb_strtolower( $string, $encoding = '' ) {
		return strtolower( $string );
	}
}
