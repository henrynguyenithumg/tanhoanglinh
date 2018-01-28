<?php
/**
 * Tân Hoàng Linh.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  TanHoangLinh
 * @license GPL-2.0+
 * @link    #
 */

?>
<table class="form-table">
<tbody>

	<tr valign="top">
		<th scope="row"><label for="<?php $this->field_name( 'blog_title' ); ?>"><?php esc_html_e( 'Use for site title/logo', 'genesis' ); ?></label></th>
		<td>
			<select name="<?php $this->field_name( 'blog_title' ); ?>" id="<?php $this->field_name( 'blog_title' ); ?>">
				<option value="text"<?php selected( $this->get_field_value( 'blog_title' ), 'text' ); ?>><?php esc_html_e( 'Dynamic text', 'genesis' ); ?></option>
				<option value="image"<?php selected( $this->get_field_value( 'blog_title' ), 'image' ); ?>><?php esc_html_e( 'Image logo', 'genesis' ); ?></option>
			</select>
		</td>
	</tr>

</tbody>
</table>
